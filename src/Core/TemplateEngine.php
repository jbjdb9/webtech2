<?php

namespace App\Core;

/**
 * Class TemplateEngine
 *
 * This class is responsible for rendering templates with given parameters.
 * It supports template inheritance and inclusion, as well as basic expression evaluation.
 */
class TemplateEngine
{
    protected $templateDir;

    public function __construct($templateDir)
    {
        $this->templateDir = $templateDir;
    }

    /**
     * Renders a template with given parameters.
     *
     * @param string $template The name of the template to render.
     * @param array $params The parameters to use in the template.
     * @return string The rendered template content.
     */
    public function render($template, $params = [])
    {
        $templateContent = file_get_contents($this->templateDir . '/' . $template);
        $templateContent = $this->includeTemplates($templateContent);
        $blocks = $this->getBlocks($templateContent);
        $parentTemplate = $this->getParentTemplate($templateContent);

        if ($parentTemplate) {
            $parentContent = file_get_contents($this->templateDir . '/' . $parentTemplate);
            $templateContent = str_replace(array_keys($blocks), array_values($blocks), $parentContent);
        }

        $templateContent = $this->replaceParams($templateContent, $params);
        return $this->evaluateExpressions($templateContent);
    }

    /**
     * Extracts the blocks from a template content.
     *
     * @param string $content The template content.
     * @return array The extracted blocks.
     */
    protected function getBlocks($content)
    {
        preg_match_all('/{% block (.*?) %}(.*?){% endblock %}/s', $content, $matches, PREG_SET_ORDER);

        $blocks = [];
        foreach ($matches as $match) {
            $blocks['{% block ' . $match[1] . ' %}{% endblock %}'] = $match[2];
        }

        return $blocks;
    }

    /**
     * Gets the parent template of a template.
     *
     * @param string $content The template content.
     * @return string|null The name of the parent template, or null if there is no parent template.
     */
    protected function getParentTemplate($content)
    {
        if (preg_match('/{% extends \'(.*?)\' %}/', $content, $matches)) {
            return $matches[1];
        }

        return null;
    }

    /**
     * Includes other templates into a template content.
     *
     * @param string $content The template content.
     * @return string The template content with included templates.
     */
    protected function includeTemplates($content)
    {
        return preg_replace_callback('/{% include \'(.*?)\' %}/', function ($matches) {
            $includedTemplateContent = file_get_contents($this->templateDir . '/' . $matches[1]);
            return $this->includeTemplates($includedTemplateContent);
        }, $content);
    }

    /**
     * Replaces the parameters in a template content.
     *
     * @param string $content The template content.
     * @param array $params The parameters to replace in the template content.
     * @return string The template content with replaced parameters.
     */
    protected function replaceParams($content, $params)
    {
        foreach ($params as $key => $value) {
            $content = str_replace('{{ ' . $key . ' }}', $value, $content);
        }

        return $content;
    }

    /**
     * Evaluates the expressions in a template content.
     *
     * @param string $content The template content.
     * @return string The template content with evaluated expressions.
     */
    protected function evaluateExpressions($content)
    {
        return preg_replace_callback('/{{ (.*?) }}/', function ($matches) {
            $expression = $matches[1];

            // Sanitize the expression
            $expression = preg_replace('/[^0-9+\-.*\/() ]/', '', $expression);

            if (preg_match('/^([0-9+\-.*\/() ])+$/', $expression)) {
                return eval('return ' . $expression . ';');
            }

            return $matches[0];
        }, $content);
    }
}
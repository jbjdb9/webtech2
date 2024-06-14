<?php

namespace App\Core;

class TemplateEngine
{
    protected $templateDir;

    public function __construct($templateDir)
    {
        $this->templateDir = $templateDir;
    }

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
        $templateContent = $this->evaluateExpressions($templateContent);

        return $templateContent;
    }

    protected function getBlocks($content)
    {
        preg_match_all('/{% block (.*?) %}(.*?){% endblock %}/s', $content, $matches, PREG_SET_ORDER);

        $blocks = [];
        foreach ($matches as $match) {
            $blocks['{% block ' . $match[1] . ' %}{% endblock %}'] = $match[2];
        }

        return $blocks;
    }

    protected function getParentTemplate($content)
    {
        if (preg_match('/{% extends \'(.*?)\' %}/', $content, $matches)) {
            return $matches[1];
        }

        return null;
    }

    protected function includeTemplates($content)
    {
        return preg_replace_callback('/{% include \'(.*?)\' %}/', function ($matches) {
            $includedTemplateContent = file_get_contents($this->templateDir . '/' . $matches[1]);
            return $this->includeTemplates($includedTemplateContent);
        }, $content);
    }

    protected function replaceParams($content, $params)
    {
        foreach ($params as $key => $value) {
            $content = str_replace('{{ ' . $key . ' }}', $value, $content);
        }

        return $content;
    }

    protected function evaluateExpressions($content)
    {
        return preg_replace_callback('/{{ (.*?) }}/', function ($matches) {
            $expression = $matches[1];

            // Sanitize the expression
            $expression = preg_replace('/[^0-9+\-.*\/() ]/', '', $expression);

            // Validate the expression
            if (preg_match('/^([0-9+\-.*\/() ])+$/', $expression)) {
                // Add a return statement to the evaluated string
                return eval('return ' . $expression . ';');
            }

            // If the expression is not valid, return the original string
            return $matches[0];
        }, $content);
    }
}
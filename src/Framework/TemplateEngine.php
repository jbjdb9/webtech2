<?php

namespace App\Framework;

use ReflectionObject;

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
        $templateContent = $this->evaluateIfExpressions($templateContent, $params);
        $templateContent = $this->evaluateIfIsExpressions($templateContent, $params);
        $templateContent = $this->evaluateForElseExpressions($templateContent, $params);
//        $templateContent = $this->evaluateExpressions($templateContent);
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

    private function replaceParams($content, $params)
    {
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                continue;
            }
            $content = str_replace('{{ ' . $key . ' }}', $value, $content);
        }

        return $content;
    }

//    protected function evaluateExpressions($content)
//    {
//        return preg_replace_callback('/{{ (.*?) }}/', function ($matches) {
//            $expression = $matches[1];
//
//            // Check if the expression is mathematical
//            if (preg_match('/^([0-9+\-.*\/() ])+$/', $expression)) {
//                // Sanitize the expression
//                $expression = preg_replace('/[^0-9+\-.*\/() ]/', '', $expression);
//
//                return eval('return ' . $expression . ';');
//            }
//
//            // If the expression is not mathematical, return it as is
//            return $matches[0];
//        }, $content);
//    }

    protected function evaluateIfExpressions($content, $params)
    {
        return preg_replace_callback('/{% if (.*?) is defined %}(.*?){% endif %}/s', function ($matches) use ($params) {
            $variable = $matches[1];
            $content = $matches[2];

            if (isset($params[$variable])) {
                return $content;
            }

            return '';
        }, $content);
    }

    protected function evaluateIfIsExpressions($content, $params)
    {
        return preg_replace_callback('/{% if (.*?) == (.*?) %}(.*?){% endif %}/s', function ($matches) use ($params) {
            $variable = $matches[1];
            $value = $matches[2];
            $content = $matches[3];

            if (isset($params[$variable]) && $params[$variable] == $value) {
                return $content;
            }

            return '';
        }, $content);
    }

    protected function evaluateForElseExpressions($content, $params)
    {
        return preg_replace_callback('/{% for (.*?) in (.*?) %}(.*?){% else %}(.*?){% endfor %}/s', function ($matches) use ($params) {
            $variable = $matches[1];
            $array = $matches[2];
            $forContent = $matches[3];
            $elseContent = $matches[4];

            if (is_array($params[$array]) && !empty($params[$array])) {
                $result = '';
                foreach ($params[$array] as $item) {
                    $itemContent = $forContent;
                    if (is_array($item)) {
                        foreach ($item as $property => $value) {
                            $itemContent = str_replace("{{ $variable.$property }}", $value, $itemContent);
                        }
                    } elseif (is_object($item)) {
                        $reflection = new ReflectionObject($item);
                        foreach ($reflection->getProperties() as $property) {
                            $property->setAccessible(true);
                            $value = $property->getValue($item);
                            $value = $value !== null ? $value : '';
                            $itemContent = str_replace("{{ $variable." . $property->getName() . " }}", $value, $itemContent);                        }
                    }
                    $result .= $itemContent;
                }
                return $result;
            }

            return $elseContent;
        }, $content);
    }
}
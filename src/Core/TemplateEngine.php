<?php

namespace App\Core;

class TemplateEngine
{
    private $templateDir;

    public function __construct($templateDir)
    {
        $this->templateDir = $templateDir;
    }

    public function render($template, $params = [])
    {
        $templatePath = $this->templateDir . '/' . $template;
        if (!file_exists($templatePath)) {
            throw new \Exception("Template file not found: $templatePath");
        }

        $output = file_get_contents($templatePath);

        foreach ($params as $key => $value) {
            $output = str_replace("{{ $key }}", $value, $output);
        }

        return $output;
    }
}
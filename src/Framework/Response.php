<?php

namespace App\Framework;

class Response
{
    private $statusCode = 200;
    private $headers = [];
    private $content;
    private $engine;

    public function __construct()
    {
        $this->engine = new TemplateEngine(__DIR__ . '/../App/View');
    }

    public function setStatusCode($code)
    {
        $this->statusCode = $code;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Sets the content of the response to a rendered template.
     *
     * This method uses the TemplateEngine to render a template with the given parameters,
     * and sets the content of the response to the rendered template.
     *
     * @param string $template The name of the template to render.
     * @param array $params An optional array of parameters to use in the template.
     */
    public function setTemplate($template, $params = [])
    {
        $this->content = $this->engine->render($template, $params);
    }

    public function send()
    {
        http_response_code($this->statusCode);
        foreach ($this->headers as $header) {
            header($header);
        }
        echo $this->content;
    }

    public function redirect(string $string)
    {
        header('Location: ' . $string);
        exit;
    }
}
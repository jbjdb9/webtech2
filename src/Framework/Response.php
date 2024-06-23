<?php

namespace App\Framework;

class Response
{
    private $statusCode = 200;
    private $headers = [];
    private $content;
    private $engine;
    private $data = [];

    public function __construct($templateDir)
    {
        $this->engine = new TemplateEngine($templateDir);
    }
    public function setStatusCode($code)
    {
        $this->statusCode = $code;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }
    public function setData($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function getData($key)
    {
        return $this->data[$key] ?? null;
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
        $params = array_merge($this->data, $params);
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

    public function addData(string $key, $value)
    {
        $this->data[$key] = $value;
    }
}
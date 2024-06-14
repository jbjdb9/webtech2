<?php

namespace App\Core;

class Response
{
    private $statusCode = 200;
    private $headers = [];
    private $content;

    public function setStatusCode($code)
    {
        $this->statusCode = $code;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setView($template, $params = [])
    {
        $engine = new TemplateEngine(__DIR__ . '/../View');
        $this->content = $engine->render($template, $params);
    }


    public function send()
    {
        http_response_code($this->statusCode);
        foreach ($this->headers as $header) {
            header($header);
        }
        echo $this->content;
    }
}

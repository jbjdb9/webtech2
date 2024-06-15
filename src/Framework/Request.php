<?php

namespace App\Framework;

class Request
{
    private $method;
    private $path;
    private $queryParams;
    private $body;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->path = strtok($_SERVER['REQUEST_URI'], '?');
        $this->queryParams = $_GET;
        $this->body = json_decode(file_get_contents('php://input'), true);
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getQueryParams()
    {
        return $this->queryParams;
    }

    public function getBody()
    {
        return $this->body;
    }
}

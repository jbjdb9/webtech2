<?php

namespace App\Framework;

abstract class BaseController
{
    protected $params;
    protected $response;

    public function __construct(Response $response)
    {
        $this->params = [];
        $this->setCommonParams();
        $this->response = $response;
    }

    //TODO: move authentication logic to framework
    protected function setCommonParams()
    {
        if (isset($_SESSION['role'])) {
            $this->params['@@ROLE'] = $_SESSION['role'];
        }

        if (isset($_SESSION['username'])) {
            $this->params['@@USERNAME'] = $_SESSION['username'];
        }

        if (isset($_SESSION['email'])) {
            $this->params['@@EMAIL'] = $_SESSION['email'];
        }

        if (isset($_SESSION['userId'])) {
            $this->params['@@USERID'] = $_SESSION['userId'];
        }
    }

    protected function renderTemplate($template, $params = [])
    {
        $params = array_merge($this->params, get_defined_vars(), $params);

        $this->response->setTemplate($template, $params);
    }

}
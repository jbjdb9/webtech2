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
    }

    protected function renderTemplate($template, $params = [])
    {
        // Merge the params array with the array of all defined variables
        $params = array_merge($this->params, get_defined_vars(), $params);

        // Use the Response object to set the template and parameters
        $this->response->setTemplate($template, $params);
    }

}
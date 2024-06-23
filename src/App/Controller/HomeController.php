<?php

namespace App\App\Controller;

use App\Framework\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        $this->renderTemplate('home.php');
    }
}
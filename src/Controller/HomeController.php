<?php

namespace App\Controller;

use App\Core\Request;
use App\Core\Response;

class HomeController
{
    public function index(Request $request, Response $response)
    {
        $response->setView('home.php');
    }
}
<?php

namespace App\Controller;

use App\Core\Request;
use App\Core\Response;

class HomeController
{
    public function index(Request $request, Response $response)
    {
        // Set the template and parameters for the response
        $response->setTemplate('home.php', [
            'controller_name' => 'HomeController',
        ]);
    }
}
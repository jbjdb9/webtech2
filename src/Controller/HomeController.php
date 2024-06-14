<?php

namespace App\Controller;

use App\Core\Request;
use App\Core\Response;

class HomeController
{
    public function index(Request $request, Response $response)
    {
        $username = 'John Doe';
        $score = 100;

        // Set the template and parameters for the response
        $response->setTemplate('home.php', [
            'controller_name' => 'HomeController',
            'username' => $username,
            'score' => $score
        ]);
    }
}
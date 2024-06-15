<?php

namespace App\Controller;

use App\Core\Request;
use App\Core\Response;

class HomeController
{
    public function index(Request $request, Response $response)
    {
        // Dummy data for now
        $username = 'John Doe';
        $score = 100;

        // Set the template and parameters for the response
        $response->setTemplate('home.php', [
            'username' => $username,
            'score' => $score
        ]);
    }
}
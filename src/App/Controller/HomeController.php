<?php

namespace App\App\Controller;

use App\Framework\Request;
use App\Framework\Response;

class HomeController
{
    public function index(Request $request, Response $response)
    {
        // Dummy data for now
        $username = 'John Doe';
        $score = 100;

        $response->setTemplate('home.php', [
            'username' => $username,
            'score' => $score
        ]);
    }
}
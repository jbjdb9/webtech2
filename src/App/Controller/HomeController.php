<?php

namespace App\App\Controller;

use App\Framework\Request;
use App\Framework\Response;

class HomeController
{
    public function index(Request $request, Response $response)
    {
        // Dummy data for now
        $score = 100;

        $role = $_SESSION['role'];

        $response->setTemplate('home.php', [
            'score' => $score,
            'role' => $role
        ]);
    }
}
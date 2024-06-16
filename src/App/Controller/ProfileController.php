<?php

namespace App\App\Controller;

use App\App\Services\UserService;
use App\Framework\Request;
use App\Framework\Response;

class ProfileController
{
    public function index(Request $request, Response $response, $params)
    {
        $response->setTemplate('profile.php');
    }
}
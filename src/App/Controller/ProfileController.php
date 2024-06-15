<?php

namespace App\App\Controller;

use App\App\Services\UserService;
use App\Framework\Request;
use App\Framework\Response;

class ProfileController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request, Response $response, $params)
    {
        $user = $this->userService->getUser($params['id']);

        if (!$user) {
            $response->setStatusCode(404);
            $response->setContent('User not found');
            $response->send();
            return;
        }

        $response->setTemplate('profile.php', $user);
    }
}
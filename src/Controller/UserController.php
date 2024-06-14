<?php

namespace App\Controller;

use App\Core\Request;
use App\Core\Response;

class UserController
{
    public function index(Request $request, Response $response, $params)
    {
        // TODO: dummy data, moet aan database gekoppeld worden
        $user = [
            'id' => $params['id'],
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
        ];

        if (!$user) {
            $response->setStatusCode(404);
            $response->setContent('User not found');
            $response->send();
            return;
        }

        $response->setTemplate('profile.php', $user);
    }
}
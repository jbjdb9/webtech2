<?php

namespace App\App\Controller;

use App\App\Database\ORM;
use App\Framework\Request;
use App\Framework\Response;

class ProfileController
{
    public function index(Request $request, Response $response, $params)
    {
        $userId = $_SESSION['userId'];
        $user = ORM::getUserById($userId);
        $username = $user ? $user->username : 'Guest';
        $email = $user ? $user->email : 'Not available';

        $response->setTemplate('profile.php', ['username' => $username, 'email' => $email]);
    }
}
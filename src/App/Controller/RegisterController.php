<?php

namespace App\App\Controller;

use App\App\Database\ORM;
use App\App\Model\User;
use App\Framework\Request;
use App\Framework\Response;

class RegisterController
{
    public function register(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $username = $request->getPost('username');
            $email = $request->getPost('email');
            $password = $request->getPost('password');

            if (empty($username) || empty($email) || empty($password)) {
                $response->setTemplate('register.php', ['error' => 'All fields are required.']);
                return;
            }

            $user = new User(null, $username, $email, $password, false);

            if (ORM::createUser($user)) {
                $response->redirect('/login');
            } else {
                $response->setTemplate('register.php', ['error' => 'Registration failed. Please try again.']);
            }
        } else {
            $response->setTemplate('register.php');
        }
    }
}
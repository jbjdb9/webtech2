<?php

namespace App\App\Controller;

use App\App\Database\ORM;
use App\App\Model\User;
use App\Framework\Request;
use App\Framework\Response;

class AuthController
{
    public function login(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $usernameOrEmail = $request->getPost('usernameOrEmail');
            $password = $request->getPost('password');

            $user = (new User())->login($usernameOrEmail, $password);

            if ($user) {
                // Start a session and store the user's ID and roles in it
                session_start();
                $_SESSION['userId'] = $user->getId();
                $_SESSION['roles'] = $user->getRoles();

                $response->redirect('/home');
            } else {
                $response->setTemplate('login.php', ['error' => 'Invalid username or email/password combination.']);
            }
        } else {
            $response->setTemplate('login.php');
        }
    }

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

            $user = new User();
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPassword($password);

            if (ORM::saveUser($user)) {
                $response->redirect('/login');
            } else {
                $response->setTemplate('register.php', ['error' => 'Registration failed. Please try again.']);
            }
        } else {
            $response->setTemplate('register.php');
        }
    }

    public function logout(Request $request, Response $response)
    {
        session_start();
        session_destroy();

        $response->redirect('/login');
    }
}
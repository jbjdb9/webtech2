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
                // User is authenticated successfully
                // Redirect to home page
                $response->redirect('/home');
            } else {
                // Authentication failed
                // Re-render the login page with an error message
                $response->setTemplate('login.php', ['error' => 'Invalid username or email/password combination.']);
            }
        } else {
            // Render the login page
            $response->setTemplate('login.php');
        }
    }

    public function register(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $username = $request->getPost('username');
            $email = $request->getPost('email');
            $password = $request->getPost('password');

            // Validate the input
            if (empty($username) || empty($email) || empty($password)) {
                // One or more fields are empty
                // Re-render the register page with an error message
                $response->setTemplate('register.php', ['error' => 'All fields are required.']);
                return;
            }

            $user = new User();
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPassword($password);

            if (ORM::saveUser($user)) {
                // User is registered successfully
                // Redirect to login page
                $response->redirect('/login');
            } else {
                // Registration failed
                // Re-render the register page with an error message
                $response->setTemplate('register.php', ['error' => 'Registration failed. Please try again.']);
            }
        } else {
            // Render the register page
            $response->setTemplate('register.php');
        }
    }
}
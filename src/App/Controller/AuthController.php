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

            if (empty($usernameOrEmail) || empty($password)) {
                error_log('Login failed: username or password not provided');
                $response->setTemplate('login.php');
                return;
            }

            $user = ORM::getUserByUsernameOrEmail($usernameOrEmail);

            if (!$user) {
                error_log('Login failed: no user found with provided username or email');
                $response->setTemplate('login.php');
                return;
            }

            if (!$user->verifyPassword($password)) {
                error_log('Login failed: provided password does not match stored password');
                $response->setTemplate('login.php');
                return;
            }

            $_SESSION['userId'] = $user->getId();
            if (empty($_SESSION['userId'])) {
                error_log('Login failed: unable to store user ID in session');
                $response->setTemplate('login.php');
                return;
            }

            error_log('User logged in, userId: ' . $_SESSION['userId']);
            $response->redirect('/home');
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

            // Create a new User object with the provided username, email, and password
            $user = new User($username, $email, $password);

            if (ORM::createUser($user)) {
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
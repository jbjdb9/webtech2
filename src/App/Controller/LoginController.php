<?php

namespace App\App\Controller;

use App\App\Database\ORM;
use App\App\Model\UserRole;
use App\Framework\Request;
use App\Framework\Response;

class LoginController
{
    public function login(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $usernameOrEmail = $request->getPost('usernameOrEmail');
            $password = $request->getPost('password');

//            if (empty($usernameOrEmail) || empty($password)) {
//                $this->handleFailedLogin($response, 'Login failed: username or password not provided');
//                return;
//            }

            $user = ORM::getUserByUsernameOrEmail($usernameOrEmail);

            if (!$user) {
                $this->handleFailedLogin($response, 'Invalid username or email');
                return;
            }

            if (!$user->verifyPassword($password)) {
                $this->handleFailedLogin($response, 'Incorrect password');
                return;
            }

            $_SESSION['userId'] = $user->getId();
            $_SESSION['role'] = UserRole::getRoleNameByUserId($user->getId());

//            if (empty($_SESSION['userId'])) {
//                $this->handleFailedLogin($response, 'Login failed: unable to store user ID in session');
//                return;
//            }

            error_log('User logged in, userId: ' . $_SESSION['userId'] . ', role: ' . $_SESSION['role']);
            $response->redirect('/home');
        } else {
            $response->setTemplate('login.php');
        }
    }

    private function handleFailedLogin(Response $response, $errorMessage)
    {
        error_log($errorMessage);
        $response->setTemplate('login.php', ['error' => $errorMessage]);
    }

    public function logout(Request $request, Response $response)
    {
        session_destroy();

        $response->redirect('/login');
    }
}
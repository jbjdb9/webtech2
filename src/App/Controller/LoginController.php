<?php

namespace App\App\Controller;

use App\App\Database\ORM;
use App\App\Model\UserRole;
use App\Framework\BaseController;
use App\Framework\Request;
use App\Framework\Response;

class LoginController extends BaseController
{
    public function login(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $usernameOrEmail = $request->getPost('usernameOrEmail');
            $password = $request->getPost('password');

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
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['role'] = UserRole::getRoleNameByUserId($user->getId());

            error_log('User logged in, userId: ' . $_SESSION['userId'] . ', role: ' . $_SESSION['role']);
            $response->redirect('/home');
        } else {
            $this->renderTemplate('login.php');
        }
    }

    private function handleFailedLogin(Response $response, $errorMessage)
    {
        error_log($errorMessage);
        $this->renderTemplate('login.php', ['error' => $errorMessage]);
    }

    public function logout(Request $request, Response $response)
    {
        session_destroy();

        $response->redirect('/login');
    }
}
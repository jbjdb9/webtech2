<?php

namespace App\App\Controller;

use App\App\Model\User;
use App\Framework\BaseController;
use App\Framework\Request;
use App\Framework\Response;

class ProfileController extends BaseController
{
    public function index()
    {
        $this->renderTemplate('profile.php');
    }

    public function updateProfile(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $username = $request->getPost('username');
            $email = $request->getPost('email');
            $password = $request->getPost('password');
            $confirm_password = $request->getPost('confirm_password');
            $current_password = $request->getPost('current_password');

            $currentUser = User::getById($_SESSION['userId']);

            if (password_verify($current_password, $currentUser->getPassword())) {
                if (!empty($username)) {
                    $currentUser->setUsername($username);
                    $_SESSION['username'] = $username; //TODO: move session logic to separate class
                }
                if (!empty($email)) {
                    $currentUser->setEmail($email);
                }
                if (!empty($password)) {
                    if ($password !== $confirm_password) {
                        $this->renderTemplate('profile.php', ['error' => 'Passwords do not match.']);
                        return;
                    }
                    $currentUser->setPassword(password_hash($password, PASSWORD_DEFAULT));
                }

                if ($currentUser->update()) {
                    $response->redirect('/profile');
                } else {
                    $this->renderTemplate('profile.php', ['error' => 'Update failed. Please try again.']);
                }
            } else {
                $this->renderTemplate('profile.php', ['error' => 'Incorrect current password.']);
            }
        } else {
            $this->renderTemplate('profile.php');
        }
    }
}
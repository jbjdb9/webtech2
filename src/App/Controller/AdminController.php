<?php

namespace App\App\Controller;

use App\App\Model\User;
use App\App\Model\UserRole;
use App\Framework\BaseController;
class AdminController extends BaseController
{
    public function index()
    {
        $users = User::getAll();
        $this->renderTemplate('admin.php', ['users' => $users]);
    }

    public function assignAdmin($request)
    {
        $userId = $request->getPost('id');
        UserRole::assignRole($userId, 2);
        header('Location: /admin');
        exit();
    }

    public function revokeAdmin($request)
    {
        $userId = $request->getPost('id'); //TODO: prevent revoking own access
        UserRole::revokeRole($userId, 2);
        header('Location: /admin');
        exit();
    }

    public function delete($request, $response, $params)
    {
        $id = $params['id'];
        $user = User::getById($id);
        $user->delete();
        $response->redirect('/admin');
    }
}
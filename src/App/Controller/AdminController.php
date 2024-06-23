<?php

namespace App\App\Controller;

use App\App\Model\User;
use App\Framework\BaseController;
class AdminController extends BaseController
{
    public function index()
    {
        $users = User::getAll();
        $this->renderTemplate('admin.php', ['users' => $users]);
    }
}
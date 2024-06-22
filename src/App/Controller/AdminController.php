<?php

namespace App\App\Controller;
use App\App\Database\ORM;
use App\Framework\BaseController;
class AdminController extends BaseController
{
    public function index()
    {
        $users = ORM::getAllUsers();
        $this->renderTemplate('admin.php', ['users' => $users]);
    }
}
<?php

namespace App\App\Controller;
use App\Framework\BaseController;
class AdminController extends BaseController
{
    public function index()
    {
        $this->renderTemplate('admin.php');
    }
}
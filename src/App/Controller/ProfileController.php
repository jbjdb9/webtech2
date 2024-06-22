<?php

namespace App\App\Controller;

use App\Framework\BaseController;

class ProfileController extends BaseController
{
    public function index()
    {
        $this->renderTemplate('profile.php');
    }
}
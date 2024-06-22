<?php

namespace App\App\Controller;

use App\Framework\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        // dummy data
        $score = 100;

        $this->renderTemplate('home.php', [
            'score' => $score
        ]);
    }
}
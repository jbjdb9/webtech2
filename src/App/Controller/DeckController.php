<?php

namespace App\App\Controller;
use App\Framework\BaseController;

class DeckController extends BaseController
{
    public function index()
    {
        $this->renderTemplate('decks.php');
    }
}
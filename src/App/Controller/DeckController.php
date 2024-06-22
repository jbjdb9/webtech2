<?php

namespace App\App\Controller;
use App\Framework\Request;
use App\Framework\Response;

class DeckController
{
    public function index(Request $request, Response $response)
    {
        $response->setTemplate('decks.php');
    }
}
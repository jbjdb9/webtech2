<?php

namespace App\App\Controller;

use App\Framework\Request;
use App\Framework\Response;

class CardController
{
    public function index(Request $request, Response $response)
    {
        $response->setContent('Welcome to the Trading Card Game');
        $response->send();
    }

    public function show(Request $request, Response $response)
    {
        // Logic to fetch and display cards
        $response->setContent('Display all cards');
        $response->send();
    }

    public function create(Request $request, Response $response)
    {
        // Logic to create a new card
        $response->setContent('Create a new card');
        $response->send();
    }

    public function delete(Request $request, Response $response)
    {
        // Logic to delete a card
        $response->setContent('Delete a card');
        $response->send();
    }
}

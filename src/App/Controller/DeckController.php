<?php

namespace App\App\Controller;
use App\App\Model\Deck;
use App\App\Model\Card;
use App\Framework\BaseController;
use App\Framework\Request;
use App\Framework\Response;

class DeckController extends BaseController
{
    public function index()
    {
        $this->renderTemplate('decks.php');
    }

    public function show(Request $request, Response $response, $params) {
        $deck = new Deck();
        $deck->loadById($params['id']);
        $this->renderTemplate('deck.php', ['deck' => $deck]);}
    public function create(Request $request, Response $response)
    {
        // Toon formulier om een nieuw deck te maken
    }

    public function store(Request $request, Response $response)
    {
        // Verwerk het formulier om een nieuw deck op te slaan
        // Valideer voor premiumgebruikers en het aantal kopieën van kaarten
    }

    public function edit(Request $request, Response $response, $params)
    {
        // Toon formulier om een bestaand deck te bewerken
    }

    public function update(Request $request, Response $response, $params)
    {
        // Verwerk het formulier om wijzigingen aan een deck op te slaan
        // Valideer opnieuw voor premiumgebruikers en het aantal kopieën van kaarten
    }

    public function delete(Request $request, Response $response, $params)
    {
        // Verwijder een deck
    }
}
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
        $decks = Deck::all(); 
        $this->renderTemplate('decks/index.php', ['decks' => $decks]);
    }

    public function show(Request $request, Response $response, $params)
    {
        $id = ($params['id']);
        $deck = Deck::getById($id);
        $cards = $deck->getCards();

        $this->renderTemplate('decks/show.php', [
            'name' => $deck->getName(),
            'id' => $deck->getId(),
            'cards' => $cards
        ]);
    }

    public function create(Request $request, Response $response)
    {
        $this->renderTemplate('decks/create.php');
    }

    public function store(Request $request, Response $response)
    {
        $deck = new Deck();
        $deck->setName($request->getPost('name'));
        $deck->setUserId($_SESSION['userId']);
        $deck->create();
        $response->redirect('/decks');
    }

    public function edit(Request $request, Response $response, $params)
    {
        $id = $params['id'];
        $deck = Deck::getById($id);

        $this->renderTemplate('decks/edit.php', [
            'name' => $deck->getName(),
            'id' => $deck->getId(),
        ]);
    }

    public function update(Request $request, Response $response, $params)
    {
        $id = $params['id'];
        $deck = Deck::getById($id);
        $deck->setName($request->getPost('name'));
        $deck->update();
        $response->redirect('/decks');
    }

    public function delete(Request $request, Response $response, $params)
    {
        $id = $params['id'];
        $deck = Deck::getById($id);
        $deck->delete();
        $response->redirect('/decks');
    }
}
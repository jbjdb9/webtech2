<?php

namespace App\App\Controller;

use App\App\Model\Card;
use App\App\Model\Deck;
use App\Framework\BaseController;
use App\Framework\Request;
use App\Framework\Response;

class CardController extends BaseController
{
    public function index()
    {
        $cards = Card::getAll();
        $this->renderTemplate('cards/index.php', ['cards' => $cards]);
    }

    public function show(Request $request, Response $response, $params)
    {
        $id = $params['id'];
        $card = Card::getById($id);

        if ($card === null) {
            $response->redirect('/cards');
            return;
        }

        $decks = Deck::getAllByUserId($_SESSION['userId']);

        $this->renderTemplate('cards/show.php', [
            'name' => $card->getName(),
            'attack' => $card->getAttack(),
            'defense' => $card->getDefense(),
            'rarity' => $card->getRarity(),
            'market_price' => $card->getPrice(),
            'id' => $card->getId(),
            'decks' => $decks
        ]);
    }

    public function removeCardFromDeck(Request $request, Response $response)
    {
        $deckId = $request->getPost('deckId');
        $cardId = $request->getPost('cardId');

        $deck = Deck::getById($deckId);
        $card = Card::getById($cardId);

        if ($deck && $card) {
            $deck->removeCard($card);
            $response->redirect('/decks/' . $deck->id);
        } else {
            $response->setStatusCode(404);
        }

        return $response;
    }

    public function addCardToDeck(Request $request, Response $response)
    {
        $deckId = $request->getPost('deck_id');
        $cardId = $request->getPost('card_id');

        $deck = Deck::getById($deckId);
        $card = Card::getById($cardId);

        if ($deck && $card) {
            $deck->addCard($card);
            $response->redirect('/cards/' . $cardId);
        } else {
            $response->setStatusCode(404);
        }

        return $response;
    }

    public function edit(Request $request, Response $response, $params)
    {
        $id = $params['id'];
        $card = Card::getById($id);
        $this->renderTemplate('cards/edit.php', [
            'name' => $card->getName(),
            'attack' => $card->getAttack(),
            'defense' => $card->getDefense(),
            'rarity' => $card->getRarity(),
            'market_price' => $card->getPrice(),
            'id' => $card->getId()
        ]);
    }

    public function create(Request $request, Response $response)
    {
        $this->renderTemplate('cards/create.php');
    }

    public function store(Request $request, Response $response)
    {
        $card = new Card();
        $card->setName($request->getPost('name'));
        $card->setAttack($request->getPost('attack'));
        $card->setDefense($request->getPost('defense'));
        $card->setRarity($request->getPost('rarity'));
        $card->setPrice($request->getPost('price'));
        $card->setSetId($request->getPost('set'));
        $card->create();

        $response->setStatusCode(201);
        $response->redirect('/cards');
        return $response;
    }

    public function delete(Request $request, Response $response, $args)
    {
        $id = (string) $args['id'];
        $card = Card::getById($id);

        if ($card === null) {
            $response->setStatusCode(404);
            return $response;
        }

        $card->delete();

        $response->setStatusCode(200);
        $response->redirect('/cards');
        return $response;
    }
}
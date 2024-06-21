<?php

namespace App\App\Controller;

use App\App\Model\Card;
use App\App\Model\User;
use App\App\Model\UserRole;
use App\Framework\TemplateEngine;
use App\Framework\Response;
use App\Framework\Request;

class CardController
{
    protected $card;
    protected $user;
    protected $userRole;
    protected $templateEngine;

    public function __construct(TemplateEngine $templateEngine, Card $card, User $user, UserRole $userRole)
    {
        $this->card = $card;
        $this->user = $user;
        $this->userRole = $userRole;
        $this->templateEngine = $templateEngine;
    }

    public function index(Request $request, Response $response)
    {
        $cards = $this->card->all();
        $response->setTemplate('cards/index.php', ['cards' => $cards]);
        return $response;
    }

    public function show(Request $request, Response $response, $id)
    {
        $card = $this->card->find($id);
        $response->setTemplate('cards/show.php', ['card' => $card]);
        return $response;
    }

    public function create(Request $request, Response $response)
    {
        $role = $this->userRole->getRoleNameByUserId($this->user->getId());

        if ($role !== 'admin') {
            $response->setStatusCode(401);
            return $response;
        }

        $response->setTemplate('cards/create.php');
        return $response;
    }

    public function store(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $role = $this->userRole->getRoleNameByUserId($this->user->getId());

            if ($role !== 'admin') {
                $response->setStatusCode(401);
                return $response;
            }

            $card = new Card();
            $card->name = $request->getPost('name');
            $card->attack = $request->getPost('attack');
            $card->defense = $request->getPost('defense');
            $card->set = $request->getPost('set');
            $card->rarity = $request->getPost('rarity');
            $card->market_price = $request->getPost('market_price');
            $card->save();

            $response->setStatusCode(201);
            return $response;
        }
    }

    public function delete(Request $request, Response $response, $id)
    {
        $role = $this->userRole->getRoleNameByUserId($this->user->getId());

        if ($role !== 'admin') {
            $response->setStatusCode(401);
            return $response;
        }

        $card = $this->card->find($id);
        $card->delete();

        $response->setStatusCode(200);
        return $response;
    }
}
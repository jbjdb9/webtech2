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

    public function index(Request $request)
    {
        $cards = $this->card->all();
        $response = new Response();
        $response->setTemplate('cards/index.php', ['cards' => $cards]);
        return $response;
    }

    public function show(Request $request, $id)
    {
        $card = $this->card->find($id);
        $response = new Response();
        $response->setTemplate('cards/show.php', ['card' => $card]);
        return $response;
    }

    public function create(Request $request)
    {
        $role = $this->userRole->getRoleNameByUserId($this->user->getId());

        if ($role !== 'admin') {
            $response = new Response();
            $response->setStatusCode(401);
            return $response;
        }

        $response = new Response();
        $response->setTemplate('cards/create.php');
        return $response;
    }

    public function store(Request $request)
    {
        $role = $this->userRole->getRoleNameByUserId($this->user->getId());

        if ($role !== 'admin') {
            $response = new Response();
            $response->setStatusCode(401);
            return $response;
        }

        $card = new Card();
        // Set card properties from $request
        // $card->setTitle($request->get('title'));
        // $card->setDescription($request->get('description'));
        $card->save();

        $response = new Response();
        $response->setStatusCode(201);
        return $response;
    }

    public function delete(Request $request, $id)
    {
        $role = $this->userRole->getRoleNameByUserId($this->user->getId());

        if ($role !== 'admin') {
            $response = new Response();
            $response->setStatusCode(401);
            return $response;
        }

        $card = $this->card->find($id);
        $card->delete();

        $response = new Response();
        $response->setStatusCode(200);
        return $response;
    }
}
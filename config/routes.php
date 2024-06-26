<?php

use App\App\Controller\AdminController;
use App\App\Controller\DeckController;
use App\App\Controller\LoginController;
use App\App\Controller\CardController;
use App\App\Controller\HomeController;
use App\App\Controller\ProfileController;
use App\App\Controller\RegisterController;
use App\App\Middleware\AccessMiddleware;
use App\Framework\Router;

$router = new Router();

$router->get('/', [HomeController::class, 'index']);
$router->get('/home', [HomeController::class, 'index']);

$router->get('/cards', [CardController::class, 'index']);
$router->get('/cards/create', [CardController::class, 'create']);
$router->post('/cards/create', [CardController::class, 'store']);
$router->get('/cards/{id}', [CardController::class, 'show']);
$router->get('/cards/{id}/edit', [CardController::class, 'edit']);
$router->post('/cards/{id}/delete', [CardController::class, 'delete']);

$router->get('/decks', [DeckController::class, 'index']);
$router->get('/decks/create', [DeckController::class, 'create']);
$router->post('/decks/create', [DeckController::class, 'store']);
$router->get('/deck/{id}', [DeckController::class, 'show']);
$router->get('/deck/{id}/edit', [DeckController::class, 'edit']);
$router->post('/deck/{id}/update', [DeckController::class, 'update']);
$router->get('/deck/{id}/delete', [DeckController::class, 'delete']);
$router->post('/addCardToDeck', [CardController::class, 'addCardToDeck']);
$router->post('/removeCardFromDeck', [CardController::class, 'removeCardFromDeck']);

$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->get('/register', [RegisterController::class, 'register']);
$router->post('/register', [RegisterController::class, 'register']);

$router->get('/admin', [AdminController::class, 'index']);
$router->post('/admin/{id}/delete', [AdminController::class, 'delete']);
$router->post('/admin/{id}/assign-admin', [AdminController::class, 'assignAdmin']);
$router->post('/admin/{id}/revoke-admin', [AdminController::class, 'revokeAdmin']);

$router->get('/profile', [ProfileController::class, 'index']);
$router->post('/profile/buy-premium', [ProfileController::class, 'buyPremium']);
$router->post('/profile/update', [ProfileController::class, 'updateProfile']);
$router->get('/user/{id}', [ProfileController::class, 'index']);

$router->addMiddleware(new AccessMiddleware());

return $router;
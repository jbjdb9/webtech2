<?php

use App\App\Controller\AdminController;
use App\App\Controller\DeckController;
use App\App\Controller\LoginController;
use App\App\Controller\CardController;
use App\App\Controller\HomeController;
use App\App\Controller\ProfileController;
use App\App\Controller\RegisterController;
use App\App\Middleware\AuthMiddleware;
use App\Framework\Router;

$router = new Router();

$router->get('/', [CardController::class, 'index']);
$router->get('/home', [HomeController::class, 'index']);

$router->get('/cards', [CardController::class, 'index']);
$router->get('/cards/create', [CardController::class, 'create']); //TODO: fix bug where it consider this as an {id} path if placed after that route
$router->post('/cards/create', [CardController::class, 'store']);
$router->get('/cards/{id}', [CardController::class, 'show']);
$router->get('/cards/{id}/edit', [CardController::class, 'edit']);
$router->post('/cards/{id}/delete', [CardController::class, 'delete']);

$router->get('/decks', [DeckController::class, 'index']);

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
$router->post('/profile/update', [ProfileController::class, 'updateProfile']);
$router->get('/user/{id}', [ProfileController::class, 'index']);

$router->addMiddleware(new AuthMiddleware());

return $router;
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

$router->get('/cards', [CardController::class, 'show']);
$router->post('/cards', [CardController::class, 'create']);
$router->delete('/cards', [CardController::class, 'delete']);

$router->get('/decks', [DeckController::class, 'index']);

$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->get('/register', [RegisterController::class, 'register']);
$router->post('/register', [RegisterController::class, 'register']);

$router->get('/admin', [AdminController::class, 'index']);
$router->get('/profile', [ProfileController::class, 'index']);
$router->get('/user/{id}', [ProfileController::class, 'index']);

$router->addMiddleware(new AuthMiddleware());

return $router;
<?php

use App\App\Controller\AuthController;
use App\App\Controller\CardController;
use App\App\Controller\HomeController;
use App\App\Controller\ProfileController;
use App\App\Middleware\AuthMiddleware;
use App\Framework\Router;

$router = new Router();

$router->get('/', [CardController::class, 'index']);
$router->get('/home', [HomeController::class, 'index']);
$router->get('/cards', [CardController::class, 'show']);
$router->post('/cards', [AuthMiddleware::class => 'admin', CardController::class, 'create']);
$router->delete('/cards', [AuthMiddleware::class => 'admin', CardController::class, 'delete']);
$router->get('/user/{id}', [ProfileController::class, 'index']);
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout']);
$router->get('/register', [AuthController::class, 'register']);
$router->post('/register', [AuthController::class, 'register']);

$router->addMiddleware(new AuthMiddleware());

return $router;
<?php

use App\App\Controller\CardController;
use App\App\Controller\HomeController;
use App\App\Controller\ProfileController;
use App\App\Middleware\AuthMiddleware;
use App\Framework\Router;

$router = new Router();

$router->get('/', [CardController::class, 'index']);
$router->get('/home', [HomeController::class, 'index']);
$router->get('/cards', [CardController::class, 'show']);
$router->post('/cards', [AuthMiddleware::class, CardController::class, 'create']);
$router->delete('/cards', [AuthMiddleware::class, CardController::class, 'delete']);
$router->get('/user/{id}', [ProfileController::class, 'index']);

return $router;
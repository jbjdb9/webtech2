<?php

use App\Controller\CardController;
use App\Controller\HomeController;
use App\Controller\UserController;
use App\Core\Router;
use App\Middleware\AuthMiddleware;

$router = new Router();

$router->get('/', [CardController::class, 'index']);
$router->get('/home', [HomeController::class, 'index']);
$router->get('/cards', [CardController::class, 'show']);
$router->post('/cards', [AuthMiddleware::class, CardController::class, 'create']);
$router->delete('/cards', [AuthMiddleware::class, CardController::class, 'delete']);
$router->get('/user/{id}', [UserController::class, 'index']);

return $router;
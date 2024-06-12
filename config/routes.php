<?php

use App\Controller\CardController;
use App\Middleware\AuthMiddleware;

$router->get('/', [CardController::class, 'index']);
$router->get('/cards', [CardController::class, 'show']);
$router->post('/cards', [AuthMiddleware::class, CardController::class, 'create']);
$router->delete('/cards', [AuthMiddleware::class, CardController::class, 'delete']);

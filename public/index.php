<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\App\Services\UserService;
use App\Framework\Container;
use App\Framework\Request;
use App\Framework\Response;
use App\Framework\Router;

// Initialize the container
$container = new Container();

// Add UserService to the container
$container->set(UserService::class, function() {
    return new UserService();
});

$request = new Request();
$response = new Response();

// Pass the container to the Router
$router = new Router($container);

$router = require_once __DIR__ . '/../config/routes.php';

$router->dispatch($request, $response);

$response->send();

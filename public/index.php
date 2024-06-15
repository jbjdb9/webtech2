<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Core\Request;
use App\Core\Response;
use App\Container\Container;
use App\Services\UserService;

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

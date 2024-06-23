<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\App\Services\UserService;
use App\Framework\Container;
use App\Framework\Request;
use App\Framework\Response;
use App\Framework\Router;

$container = new Container();

$container->set(UserService::class, function() {
    return new UserService();
});

$request = new Request();

$templateDir = __DIR__ . '/../src/App/View';
$response = new Response($templateDir);

$router = new Router();

$router = require_once __DIR__ . '/../config/routes.php';

$router->dispatch($request, $response);

$response->send();
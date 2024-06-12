<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Core\Request;
use App\Core\Response;

$request = new Request();
$response = new Response();
$router = new Router();

require_once __DIR__ . '/../config/routes.php';

$router->dispatch($request, $response);

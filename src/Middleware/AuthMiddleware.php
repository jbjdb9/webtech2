<?php

namespace App\Middleware;

use App\Core\Request;
use App\Core\Response;

class AuthMiddleware
{
    public function __invoke(Request $request, Response $response, callable $next)
    {
        // Auth logic here

        // Call the next middleware/controller
        return $next($request, $response);
    }
}

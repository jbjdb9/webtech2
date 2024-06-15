<?php

namespace App\App\Middleware;

use App\Framework\Request;
use App\Framework\Response;

class AuthMiddleware
{
    public function __invoke(Request $request, Response $response, callable $next)
    {
        // Auth logic here

        // Call the next middleware/controller
        return $next($request, $response);
    }
}

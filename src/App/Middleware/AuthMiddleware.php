<?php

namespace App\App\Middleware;

class AuthMiddleware
{
    public function __invoke($request, $response, $next)
    {
        session_start();
        error_log('Session started');
        $allowedPaths = ['/login', '/register'];
        if (!isset($_SESSION['userId']) && !in_array($request->getPath(), $allowedPaths)) {
            header('Location: /login');
            exit();
        }

        return $next($request, $response);
    }
}
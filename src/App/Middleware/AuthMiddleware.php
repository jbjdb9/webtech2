<?php

namespace App\App\Middleware;

class AuthMiddleware
{
    public function __invoke($request, $response, $next, $role)
    {
        session_start();

        if (!isset($_SESSION['roles']) || !in_array($role, $_SESSION['roles'])) {
            header('Location: /login');
            exit();
        }

        return $next($request, $response);
    }
}
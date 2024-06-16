<?php

namespace App\App\Middleware;

class AuthMiddleware
{
    public function __invoke($request, $response, $next)
    {
        session_start();
        error_log('Session started');
        $allowedPaths = ['/login', '/register']; // accessible without login
        $adminPaths = ['/admin']; // accessible only by Admins

        if (!isset($_SESSION['userId']) && !in_array($request->getPath(), $allowedPaths)) {
            header('Location: /login');
            exit();
        }

        if (in_array($request->getPath(), $adminPaths) && $_SESSION['role'] !== 'Admin') {
            header('Location: /home');
            exit();
        }

        return $next($request, $response);
    }
}
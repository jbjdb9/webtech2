<?php

namespace App\App\Middleware;

class AccessMiddleware
{
    public function __invoke($request, $response, $next)
    {
        session_start();
        error_log('Session started');
        $allowedPaths = ['/login', '/register']; // accessible without login
        $premiumPaths = ['/decks']; // accessible only by Premium users or Admins
        $adminPaths = ['/admin', 'cards/create', 'cards/{id}/edit', 'users/{id}/delete']; // accessible only by Admins

        if (!in_array($request->getPath(), $allowedPaths) && !isset($_SESSION['userId'])) {
            header('Location: /login');
            exit();
        }

        if (in_array($request->getPath(), $premiumPaths) && !in_array($_SESSION['role'], ['Premium', 'Admin'])) {
            header('Location: /home');
            exit();
        }

        if (in_array($request->getPath(), $adminPaths) && $_SESSION['role'] !== 'Admin') {
            header('Location: /home');
            exit();
        }

        return $next($request, $response);
    }
}
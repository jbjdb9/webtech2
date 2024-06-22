<?php

namespace App\App\Middleware;

//TODO: rename this class to AccessMiddleware
class AuthMiddleware
{
    public function __invoke($request, $response, $next)
    {
        session_start();
        error_log('Session started');
        $allowedPaths = ['/login', '/register']; // accessible without login
        $premiumPaths = ['/decks']; // accessible only by Premium users
        $adminPaths = ['/admin']; // accessible only by Admins

        if (!in_array($request->getPath(), $allowedPaths) && !isset($_SESSION['userId'])) {
            header('Location: /login');
            exit();
        }

        //TODO: Premium OR Admin
        if (in_array($request->getPath(), $premiumPaths) && $_SESSION['role'] !== 'Premium') {
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
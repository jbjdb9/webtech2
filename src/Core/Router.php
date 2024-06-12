<?php

namespace App\Core;

class Router
{
    private $routes = [];

    public function get($path, $handler)
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post($path, $handler)
    {
        $this->addRoute('POST', $path, $handler);
    }

    public function delete($path, $handler)
    {
        $this->addRoute('DELETE', $path, $handler);
    }

    private function addRoute($method, $path, $handler)
    {
        $this->routes[] = compact('method', 'path', 'handler');
    }

    public function dispatch(Request $request, Response $response)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $request->getMethod() && $route['path'] === $request->getPath()) {
                list($class, $method) = $route['handler'];
                (new $class)->$method($request, $response);
                return;
            }
        }

        $response->setStatusCode(404);
        $response->setContent('Not Found');
        $response->send();
    }
}

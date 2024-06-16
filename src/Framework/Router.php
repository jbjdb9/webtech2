<?php

namespace App\Framework;

class Router
{
    private $routes = [];
    private $middleware = [];

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

    public function addMiddleware($middleware)
    {
        $this->middleware[] = $middleware;
    }

    private function addRoute($method, $path, $handler)
    {
        $pattern = preg_replace('#\{([a-z]+)}#', '(?P<$1>[^/]+)', $path);
        $pattern = '#^' . $pattern . '$#';

        $this->routes[] = compact('method', 'pattern', 'handler');
    }

    public function dispatch(Request $request, Response $response)
    {
        $next = function ($request, $response) {
            foreach ($this->routes as $route) {
                if ($route['method'] === $request->getMethod()) {
                    if (preg_match($route['pattern'], $request->getPath(), $matches)) {
                        $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                        list($class, $method) = $route['handler'];
                        (new $class)->$method($request, $response, $params);
                        return;
                    }
                }
            }

            $response->setStatusCode(404);
            $response->setContent('Not Found');
            $response->send();
        };

        foreach ($this->middleware as $middleware) {
            $next = function ($request, $response) use ($middleware, $next) {
                return $middleware($request, $response, $next);
            };
        }

        $next($request, $response);
    }
}
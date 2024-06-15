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

    /**
     * Adds a new route to the router.
     *
     * This method converts paths with parameters (like `/user/{id}`) into regular expressions
     * and stores the route in the `$routes` array.
     *
     * @param string $method The HTTP method of the route (GET, POST, DELETE, etc.).
     * @param string $path The path of the route, possibly containing parameters (like `/user/{id}`).
     * @param array $handler An array containing the class and method that will handle the request.
     */
    private function addRoute($method, $path, $handler)
    {
        $pattern = preg_replace('#\{([a-z]+)}#', '(?P<$1>[^/]+)', $path);
        $pattern = '#^' . $pattern . '$#';

        $this->routes[] = compact('method', 'pattern', 'handler');
    }

    /**
     * Dispatches the request to the appropriate route handler.
     *
     * This method matches the request path against the route patterns and extracts the parameters.
     * It then creates an instance of the handler class and calls the handler method, passing the request,
     * response, and parameters to it.
     *
     * If no matching route is found, it sets the response status code to 404 and the content to 'Not Found'.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     */
    public function dispatch(Request $request, Response $response)
    {
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
    }
}
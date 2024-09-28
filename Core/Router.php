<?php

namespace Core;

use Core\Middlewares;

class Router
{
    private $routes = [];

    private function register(string $uri, string $method, string $controller): self
    {
        $this->routes[] = [
            'uri' => $uri,
            'method' => $method,
            'controller' => "HTTP/Controllers/$controller.php",
            'middleware' => null
        ];

        return $this;
    }

    private function abort(int $code = Response::NOT_FOUND): void
    {
        http_response_code($code);
        view($code);
        die();
    }

    public function only(string $key): self
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
        return $this;
    }

    public function get(string $uri, string $controller): self
    {
        return $this->register($uri, 'GET', $controller);
    }

    public function post(string $uri, string $controller): self
    {
        return $this->register($uri, 'POST', $controller);
    }

    public function put(string $uri, string $controller): self
    {
        return $this->register($uri, 'PUT', $controller);
    }

    public function delete(string $uri, string $controller): self
    {
        return $this->register($uri, 'DELETE', $controller);
    }

    public function patch(string $uri, string $controller): self
    {
        return $this->register($uri, 'PATCH', $controller);
    }

    public function route(string $uri, string $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {

                if ($route['middleware']) {
                    Middlewares::resolve($route['middleware']);
                }

                require base_path($route['controller']);
                return;
            }
        }

        // 404 Not Found
        $this->abort();
    }
}

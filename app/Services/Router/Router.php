<?php

namespace Stack\Services\Router;

class Router
{
    private $routes = [];

    public function method($method, $path, $target)
    {
        $method = strtolower($method);
        
        $this->routes[$method][$path] = $target;
    }

    public function get($path, $target)
    {
        return $this->method('get', $path, $target);
    }

    public function post($path, $target)
    {
        return $this->method('post', $path, $target);
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}

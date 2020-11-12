<?php

namespace Stack\Services\Router;

use Symfony\Component\HttpFoundation\Request;

class RouterManager
{
    private $app;
    private $routesPath = '/routes/app.php';

    public function handle(Request $request)
    {
        $router = new Router();

        $register = function (Router $router) {
            include $this->routesPath();
        };

        $register($router);

        [$class, $matches] = $this->routeFromRequest($request, $router);

        $controller = $class
            ? app()->make($class)->withMatch($matches)
            : app()->make(\Stack\Controllers\Error::class)->withCode(404);

        return $controller();
    }

    private function routeFromRequest(Request $request, Router $router)
    {
        $routes = $router->getRoutes();
        $method = strtolower($request->getMethod());

        foreach ($routes[$method] as $route => $target) {
            if (preg_match("/^{$route}$/", $request->getPathInfo(), $matches)) {
                return [$target, $matches];
            }
        }

        return [null, null];
    }

    private function routesPath(): string
    {
        return BASE_PATH . $this->routesPath;
    }

    public function setRoutesPath(string $path): void
    {
        $this->routesPath = $path;
    }
}

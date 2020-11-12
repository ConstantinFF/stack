<?php

namespace Stack\Services;

use Stack\Services\Router\RouterManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Application
{
    private $providers = [
        Providers\MailProvider::class,
        Providers\LoggerProvider::class,
        Providers\AuthProvider::class,
        Providers\RepositoryProvider::class,
        Providers\DatabaseProvider::class,
    ];

    public function __construct()
    {
        $this->boot();
    }

    public function handle($request): Response
    {
        $this->registerRequest($request);

        try {
            $response = app()->make(RouterManager::class)->handle($request);
        } catch (\Throwable $throwable) {
            $response = app()->make(ExceptionHandler::class)->handle($throwable, $request);
        }

        $response->prepare($request);

        return $response;
    }

    public function handleCommand($className)
    {
        app()->make($className)();
    }

    private function registerRequest($request)
    {
        app()->bind(Request::class, function () use ($request) {
            return $request;
        });
    }

    private function boot()
    {
        foreach ($this->providers as $provider) {
            (new $provider)->register();
        }
    }
}

<?php

namespace Stack\Services;

use Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;

class ExceptionHandler
{
    private $logger;

    protected $exceptionHandlers = [
        \Symfony\Component\Security\Core\Exception\AccessDeniedException::class => 'handleAccessDeniedException',
    ];

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function handle(\Throwable $throwable, Request $request)
    {
        $exceptionClass = get_class($throwable);

        if (isset($this->exceptionHandlers[$exceptionClass])) {
            return call_user_func_array([$this, $this->exceptionHandlers[$exceptionClass]], [$throwable, $request]);
        }

        if (getenv('APP_ENV') === 'production') {
            return $this->handleProductionException($throwable, $request);
        } else {
            throw $throwable;
        }
    }

    protected function handleAccessDeniedException(\Throwable $throwable, $request)
    {
        return redirect('/login');
    }

    protected function handleProductionException(\Throwable $throwable, $request)
    {
        $this->logger->error($throwable);

        return app()->make(\Stack\Controllers\Error::class)
            ->withCode(500)();
    }
}

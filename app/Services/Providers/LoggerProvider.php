<?php

namespace Stack\Services\Providers;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoggerProvider implements ProviderInterface
{
    public function register(): void
    {
        app()->singleton(Logger::class, function () {
            $log = new Logger('errors');
            $log->pushHandler(new StreamHandler(BASE_PATH . '/storage/error.log', Logger::ERROR));
            
            return $log;
        });
    }
}

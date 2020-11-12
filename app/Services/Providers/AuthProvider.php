<?php

namespace Stack\Services\Providers;

use Stack\Services\Auth\Session;
use Stack\Services\Auth\AuthInterface;

class AuthProvider implements ProviderInterface
{
    public function register(): void
    {
        app()->bind(AuthInterface::class, Session::class);
    }
}

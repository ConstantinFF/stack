<?php

namespace Tests;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

trait HasSession
{
    protected function hasSession()
    {
        app()->bind(Session::class, function () {
            return new Session(new MockFileSessionStorage());
        });
    }
}

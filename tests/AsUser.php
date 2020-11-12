<?php

namespace Tests;

use Stack\Models\User;
use Stack\Services\SessionAuth;
use Stack\Services\Auth\AuthInterface;

trait AsUser
{
    protected function as(User $user)
    {
        app()->bind(AuthInterface::class, function () use ($user) {
            return \Mockery::mock(SessionAuth::class, AuthInterface::class)
                ->shouldReceive('user')
                ->andReturn($user)
                ->mock();
        });
        
        return $this;
    }
}

<?php

namespace Stack\Services\Providers;

use Stack\Repository\Eloquent\BaseRepository;
use Stack\Repository\Eloquent\PostRepository;
use Stack\Repository\Eloquent\UserRepository;
use Stack\Repository\PostRepositoryInterface;
use Stack\Repository\UserRepositoryInterface;
use Stack\Repository\EloquentRepositoryInterface;

class RepositoryProvider implements ProviderInterface
{
    public function register(): void
    {
        app()->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        app()->bind(UserRepositoryInterface::class, UserRepository::class);
        app()->bind(PostRepositoryInterface::class, PostRepository::class);
    }
}

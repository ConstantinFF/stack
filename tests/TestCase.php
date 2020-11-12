<?php

namespace Tests;

use Symfony\Component\HttpFoundation\Request;
use Mockery\Adapter\Phpunit\MockeryTestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use HasDatabase;
    use HasSession;
    use AsUser;

    protected $app;

    protected function setUp(): void
    {
        define('BASE_PATH', realpath(__DIR__ . '/..'));

        $this->app = app()->make(\Stack\Services\Application::class);
        
        parent::setUp();
    }

    protected function request($method, $path, $data = [])
    {
        return $this->app->handle(
            Request::create(
                $path,
                $method,
                $data
            )
        );
    }
}

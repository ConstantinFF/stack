<?php

namespace Tests\Unit;

use Tests\TestCase;

class RouterTest extends TestCase
{
    public function testRouterGetMethod()
    {
        $router = app()->make(\Stack\Services\Router\Router::class);

        $router->method('get', '/', 'home');

        $this->assertSame(['get' => ['/' => 'home']], $router->getRoutes());
    }

    public function testRouterMultipleMethods()
    {
        $router = app()->make(\Stack\Services\Router\Router::class);

        $router->get('/', 'home');
        $router->post('/', 'post-home');

        $this->assertSame([
            'get' => ['/' => 'home'],
            'post' => ['/' => 'post-home'],
        ], $router->getRoutes());
    }

    public function testOverrideSamePath()
    {
        $router = app()->make(\Stack\Services\Router\Router::class);

        $router->get('/foo-bar', 'fooBar');
        $router->get('/foo-bar', 'fooBar');
        $router->get('/foo-bar', 'fooBar');

        $this->assertSame([
            'get' => ['/foo-bar' => 'fooBar'],
        ], $router->getRoutes());
    }

    public function testCaseInsensitiveMethods()
    {
        $router = app()->make(\Stack\Services\Router\Router::class);

        $router->method('gEt', '/foo-bar', 'fooBar');

        $this->assertSame([
            'get' => ['/foo-bar' => 'fooBar'],
        ], $router->getRoutes());
    }

    public function testCustomMethods()
    {
        $router = app()->make(\Stack\Services\Router\Router::class);

        $router->method('AWESOME', '/foo-bar', 'awesome');

        $this->assertSame([
            'awesome' => ['/foo-bar' => 'awesome'],
        ], $router->getRoutes());
    }
}

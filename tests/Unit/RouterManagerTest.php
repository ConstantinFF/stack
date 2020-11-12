<?php

namespace Tests\Unit;

use Tests\TestCase;
use Symfony\Component\HttpFoundation\Request;

class RouterManagerTest extends TestCase
{
    public function testRouterManagerReturnsController()
    {
        $manager = app()->make(\Stack\Services\Router\RouterManager::class);

        $manager->setRoutesPath('/tests/Unit/fixtures/routes.php');

        $request = Request::create(
            '/hello-world',
            'GET',
            ['foo' => 'bar']
        );

        $this->assertSame('foo-bar', $manager->handle($request));
    }
}

class HelloWorldController extends \Stack\Controllers\Controller
{
    public function __invoke()
    {
        return 'foo-bar';
    }
}

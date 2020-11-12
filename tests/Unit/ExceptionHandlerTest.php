<?php

namespace Tests\Unit;

use Tests\TestCase;
use Stack\Services\ExceptionHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ExceptionHandlerTest extends TestCase
{
    public function testHandleExceptions()
    {
        $handler = app()->make(ExceptionHandler::class);

        $exception = new \Exception();
        $request = Request::create(
            '/',
            'get'
        );

        $this->expectException(\Exception::class);

        $handler->handle($exception, $request);
    }

    public function testHandleAccessDeniedException()
    {
        $handler = app()->make(ExceptionHandler::class);
        $exception = new AccessDeniedException();
        $request = Request::create(
            '/',
            'get'
        );

        $response = $handler->handle($exception, $request);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('/login', $response->headers->get('location'));
    }

    public function testLogProductionException()
    {
        putenv('APP_ENV=production');

        $logger = \Mockery::mock(\Monolog\Logger::class);

        $logger->shouldReceive('error')
            ->once();

        $handler = new ExceptionHandler($logger);

        $exception = new \Exception();
        $request = Request::create(
            '/',
            'get'
        );

        $this->assertEquals(200, $handler->handle($exception, $request)->getStatusCode());

        putenv('APP_ENV=');
    }
}

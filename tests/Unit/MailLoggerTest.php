<?php

namespace Tests\Unit;

use Tests\TestCase;

class MailLoggerTest extends TestCase
{
    public function testRenderText()
    {
        $view = \Mockery::mock(\Stack\Services\View\View::class);

        $view->shouldReceive('create')
            ->once();

        $view->shouldReceive('render')
            ->once()
            ->andReturn('my test message');

        $mail = \Mockery::mock(\Stack\Services\Mail\Logger::class, [$view])->makePartial();

        $mail->shouldReceive('send')
            ->once()
            ->andReturn(true);

        $mail->create('foo_bar')
            ->to('user@foo')
            ->from('stack@test')
            ->send();
    }
}

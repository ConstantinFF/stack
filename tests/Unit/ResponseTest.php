<?php

namespace Tests\Unit;

use Tests\TestCase;

class ResponseTest extends TestCase
{
    public function testStringResponse()
    {
        $response = app()->make(\Stack\Services\Response::class)
            ->create('awesome strings !@#$', 200, []);

        $this->assertEquals('awesome strings !@#$', $response->getContent());
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testViewResonse()
    {
        $view = app()->make(\Stack\Services\View\View::class);
        $view->setTemplatePath('/tests/Unit/fixtures');

        $view->create('template');

        $response = app()->make(\Stack\Services\Response::class)
            ->create($view, 200, []);

        $this->assertEquals('FOO-BAR', $response->getContent());
    }
}

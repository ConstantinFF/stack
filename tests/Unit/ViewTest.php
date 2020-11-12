<?php

namespace Tests\Unit;

use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testRenderText()
    {
        $view = app()->make(\Stack\Services\View\View::class);
        $view->setTemplatePath('/tests/Unit/fixtures');

        $view->create('template');

        $this->assertEquals('FOO-BAR', $view->render());
    }

    public function testInlinePhpCode()
    {
        $view = app()->make(\Stack\Services\View\View::class);
        $view->setTemplatePath('/tests/Unit/fixtures');

        $view->create('template_with_inline_code');

        $this->assertEquals('awesome', $view->render());
    }

    public function testPassedVariables()
    {
        $view = app()->make(\Stack\Services\View\View::class);
        $view->setTemplatePath('/tests/Unit/fixtures');

        $view->create('template_with_variables', ['content' => 'my awesome new page']);

        $this->assertEquals('my awesome new page', $view->render());
    }
}

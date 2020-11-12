<?php

namespace Tests\Unit;

use Tests\TestCase;

class ApplicationTest extends TestCase
{
    public function testCreateApplicationInstance()
    {
        $this->assertTrue($this->app instanceof \Stack\Services\Application);
    }
}

<?php

namespace Tests;

use Illuminate\Database\Capsule\Manager as Capsule;

trait HasDatabase
{
    protected function migrate(): self
    {
        $this->app->handleCommand(\Stack\Commands\DatabaseMigrate::class);

        return $this;
    }

    protected function database(): Capsule
    {
        return new Capsule;
    }
}

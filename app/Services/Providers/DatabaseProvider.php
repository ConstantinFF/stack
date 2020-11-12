<?php

namespace Stack\Services\Providers;

use Illuminate\Database\Capsule\Manager as Capsule;

class DatabaseProvider implements ProviderInterface
{
    public function register(): void
    {
        $capsule = new Capsule;
        
        $capsule->addConnection([
            'driver'    => 'sqlite',
            'database'  => getenv('DATABASE'),
        ]);

        $capsule->setAsGlobal();
        
        $capsule->bootEloquent();
    }
}

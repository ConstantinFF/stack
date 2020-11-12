<?php

namespace Stack\Commands;

class DatabaseMigrate
{
    public function __invoke()
    {
        include BASE_PATH . '/database/migrations/migration.php';
    }
}

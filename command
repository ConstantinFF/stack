<?php

require __DIR__ . '/vendor/autoload.php';

$app = app()->make(\Stack\Services\Application::class);

define('BASE_PATH', realpath(__DIR__));

$app->handleCommand(
    'Stack\\Commands\\' . $argv[1]
);

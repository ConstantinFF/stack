<?php

define('BASE_PATH', realpath(__DIR__ . '/..'));

require __DIR__ . '/../vendor/autoload.php';

$app = app()->make(\Stack\Services\Application::class);

$response = $app->handle(
    Symfony\Component\HttpFoundation\Request::createFromGlobals()
);

$response->send();

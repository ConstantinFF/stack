<?php

use Stack\Services\Response;
use Stack\Services\View\View;
use Illuminate\Container\Container;
use Symfony\Component\HttpFoundation\RedirectResponse;

if (! function_exists('app')) {
    function app()
    {
        return Container::getInstance();
    }
}

if (! function_exists('response')) {
    function response($content = '', $status = 200, array $headers = [])
    {
        $factory = app()->make(Response::class);

        return $factory->create($content, $status, $headers);
    }
}

if (! function_exists('view')) {
    function view($template, $params = [])
    {
        $view = app()->make(View::class);
        
        $view->create($template, $params);

        return response($view, $view->getStatusCode(), $view->getHeaders());
    }
}

if (! function_exists('redirect')) {
    function redirect($to, $status = 302, $headers = [])
    {
        return new RedirectResponse($to, $status, $headers);
    }
}

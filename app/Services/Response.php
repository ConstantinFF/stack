<?php

namespace Stack\Services;

use Stack\Services\View\View;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class Response
{
    public function create($content, int $status, array $headers)
    {
        $content = $content instanceof View ? $content->render() : $content;

        $response = new SymfonyResponse($content, $status, $headers);

        return $response;
    }
}

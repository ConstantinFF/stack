<?php

namespace Stack\Controllers;

class Error extends Controller
{
    private $code = 500;

    public function __invoke()
    {
        return view('error', ['code' => $this->code]);
    }

    public function withCode(int $code)
    {
        $this->code = $code;

        return $this;
    }
}

<?php

namespace Stack\Controllers;

class Login extends Controller
{
    public function __invoke()
    {
        return view('login');
    }
}

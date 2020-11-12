<?php

namespace Stack\Controllers;

use Stack\Services\Auth\AuthInterface;
use Stack\Controllers\Traits\HasAccess;
use Symfony\Component\HttpFoundation\Request;

class Ask extends Controller
{
    use HasAccess;

    private $auth;

    private $request;

    public function __construct(AuthInterface $auth, Request $request)
    {
        $this->auth = $auth;
        $this->request = $request;

        parent::__construct();
    }

    protected function access()
    {
        return $this->auth->user();
    }

    public function __invoke()
    {
        $this->auth->user()
            ->posts()
            ->create($this->request->request->all());

        return redirect('/');
    }
}

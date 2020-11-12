<?php

namespace Stack\Controllers;

use Stack\Models\User;
use Stack\Services\Auth\AuthInterface;
use Symfony\Component\HttpFoundation\Request;

class Authenticate extends Controller
{
    private $request;

    private $auth;

    public function __construct(Request $request, AuthInterface $auth)
    {
        $this->request = $request;
        $this->auth = $auth;
    }

    public function __invoke()
    {
        $user = User::where('email', $this->request->request->get('email'))->first();

        if ($user && $this->validatePassword($user, $this->request->request->get('password'))) {
            $this->auth->authenticateUser($user);

            return redirect('/');
        }

        return redirect('login');
    }

    private function validatePassword($user, $password): bool
    {
        return password_verify($password, $user->password);
    }
}

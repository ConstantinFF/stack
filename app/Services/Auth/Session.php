<?php

namespace Stack\Services\Auth;

use Stack\Models\User;
use Symfony\Component\HttpFoundation\Session\Session as SymfonySession;

class Session implements AuthInterface
{
    private $user;

    private $session;

    public function __construct(SymfonySession $session)
    {
        $this->session = $session;
    }

    public function user():? User
    {
        return $this->user
            ? $this->user
            : $this->user = $this->getUserFromSession();
    }

    public function authenticateUser(User $user): void
    {
        $this->session->start();

        $this->session->set('user_id', $user->id);
    }

    private function getUserFromSession()
    {
        $userId = $this->session->get('user_id');

        return $userId ? User::find($userId) : null;
    }
}

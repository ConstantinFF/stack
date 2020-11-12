<?php

namespace Stack\Services\Auth;

use Stack\Models\User;

interface AuthInterface
{
    public function user():? User;

    public function authenticateUser(User $user): void;
}

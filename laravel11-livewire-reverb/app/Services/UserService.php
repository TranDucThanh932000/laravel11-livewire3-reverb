<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\User\UserInterface;

class UserService
{
    public function __construct(
        private UserInterface $user,
    ) {
        $this->user = $user;
    }

    public function createUser($username, $password) : User | bool | null
    {
        return $this->user->createUser($username, $password);
    }

    public function authencation($username, $password) : bool
    {
        return $this->user->authentication($username, $password);
    }
}

<?php

namespace App\Repositories\User;

use App\Models\User;

interface UserInterface
{
    public function authentication($username, $password) : bool;
    public function createUser($username, $password) : User | bool | null;
}
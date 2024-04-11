<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    public function __construct(
        private User $user,
    ) {
        $this->user = $user;
    }

    public function createUser($username, $password): User | bool | null
    {
        return $this->user->create([
            'name' => fake()->text(20),
            'username' => $username,
            'email' => fake()->email(),
            'password' => Hash::make($password),
        ]);
    }

    public function authentication($username, $password): bool
    {
        $credentials = [
            'username' => $username,
            'password' => $password,
        ];

        return Auth::attempt($credentials);
    }
}

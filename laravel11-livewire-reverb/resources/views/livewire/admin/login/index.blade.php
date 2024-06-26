<?php

use App\Services\UserService;
use function Livewire\Volt\{layout, rules, state, title, uses};
use Mary\Traits\Toast;

uses([Toast::class]);

layout('components.layouts.login');
title('Login');

state('username');
state('password');

rules(['username' => 'required|min:6', 'password' => 'required|min:6']);

//or create class Form for login and validate on it
// form(PostForm::class);

$save = function (UserService $userService) {
    $this->validate();
    $user = $userService->authencation($this->username, $this->password);
    if (!$user) {
        return $this->error('Username or password is not correct', timeout: 2000);
    }
    $this->success('Logged in successfully');
    return $this->redirect('/admin/users/list');
}

?>

<x-card title="" subtitle="" progress-indicator separator style="width: 600px; margin: 0px auto;border-radius: 16px;padding: 16px;">
    <x-mary-form wire:submit="save">
        <x-mary-input label="Username" wire:model="username" class="input_username"/>
        <x-mary-input label="Password" wire:model="password" type="password" />

        <div style="display: flex; justify-content: center;">
            <x-mary-button label="Login" class="btn-primary" type="submit" spinner="save" />
        </div>
    </x-mary-form>
</x-card>

@script
    <script>
        let inputUsername = document.querySelector('.input_username')
        window.addEventListener('DOMContentLoaded', () => {
            inputUsername.focus()
        })
    </script>
@endscript
<?php
use App\Services\UserService;

use function Livewire\Volt\mount;

mount(function (UserService $userService) {
    $userService->logout();
    return redirect()->to('/admin/login');
})
?>
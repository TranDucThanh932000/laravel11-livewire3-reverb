<?php

use App\Livewire\UserList;
use Illuminate\Support\Facades\Route;

Route::get('/', UserList::class);
Route::get('/dashboard', function() {
    return view('vendor.pulse.dashboard');
});
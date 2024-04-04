<?php

namespace App\Livewire;

use App\Jobs\UserCreate;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class UserList extends Component
{
    // use LivewireAlert;

    public $users;

    public function mount()
    {
        $this->users = User::all()->toArray();
    }

    #[On('echo:channel_for_everyone,GotUserCreated')]
    public function onGotUserCreated($event) {
        $this->users[] = $event['user'];
        $this->alert('success', 'Add new user success');
    }

    public function createUser() {
        $newUser = User::create([
            'name' => fake()->text(20),
            'email' => fake()->email(),
            'password' => Hash::make(fake()->password(8, 16)),
        ]);

        UserCreate::dispatch($newUser);
    }

    public function render()
    {

        return view('livewire.user-list', [
            'users' => $this->users,
        ]);
    }
}

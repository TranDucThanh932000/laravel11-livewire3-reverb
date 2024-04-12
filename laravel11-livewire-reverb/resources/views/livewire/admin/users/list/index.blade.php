<?php

use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Mary\Traits\Toast;

new class extends Component {
    use Toast;

    public string $search = '';

    public bool $drawer = false;

    public array $sortBy = ['column' => 'id', 'direction' => 'asc'];

    public int $userId = 0;

    public bool $isOpenModal = false;

    public function confirmDelete($id): void
    {
        $this->userId = $id;
        $this->isOpenModal = true;
    }

    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'email', 'label' => 'E-mail', 'sortable' => false],
        ];
    }

    public function users(): Collection
    {
        return User::all()
        ->sortBy([[...array_values($this->sortBy)]])
        ->when($this->search, function (Collection $collection) {
            return $collection->filter(fn(array $item) => str($item['name'])->contains($this->search, true));
        });
    }

    public function with(): array
    {
        return [
            'users' => $this->users(),
            'headers' => $this->headers()
        ];
    }

    #[On('handleClose')] 
    public function handleClose(): void
    {
        $this->isOpenModal = false;
    }

    #[On('handleConfirm')] 
    public function handleConfirm(): void
    {
        $this->isOpenModal = false;
        $this->warning("Will delete #$this->userId", 'It is fake.', position: 'toast-bottom');
    }
}; ?>

<div>
    <!-- HEADER -->
    <x-mary-header title="" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-mary-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-mary-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" />
        </x-slot:actions>
    </x-mary-header>

    <!-- TABLE  -->
    <x-card>
        <x-mary-table :headers="$headers" :rows="$users" :sort-by="$sortBy">
            @scope('actions', $user)
            <x-mary-button icon="o-trash" wire:click="confirmDelete({{ $user['id'] }})" spinner class="btn-ghost btn-sm text-red-500" />
            @endscope
        </x-mary-table>
    </x-card>

    <!-- FILTER DRAWER -->
    <x-mary-drawer wire:model="drawer" title="Filters" right separator with-close-button class="lg:w-1/3">
        <x-mary-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass" @keydown.enter="$wire.drawer = false" />

        <x-slot:actions>
            <x-mary-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
            <x-mary-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
        </x-slot:actions>
    </x-mary-drawer>

    @if($isOpenModal)
        <livewire:components.modal 
            title="Confirm dialog"
            subtitle="Are you sure?"
        />
    @endif
</div>

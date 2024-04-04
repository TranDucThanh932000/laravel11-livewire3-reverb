<?php

use Livewire\Volt\Component;

    new class extends Component {
        public string $title = '';
        public string $subtitle = '';

        public function mount($title, $subtitle = '')
        {
            $this->title = $title;
            $this->subtitle = $subtitle;
        }

        public function cancel()
        {
            $this->dispatch('handleClose');
        }

        public function confirm()
        {
            $this->dispatch('handleConfirm');
        }
    }
?>

<div>
    <x-mary-modal persistent class="backdrop-blur" :title="$title" :subtitle="$subtitle">
        <x-slot:actions>
            <x-mary-button label="Cancel" wire:click="cancel" />
            <x-mary-button label="Confirm" wire:click="confirm" class="btn-primary" />
        </x-slot:actions>
    </x-mary-modal>
</div>
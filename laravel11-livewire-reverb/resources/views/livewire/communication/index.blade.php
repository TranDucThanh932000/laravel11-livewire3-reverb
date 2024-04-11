<?php

use App\Jobs\SendMessage;

use function Livewire\Volt\{dehydrate, on, rules, state, title};

title('Communication');
state(['messageTyping']);
state(['messages' => [
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
    'Message for testing',
]]);

$send = function () {
    SendMessage::dispatch($this->messageTyping);
    $this->messageTyping = '';
};

on(['echo:channel_for_everyone,SendMessage' => function ($event) {
    $this->messages[] = $event['message'];
}]);
?>

<x-card separator progress-indicator="send" style="height: 88vh;">
    <x-card style="max-height:92%;overflow-y: scroll;" class="message_screen" id="conversation">
        @foreach($this->messages as $index => $msg)
            <p wire:key="msg_{{ $index }}">{{ $msg }}</p>
        @endforeach
    </x-card>
    <div style="display: flex;width: 100%;">
        <div style="width: 90%">
            <x-mary-input wire:model="messageTyping" wire:keydown.enter="send" class="input_message"/>
        </div>
        <div style="width: 10%; display: flex; justify-content: end;">
            <x-mary-button label="Send" icon="c-chat-bubble-left-right" wire:click="send" />
        </div>
    </div>
</x-card>

@script
    <script>
        let container = document.querySelector('#conversation')
        let inputMsg = document.querySelector('.input_message')
        window.addEventListener('DOMContentLoaded', () => {
            scrollDown()
            inputMsg.focus()
        })

        Livewire.hook('element.init', () => {
            if (container.scrollTop + container.clientHeight + 100 < container.scrollHeight) {
                return
            }
            scrollDown()
        })

        // window.addEventListener('scrollDown', () => {
        //     console.log('scroll down hook', Livewire)
        //     Livewire.hook('element.processed', () => {
        //         console.log('hook')
        //         if (container.scrollTop + container.clientHeight + 100 < container.scrollHeight) {
        //             return
        //         }
        //         scrollDown()
        //     })
        // })

        function scrollDown() {
            container.scrollTop = container.scrollHeight + 100
        }
    </script>
@endscript
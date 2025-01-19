<?php

namespace App\Livewire;

use Livewire\Component;

class ChatComponent extends Component
{
    public function render()
    {
        return view('livewire.chat-component');
    }
    public $messages = [];
    public $newMessage = '';

    public function sendMessage()
    {
        $this->messages[] = '<span class="blue">You: </span><br><span class="lp">' . $this->newMessage . '</span>';
        $this->newMessage = ''; // Clear the input field after sending a message
        $this->dispatch('openChat');
    }
}

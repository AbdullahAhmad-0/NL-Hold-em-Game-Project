<?php

namespace App\Livewire;
use App\Models\Chat;

use Livewire\Component;

class Chats extends Component
{
    public $id_r;
    public $sender;
    public $chats;
    public function mount($id_r, $sender)
    {
        $this->id_r = $id_r;
        $this->sender = $sender;
        $id_1 = session('id');
        $id_2 = $this->id_r;
        
        $chats = Chat::where(function ($query) use ($id_1, $id_2) {
            $query->where('user1', $id_1)->where('user2', $id_2)
                ->orWhere('user1', $id_2)->where('user2', $id_1);
        })->first();

        if (!$chats) {
            $chats = new Chat();
            $chats->user1 = $id_1;
            $chats->user2 = $id_2;
            $chats->save();
        }
        $this->chats = $chats;
    }
    public function updatedData()
    {
        $id_1 = session('id');
        $id_2 = $this->id_r;

        $chats = Chat::where(function ($query) use ($id_1, $id_2) {
            $query->where('user1', $id_1)->where('user2', $id_2)
                ->orWhere('user1', $id_2)->where('user2', $id_1);
        })->first();

        if (!$chats) {
            $chats = new Chat();
            $chats->user1 = $id_1;
            $chats->user2 = $id_2;
            $chats->save();
        }
        $this->chats = $chats;
    }
    public function updated($propertyName)
    {
        $this->updatedData();
    }
    public function render()
    {
        return view('livewire.chats');
    }
    protected $listeners = ['externalEventTriggered' => 'updatedData'];
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TalkToMe extends Component
{
    public $msg;
    public $goodList;

    public function mount()
    {
        $this->goodList = (new \App\Services\ChatBot)->goodMessageList();
    }

    function getResponse()
    {
        $response = (new \App\Services\ChatBot)->processMessage($this->msg);
        $this->dispatchBrowserEvent('response-received', ['response'=>$response]);
    }

    public function render()
    {
        return view('livewire.talk-to-me');
    }
}

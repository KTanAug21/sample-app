<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TalkToMe extends Component
{
    public $msg;
    public $goodList;

    public function mount()
    {
        $this->goodList = array_keys((new \App\Models\ChatBot)->goodMessageList());
    }

    function getResponse()
    {
        $response = (new \App\Models\ChatBot)->processMessage($this->msg);
        $this->dispatchBrowserEvent('response-received', ['response'=>$response]);
    }

    public function render()
    {
        return view('livewire.talk-to-me');
    }
}

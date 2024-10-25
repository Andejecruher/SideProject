<?php

namespace App\Http\Livewire\Tags;

use Livewire\Component;

class Tags extends Component
{
    public $message;
    public $messageError;

    protected $listeners = ['showMessageEmit' => 'showMessage'];

    public function showMessage($message)
    {
        $this->message = $message;
    }

    public function render()
    {
        return view('livewire.tags.tags');
    }
}

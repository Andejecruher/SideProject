<?php

namespace App\Http\Livewire\Tags;

use Livewire\Component;

/**
 * Class Tags
 *
 * This Livewire component handles the management and display of tags.
 */
class Tags extends Component
{


    /**
     * The message to be displayed.
     *
     * @var string
     */
    public $message;

    /**
     * The error message to be displayed.
     *
     * @var string
     */
    public $messageError;

    /**
     * The listeners for the component.
     *
     * @var array
     */
    protected $listeners = ['showMessageEmit' => 'showMessage'];

    /**
     * Show a message.
     *
     * @param string $message
     * @return void
     */
    public function showMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.tags.tags');
    }
}

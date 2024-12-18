<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;

class Users extends Component
{
    /**
     * Render the Livewire component.
     *
     * This method is used to render the Livewire component view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.users.users'); // Return the view for the Livewire component
    }
}

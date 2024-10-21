<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;

class Categories extends Component
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
        return view('livewire.categories.categories'); // Return the view for the Livewire component
    }
}

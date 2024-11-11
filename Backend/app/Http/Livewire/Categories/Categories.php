<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;

class Categories extends Component
{

    /** 
     * Constructor
     * 
     * Apply middleware to protect routes with permissions.
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:categories.index', ['only' => ['index']]);
    }
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

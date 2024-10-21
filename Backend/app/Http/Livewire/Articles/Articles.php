<?php

namespace App\Http\Livewire\Articles;

use Livewire\Component;

class Articles extends Component
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
        return view('livewire.articles.articles'); // Return the view for the Livewire component
    }
}

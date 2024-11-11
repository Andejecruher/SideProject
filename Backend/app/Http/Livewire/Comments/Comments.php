<?php

namespace App\Http\Livewire\Comments;

use Livewire\Component;

class Comments extends Component
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
        return view('livewire.comments.article-comments'); // Return the view for the Livewire component
    }
}

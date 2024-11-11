<?php

namespace App\Http\Livewire\Comments;

use Livewire\Component;

class Comments extends Component
{
    /** 
     * Constructor
     * 
     * Apply middleware to protect routes with permissions.
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('comments:articles.index', ['only' => ['index']]);
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
        return view('livewire.comments.article-comments'); // Return the view for the Livewire component
    }
}

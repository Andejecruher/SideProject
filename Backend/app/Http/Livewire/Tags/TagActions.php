<?php

namespace App\Http\Livewire\Tags;

use Livewire\Component;

/**
 * Class TagActions
 *
 * This Livewire component handles the actions related to tags.
 */
class TagActions extends Component
{
    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.tag-actions');
    }
}

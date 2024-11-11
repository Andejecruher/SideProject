<?php

namespace App\Http\Livewire;

use Livewire\Component;

/**
 * Class Err500
 *
 * This Livewire component handles the display of the 500 error page.
 */
class Err404 extends Component
{
    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('404');
    }
}

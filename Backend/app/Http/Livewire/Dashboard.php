<?php

namespace App\Http\Livewire;

use Livewire\Component;

/**
 * Class Dashboard
 *
 * This Livewire component handles the display of the dashboard.
 */
class Dashboard extends Component
{
    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('dashboard');
    }
}

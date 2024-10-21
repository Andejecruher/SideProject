<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class Logout extends Component
{
    /**
     * Log out the authenticated user.
     *
     * This method logs out the authenticated user and redirects to the login page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        auth()->logout(); // Log out the authenticated user
        return redirect('/login'); // Redirect to the login page
    }

    /**
     * Render the Livewire component.
     *
     * This method renders the Livewire component view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.auth.logout'); // Return the view for the Livewire component
    }
}

<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Register extends Component
{
    public $email = ''; // Email address of the user
    public $password = ''; // Password of the user
    public $passwordConfirmation = ''; // Password confirmation

    /**
     * Mount the component.
     *
     * This method checks if the user is already authenticated.
     * If the user is authenticated, it redirects to the dashboard.
     *
     * @return void
     */
    public function mount()
    {
        if (auth()->user()) {
            return redirect()->intended('/dashboard'); // Redirect to dashboard if user is authenticated
        }
    }

    /**
     * Validate the email field when it is updated.
     *
     * @return void
     */
    public function updatedEmail()
    {
        $this->validate(['email' => 'required|email:rfc,dns|unique:users']); // Validate the email field
    }

    /**
     * Handle the registration process.
     *
     * This method validates the input data and creates a new user.
     * If successful, the user is logged in and redirected to the profile page.
     *
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function register()
    {
        $this->validate([
            'email' => 'required|email:rfc,dns|unique:users', // Validate the email field
            'password' => 'required|same:passwordConfirmation|min:6', // Validate the password field
        ]);

        // Create a new user
        $user = User::create([
            'email' => $this->email, // Set the email
            'password' => Hash::make($this->password), // Hash and set the password
            'remember_token' => Str::random(10), // Generate a random remember token
        ]);

        // Log in the user
        auth()->login($user);

        // Redirect to the profile page
        return redirect('/profile');
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
        return view('livewire.auth.register'); // Return the view for the Livewire component
    }
}

<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ResetPassword extends Component
{
    public $email = ''; // Email address of the user
    public $password = ''; // New password of the user
    public $passwordConfirmation = ''; // Password confirmation
    public $isPasswordChanged = false; // Flag to indicate if the password has been changed
    public $wrongEmail = false; // Flag to indicate if the email is incorrect
    public $urlId = ''; // ID from the URL

    // Validation rules
    public $rules = [
        'email' => 'required|email|exists:users', // Email must be required, valid, and exist in the users table
        'password' => 'required|same:passwordConfirmation|min:6', // Password must be required, match the confirmation, and be at least 6 characters long
    ];

    // Custom validation messages
    protected $messages = [
        'email.exists' => 'The Email Address must be in our database.', // Custom message for email existence validation
    ];

    /**
     * Validate the email field when it is updated.
     *
     * @return void
     */
    public function updatedEmail()
    {
        $this->validate(['email' => 'required|email|exists:users']); // Validate the email field
    }

    /**
     * Mount the component with the given ID.
     *
     * @param int $id
     * @return void
     */
    public function mount($id)
    {
        $existingUser = User::find($id); // Find the user by ID
        $this->urlId = intval($existingUser->id); // Set the URL ID
    }

    /**
     * Reset the user's password.
     *
     * @return void
     */
    public function resetPassword()
    {
        $this->validate(); // Validate the input data

        $existingUser = User::where('email', $this->email)->first(); // Find the user by email

        if ($existingUser && $existingUser->id == $this->urlId) {
            // Update the user's password
            $existingUser->update([
                'password' => Hash::make($this->password)
            ]);

            $this->isPasswordChanged = true; // Set the password changed flag
            $this->wrongEmail = false; // Reset the wrong email flag
        } else {
            $this->wrongEmail = true; // Set the wrong email flag
        }
    }

    /**
     * Render the Livewire component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.auth.reset-password'); // Return the view for the Livewire component
    }
}

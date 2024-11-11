<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

class Login extends Component
{

    public $email = ''; // Email address of the user
    public $password = ''; // Password of the user
    public $remember_me = false; // Remember me option for the login

    protected $rules = [
        'email' => 'required|email:rfc,dns', // Validation rule for email
        'password' => 'required|min:6', // Validation rule for password
    ];

    public function mount()
    {
        // Check if the user is already authenticated
        if (auth()->user()) {
            // Redirect to the dashboard if the user is authenticated
            return redirect()->intended('/dashboard');
        }

        // Fill the default credentials for the admin
    }

    public function login()
    {
        // Validate the input data
        $credentials = $this->validate();

        // Attempt to log in the user with the provided credentials
        if (auth()->attempt(['email' => $this->email, 'password' => $this->password], $this->remember_me)) {
            // Retrieve the user by email
            $user = User::where(['email' => $this->email])->first();

            // Log in the user
            auth()->login($user, $this->remember_me);

            // Redirect to the dashboard
            return redirect()->intended('/dashboard');
        } else {
            // Add error message to the email field if authentication fails
            return $this->addError('email', trans('auth.failed'));
        }
    }

    public function render()
    {
        // Return the view for the Livewire component
        return view('livewire.auth.login');
    }
}

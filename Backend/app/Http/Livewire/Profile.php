<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

/**
 * Class Profile
 *
 * This Livewire component handles the user profile management.
 */
class Profile extends Component
{
    /**
     * The user instance.
     *
     * @var \App\Models\User
     */
    public User $user;

    /**
     * Indicates if the saved alert should be shown.
     *
     * @var bool
     */
    public $showSavedAlert = false;

    /**
     * Indicates if the demo notification should be shown.
     *
     * @var bool
     */
    public $showDemoNotification = false;

    /**
     * Validation rules for the user profile.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user.first_name' => 'max:15',
            'user.last_name' => 'max:20',
            'user.email' => 'email',
            'user.gender' => ['required', Rule::in(['male', 'female', 'other'])],
            'user.address' => 'required',
            'user.phone' => 'numeric',
            'user.city' => 'max:50',
            'user.postal_code' => 'numeric',
        ];
    }

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->user = auth()->user();
    }

    /**
     * Save the user profile.
     *
     * @return void
     */
    public function save()
    {
        $this->validate();

        $this->user->save();

        $this->showSavedAlert = true;
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.profile');
    }
}

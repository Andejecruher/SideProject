<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{

    /**
     * Constructor
     *
     * Apply middleware to protect routes with permissions.
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:users.index', ['only' => ['index']]);
        $this->middleware('permission:users.show', ['only' => ['show']]);
        $this->middleware('permission:users.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:users.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:users.destroy', ['only' => ['destroy']]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the create form view
        return view('livewire.users.form');
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Return the edit form view with the user data
        return view('livewire.users.form', compact('user'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate form data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            // Add validations for other fields here
        ]);

        // If validation fails, redirect back with errors and input
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new user instance
        $user = new User();
        $user->fill($request->except('avatar', 'password'));

        // Check if an avatar has been uploaded
        if ($request->hasFile('avatar')) {
            // Save the new avatar
            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->storeAs('public/avatars', $avatarName);
            // Update the user's avatar field
            $user->avatar = $avatarName;
        } else {
            // Set a default avatar if no avatar is uploaded
            $user->avatar = '';
        }

        // Hash the password
        $user->password = Hash::make($request->password);

        // Save the user to the database
        $user->save();

        // Redirect to the users list with a success message
        return redirect()->route('users-list')->with('success', __('User created successfully'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Validate form data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            // Add validations for other fields here
        ]);

        // If validation fails, redirect back with errors and input
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check if a new avatar has been uploaded
        if ($request->hasFile('avatar')) {
            // Delete the previous image if it exists
            if ($user->avatar && Storage::exists('public/avatars/' . $user->avatar)) {
                Storage::delete('public/avatars/' . $user->avatar);
            }

            // Save the new avatar
            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->storeAs('public/avatars', $avatarName);

            // Update the user's avatar field
            $user->avatar = $avatarName;
        }

        // Update other user fields
        $user->fill($request->except('avatar', 'password'));

        // Hash the password if it is provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save the user to the database
        $user->save();

        // Redirect to the users list with a success message
        return redirect()->route('users-list')->with('success', __('User updated successfully'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Delete the avatar image if it exists
        if ($user->avatar && Storage::exists('public/avatars/' . $user->avatar)) {
            Storage::delete('public/avatars/' . $user->avatar);
        }

        // Delete the user
        $user->delete();

        // Redirect to the users list with a success message
        return redirect()->route('users-list')->with('success', __('User deleted successfully'));
    }
}

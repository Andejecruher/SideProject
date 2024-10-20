<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('articulos');
        // Aplicar filtros de búsqueda si se proporcionan en la consulta
        if ($request->has('name')) {
            $users->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->has('email')) {
            $users->where('email', 'like', '%' . $request->input('email') . '%');
        }
        $itemsPorPagina = $request->input('per_page', 10);
        $paginaActual = $request->input('current_page', 1);
        $data = $users->paginate($itemsPorPagina, ['*'], 'page', $paginaActual);

        if ($request->expectsJson()) {
            return response()->json($data, 200);
        }

        return redirect()->route('users-list');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user, 200);
    }

    public function create()
    {
        return view('livewire.users.form');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('livewire.users.form', compact('user'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Agrega aquí las validaciones para otros campos
        ]);

        $user = new User();
        $user->fill($request->except('avatar'));

        // Verificar si se ha cargado un avatar
        if ($request->hasFile('avatar')) {
            // Guardar el nuevo avatar
            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->storeAs('public/avatars', $avatarName);

            // Actualizar el campo avatar del usuario
            $user->avatar = $avatarName;
        }
        $user->password = Hash::make($request->password);
        $user->save();

        if ($request->expectsJson()) {
            return response()->json($user, 201);
        }

        return redirect()->route('users-list')->with('success', 'User created successfully');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validar los datos del formulario
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Agrega aquí las validaciones para otros campos
        ]);

        // Verificar si se ha cargado un nuevo avatar
        if ($request->hasFile('avatar')) {
            // Eliminar la imagen anterior si existe
            if ($user->avatar && Storage::exists('public/avatars/' . $user->avatar)) {
                Storage::delete('public/avatars/' . $user->avatar);
            }

            // Guardar el nuevo avatar
            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->storeAs('public/avatars', $avatarName);

            // Actualizar el campo avatar del usuario
            $user->avatar = $avatarName;
        }

        // Actualizar otros campos del usuario
        $user->fill($request->except('avatar'));
        $user->save();

        if ($request->expectsJson()) {
            return response()->json($user, 200);
        }

        return redirect()->route('users-list')->with('success', 'User updated successfully');
    }

    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Eliminar la imagen del avatar si existe
        if ($user->avatar && Storage::exists('public/avatars/' . $user->avatar)) {
            Storage::delete('public/avatars/' . $user->avatar);
        }

        $user->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'User deleted successfully'], 200);
        }

        return redirect()->route('users-list')->with('success', 'User deleted successfully');
    }
    // Otros métodos del controlador según las necesidades.
}

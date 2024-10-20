<!-- resources/views/users/form.blade.php -->

<x-layouts.app>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item">
                            <a href="/users-list">
                                <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ isset($user) ? __("Edit User") : __("Create User") }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="container">
            <h1>{{ isset($user) ? __("Edit User") : __("Create User") }}</h1>
            <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($user))
                @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="first_name" class="form-label">{{ __("First Name") }}</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label">{{ __("Last Name") }}</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="avatar" class="form-label">{{ __("Avatar") }}</label>
                    <input type="file" class="form-control" id="avatar" name="avatar" onchange="previewAvatar(event)">
                    @if(isset($user) && $user->avatar)
                    @php
                    $avatar = asset('storage/avatars/' . $user->avatar);
                    @endphp
                    <div class="d-flex justify-content-center mt-2">
                        <img id="avatar-preview" src="{{ $avatar }}" alt="User Avatar" class="img-thumbnail mt-2" width="100">
                    </div>
                    @else
                    <div class="d-flex justify-content-center mt-2">
                        <img id="avatar-preview" src="{{ asset('assets/img/avatars/default.png') }}" alt="Default Avatar" class="img-thumbnail mt-2" width="100">
                    </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">{{ __("Gender") }}</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="male" {{ old('gender', $user->gender ?? '') == 'male' ? 'selected' : '' }}>{{ __("Male") }}</option>
                        <option value="female" {{ old('gender', $user->gender ?? '') == 'female' ? 'selected' : '' }}>{{ __("Female") }}</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __("Email") }}</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
                </div>

                @if (!isset($user))
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __("Password") }}</label>
                    <input type="password" class="form-control" id="password" name="password" {{ isset($user) ? '' : 'required' }}>
                </div>
                @endif


                <div class="mb-3">
                    <label for="address" class="form-label">{{ __("Address") }}</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->address ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="number" class="form-label">{{ __("Phone") }}</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">{{ __("City") }}</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $user->city ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="postal_code" class="form-label">{{ __("Postal Code") }}</label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code', $user->postal_code ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">{{ __("Status") }}</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="active" {{ old('status', $user->status ?? '') == 'active' ? 'selected' : '' }}>{{ __("Active") }}</option>
                        <option value="inactive" {{ old('status', $user->status ?? '') == 'inactive' ? 'selected' : '' }}>{{ __("Inactive") }}</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">{{ __("Role") }}</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>{{ __("Admin") }}</option>
                        <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>{{ __("User") }}</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">{{ isset($user) ? __("Update User") : __("Create User") }}</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function previewAvatar(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('avatar-preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-layouts.app>

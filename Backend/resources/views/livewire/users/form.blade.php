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
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name ?? '') }}" required>
                    @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label">{{ __("Last Name") }}</label>
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name ?? '') }}" required>
                    @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="avatar" class="form-label">{{ __("Avatar") }}</label>
                    <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" onchange="previewAvatar(event)">
                    @error('avatar')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @php
                    $img = str_replace("http://localhost:8000/api/images/", "", auth()->user()->avatar);
                    $avatar = auth()->user()->avatar ? asset("storage/avatars/".$img) : asset('assets/img/avatars/default.jpg');
                    @endphp
                    @if(isset($user) && $avatar !== 'default.jpg')
                    <div class="d-flex justify-content-center mt-2">
                        <img id="avatar-preview" src="{{ $avatar }}" alt="User Avatar" class="img-thumbnail mt-2" width="100">
                    </div>
                    @else
                    <div class="d-flex justify-content-center mt-2">
                        <img id="avatar-preview" src="{{ asset('assets/img/avatars/default.jpg') }}" alt="Default Avatar" class="img-thumbnail mt-2" width="100">
                    </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">{{ __("Gender") }}</label>
                    <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                        <option value="male" {{ old('gender', $user->gender ?? '') == 'male' ? 'selected' : '' }}>{{ __("Male") }}</option>
                        <option value="female" {{ old('gender', $user->gender ?? '') == 'female' ? 'selected' : '' }}>{{ __("Female") }}</option>
                    </select>
                    @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __("Email") }}</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if (!isset($user))
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __("Password") }}</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" {{ isset($user) ? '' : 'required' }}>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @endif

                <div class="mb-3">
                    <label for="address" class="form-label">{{ __("Address") }}</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $user->address ?? '') }}" required>
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">{{ __("Phone") }}</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}" required>
                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">{{ __("City") }}</label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', $user->city ?? '') }}" required>
                    @error('city')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="postal_code" class="form-label">{{ __("Postal Code") }}</label>
                    <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" value="{{ old('postal_code', $user->postal_code ?? '') }}" required>
                    @error('postal_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">{{ __("Status") }}</label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="active" {{ old('status', $user->status ?? '') == 'active' ? 'selected' : '' }}>{{ __("Active") }}</option>
                        <option value="inactive" {{ old('status', $user->status ?? '') == 'inactive' ? 'selected' : '' }}>{{ __("Inactive") }}</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">{{ __("Role") }}</label>
                    <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                        <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>{{ __("Admin") }}</option>
                        <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>{{ __("User") }}</option>
                    </select>
                    @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if (auth()->user()->can('users.edit') || auth()->user()->can('users.create'))
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">{{ isset($user) ? __("Update User") : __("Create User") }}</button>
                </div>
                @endif
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
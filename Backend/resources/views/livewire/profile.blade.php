<div>
    <div class="row">
        <div class="col-12 col-xl-8">
            @if($showSavedAlert)
            <div class="alert alert-success" role="alert">
                {{__("Saved!")}}
            </div>
            @endif
            <div class="card card-body border-0 shadow mb-4">
                <h2 class="h5 mb-4">{{__("General information")}}</h2>
                <form wire:submit.prevent="save" action="#" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="first_name">{{__("First Name")}}</label>
                                <input wire:model="user.first_name" class="form-control" id="first_name" type="text"
                                    placeholder="{{__('Enter your first name')}}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="last_name">{{__("Last Name")}}</label>
                                <input wire:model="user.last_name" class="form-control" id="last_name" type="text"
                                    placeholder="{{__('Also your last name')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="email">{{__("Email")}}</label>
                                <input wire:model="user.email" class="form-control" id="email" type="email"
                                    placeholder="name@company.com" disabled>
                            </div>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gender">{{__("Gender")}}</label>
                            <select wire:model="user.gender" class="form-select mb-0" id="gender"
                                aria-label="Gender select example">
                                <option selected>{{__("Choose...")}}</option>
                                <option value="female">{{__("Female")}}</option>
                                <option value="male">{{__("Male")}}</option>
                                <option value="other">Other</option>
                            </select>
                            @error('user.gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <h2 class="h5 my-4">{{__("Location")}}</h2>
                    <div class="row">
                        <div class="col-sm-9 mb-3">
                            <div class="form-group">
                                <label for="address">{{__("Address")}}</label>
                                <input wire:model="user.address" class="form-control" id="address" type="text"
                                    placeholder="Enter your home address">
                            </div>
                            @error('user.address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-sm-3 mb-3">
                            <div class="form-group">
                                <label for="phone">{{__("Phone")}}</label>
                                <input wire:model="user.phone" class="form-control" id="phone" type="number"
                                    placeholder="No.">
                            </div>
                            @error('user.phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 mb-3">
                            <div class="form-group">
                                <label for="city">{{__("City")}}</label>
                                <input wire:model="user.city" class="form-control" id="city" type="text"
                                    placeholder="City">
                            </div>
                            @error('user.city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="zip">{{__("Postal Code")}}</label>
                                <input wire:model="user.postal_code" class="form-control" id="postal_code" type="tel" placeholder="{{__('Postal Code')}}">
                            </div>
                        </div>
                        @error('user.postal_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mt-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">{{ __('Save') }}</button>
                    </div>
                </form>
                @if($showDemoNotification)
                <div class="alert alert-info mt-2" role="alert">
                    {{__("You cannot do that in the demo version.")}}
                </div>
                @endif
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card shadow border-0 text-center p-0">
                        <div wire:ignore.self class="profile-cover rounded-top"
                            data-background="../assets/img/profile-cover.jpg"></div>
                        <div class="card-body pb-5">
                            @php
                            $img = str_replace(env('APP_URL') . "/api/images/", "", auth()->user()->avatar);
                            $avatar = auth()->user()->avatar ? asset("storage/avatars/".$img) : asset('assets/img/avatars/default.jpg');
                            @endphp
                            <img src="{{ $avatar }}"
                                class="avatar-xl rounded-circle mx-auto mt-n7 mb-4" alt="Neil Portrait">
                            <h4 class="h3">
                                {{ auth()->user()->first_name ? auth()->user()->first_name . ' ' . auth()->user()->last_name : 'User Name'}}
                            </h4>
                            <h5 class="fw-normal">{{ auth()->user()->email }}</h5>
                            <p class="text-gray mb-4">{{auth()->user()->address }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
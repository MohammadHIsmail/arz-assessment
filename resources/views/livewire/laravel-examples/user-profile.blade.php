<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Profile Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">

                @if ($showSuccesNotification)
                    <div wire:model="showSuccesNotification"
                        class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                        <span class="alert-icon text-white"><i class="ni ni-like-2"></i></span>
                        <span
                            class="alert-text text-white">{{ __('Your profile information have been successfuly saved!') }}</span>
                        <button wire:click="$set('showSuccesNotification', false)" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif
                <h4>Deparment: <span >{{ $department }}</span></h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-control-label">{{ __('Name') }}</label>
                            <div class="@error('name')border border-danger rounded-3 @enderror">
                                <input wire:model="name" class="form-control" type="text"
                                    id="name">
                            </div>
                            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone" class="form-control-label">{{ __('Phone') }}</label>
                            <div class="@error('phone')border border-danger rounded-3 @enderror">
                                <input wire:model="phone" class="form-control" type="text"
                                    id="phone">
                            </div>
                            @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="form-control-label">{{ __('Email') }}</label>
                            <div class="@error('email')border border-danger rounded-3 @enderror">
                                <input wire:model="email" class="form-control" type="email"
                                    id="email">
                            </div>
                            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="selectedgender" class="form-control-label">{{ __('Gender') }}</label>
                            <div class="@error('selectedgender')border border-danger rounded-3 @enderror">
                                <select wire:model="selectedgender" class="form-select" aria-label="Default select example">
                                    <option selected value="">select an option</option>
                                    @foreach($genders as $key => $d)
                                    <option value="{{ $key }}">{{$d}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('selectedgender') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="form-control-label">{{ __('Password') }}</label>
                            <div class="@error('passworde')border border-danger rounded-3 @enderror">
                                <input wire:model="password" class="form-control" type="password" placeholder="Password"
                                    id="password">
                            </div>
                            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation" class="form-control-label">{{ __('Confirm Password') }}</label>
                            <div class="@error('password_confirmation')border border-danger rounded-3 @enderror">
                                <input wire:model="password_confirmation" class="form-control" type="password" placeholder="Confirm Password"
                                    id="password_confirmation">
                            </div>
                            @error('password_confirmation') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button wire:click="save" type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

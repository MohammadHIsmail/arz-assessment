<div>
    <div class="container">
        <div class="justify-content-center">
            @if (count($errors) > 0)
                <div class="alert alert-danger mt-2">
                    <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">Create user
                    <span class="float-right mt-3">
                        <span class="d-flex align-items-center gap-4">
                            <a class="btn btn-primary" href="{{ route('users') }}">Users</a>
                        </span>
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userId" class="form-control-label">{{ __('User ID') }}</label>
                                <div class="@error('userId')border border-danger rounded-3 @enderror">
                                    <input wire:model="userId" class="form-control" type="number" placeholder="User ID"
                                        id="userId">
                                </div>
                                @error('userId') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role">{{ 'Role' }}</label>
                                <div class="@error('selectedrole')border border-danger rounded-3 @enderror">
                                    <select wire:model="selectedrole" class="form-select" aria-label="Default select example">
                                        <option selected>select an option</option>
                                        @foreach($roles as $key => $r)
                                        <option value="{{ $key }}">{{$r}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('selectedrole') <div class="text-danger">The role field is required.</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="form-control-label">{{ __('Password') }}</label>
                                <div class="@error('password')border border-danger rounded-3 @enderror">
                                    <input wire:model="password" class="form-control" type="password"
                                        id="password">
                                </div>
                                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation" class="form-control-label">{{ __('Repeat Password') }}</label>
                                <div class="@error('password_confirmation')border border-danger rounded-3 @enderror">
                                    <input wire:model="password_confirmation" class="form-control" type="password"
                                        id="password_confirmation">
                                </div>
                                @error('password_confirmation') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" wire:click="store" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

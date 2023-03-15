<section>
    <div class="page-header section-height-75">
        <div class="container">
            <div class="row d-flex align-items-center mt-5 ml-0 justify-content-between">
                <div class="col-xl-4 col-lg-5 col-md-6 d-flex justify-content-center">
                    <img src="{{asset('assets/img/logo.png')}}" />
                </div>
                <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                    <div class="card card-plain">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="email">{{ __('Email') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input wire:model="email" id="leaderId" type="text" class="form-control"
                                        placeholder="Email" aria-label="Email">
                                </div>
                                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password">{{ __('Password') }}</label>
                                <div class="@error('password')border border-danger rounded-3 @enderror">
                                    <input wire:model="password" id="password" type="password" class="form-control"
                                        placeholder="Password" aria-label="Password"
                                        aria-describedby="password-addon">
                                </div>
                                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="text-center">
                                <button wire:click="login()" type="submit"
                                    class="btn bg-gradient w-100 mt-4 mb-0">{{ __('Sign in') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid px-0">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            {{-- <div class="card"> --}}
                <div class="card-body">
                    {{-- change language --}}
                    @include('partials.change-locale')
                    <div class="row">
                        <div class="col-md-10 col-lg-8 col-xl-6 mx-auto d-block">
                            <div class="card card-body pd-20 pd-md-40 border shadow-none">
                                @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                                @endif
                                
                                <h5 class="card-title mg-b-20 mx-auto">{{__('Login')}}</h5>
                                <form wire:submit.prevent="login" method="POST">
                                    <div class="form-group">
                                        <label>{{__('E-mail')}}</label>
                                        <input wire:model="email" id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            name="email" required
                                            autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('Password')}}</label>

                                        <input wire:model="password" id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="form-group row">
                                            <div class="mx-auto">
                                                    <input wire:model="rememberMe" type="checkbox"
                                                        name="remember" id="remember"

                                                    <label class="mt-3" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-main-primary btn-block mt-5">
                                        {{ __('Login') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- </div> --}}
        </div>
    </div>
 </div>
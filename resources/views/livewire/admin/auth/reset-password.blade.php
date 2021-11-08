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
                                <h5 class="card-title mg-b-20 mx-auto">{{__('Reset Password')}}</h5>
                                @if (session('status'))
                                <div class="mb-4 tx-danger tx-center">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <form wire:submit.prevent="resetPassword">
                                    <div class="form-group">
                                        <label>{{__('E-mail')}}</label>
                                        <input wire:model="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            name="email" readonly>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>{{__('New Password')}}</label>

                                        <input wire:model="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            name="password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>{{__('Confirm Password')}}</label>

                                        <input wire:model="password_confirmation" type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation">

                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-main-primary btn-block mt-4">
                                        {{ __('Reset') }}
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
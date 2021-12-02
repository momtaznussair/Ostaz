<div class="container-fluid px-0">
    <div class="row">
        <div class="col-lg-12 col-md-12">
                <div class="card-body">
                    {{-- change language --}}
                    @include('partials.change-locale')
                    <div class="row">
                        <div class="col-md-10 col-lg-8 col-xl-6 mx-auto d-block">
                            <div class="card card-body pd-20 pd-md-40 border shadow-none">
                                <h4 class="card-title mg-b-20 mx-auto">{{__('Forgot your password ?')}}</h4>
                                <p class="mt-2 text-muted">{{__('Please enter you email adress below and we will send you a link to reset your password .')}}</p>
                                <form wire:submit.prevent='sendPasswordResetLink'>
                                    <div class="form-group">
                                        <label>{{__('E-mail')}}
                                            <span class="tx-danger">*</span>
                                        </label>
                                        @if (session('status'))
                                        <div class="mb-1 tx-success">
                                            {{ session('status') }}
                                        </div>
                                        @endif
                                        <input wire:model="email" id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            name="email"
                                              autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-main-primary btn-block mt-5">
                                        {{ __('Reset Password') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
 </div>
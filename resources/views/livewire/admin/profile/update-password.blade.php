<div class="card w-100 mx-auto">
    <div class="card-body">
        <div class="pl-0">
                {{-- Password --}}
                <div class="mb-4 main-content-label mt-4">{{__('Password')}}</div>
								{!! Form::open(['wire:submit.prevent' => 'save']) !!}
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">{{__('Current Password')}}</label>
											</div>
											<div class="col-md-9">
                                                {!! Form::password('current_password', ['class' => ['form-control', ( $errors->has('current_password') ? 'border-danger' : '')], 'wire:model' => 'current_password' ]) !!}
                                                @error('current_password') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div> @enderror
											</div>
										</div>
									</div>

									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">{{__('New Password')}}</label>
											</div>
											<div class="col-md-9">
												{!! Form::password('password', ['wire:model' => 'password', 'class' => ['form-control', ( $errors->has('password') ? 'border-danger' : '')]]) !!}
                                                @error('password') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div> @enderror
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">{{__('Confirm Password')}}</label>
											</div>
											<div class="col-md-9">
                                                {!! Form::password('password_confirmation', ['class' => ['form-control', ( $errors->has('password_confirmation') ? 'border-danger' : '')], 'wire:model' => 'password_confirmation']) !!}
											</div>
										</div>
									</div> 

                                    <div class="row" x-data="{updated : false}">
                                        <div class="col d-flex justify-content-end">
                                            <span  
                                            x-show="updated" x-transition.opacity.out.duration.1500ms class="tx-success mt-3"
                                            x-init="@this.on('profileUpdated', () => {updated = true; setTimeout(() => {updated = false}, 2000)})">
                                            {{__('Changes Saved!')}}
                                            </span>
                                            {!! Form::submit(__('Save'), ['class' => ['btn', 'btn-primary', 'mx-3']]) !!}
                                        </div>
                                    </div>
								{!! Form::close() !!}
            </div><!-- main-profile-overview -->
        </div>
    </div>
</div>
<div class="card w-100 mx-auto">
    <div class="card-body">
        <div class="pl-0">
            <div class="main-profile-overview">
                <div class="main-img-user profile-user">
                    <img alt="" src="{{$avatar ? $avatar->temporaryUrl() : asset('storage/' . $admin->avatar)}}">
                    <label for="avatar" class="fas fa-camera profile-edit" type="button" title="{{__('chaneg Image')}}">
                    </label>
                    <div class="row d-flex justify-content-start" x-data="{confirm : false, deleted : false}">
                        @error('avatar') <div class="tx-danger"><strong>{{ $message }}</strong></div> @enderror
                        {{-- delete  image button --}}
                        @if ($admin->avatar != 'admins/default.jpg')
                            <a type="button"  wire:click='confirmDelete' class="fas fa-eraser  tx-18 mx-3" title="{{__('Delete Image')}}"></a>
                        @endif
                        {{-- confirm and delete success message component --}}
                        <x-delete-image-inline-alert/>
                    </div>
                </div>
                {{-- personal info --}}
                <div class="mb-4 main-content-label mt-4">{{__('Personal Information')}}</div>
								{!! Form::open(['wire:submit.prevent' => 'save']) !!}
                                    {!! Form::file('avatar', ['id' => 'avatar', 'class' => 'd-none', 'wire:model' => 'avatar']) !!}
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">{{__('Name')}}</label>
											</div>
											<div class="col-md-9">
                                                {!! Form::text('name', null, ['class' => ['form-control', ( $errors->has('admin.name') ? 'border-danger' : '')], 'wire:model' => 'admin.name']) !!}
                                                @error('admin.name') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div> @enderror
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">{{__('E-mail')}}</label>
											</div>
											<div class="col-md-9">
                                                {!! Form::email('email', Auth('admin')->user()->email, ['class' => ['form-control', ( $errors->has('admin.email') ? 'border-danger' : '')], 'wire:model' => 'admin.email']) !!}
                                                @error('admin.email') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div> @enderror
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">{{__('Phone')}}</label>
											</div>
											<div class="col-md-9">
                                                {!! Form::text('phone', Auth('admin')->user()->phone, ['class' => ['form-control', ( $errors->has('admin.phone') ? 'border-danger' : '')], 'wire:model' => 'admin.phone']) !!}
                                                @error('admin.phone') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div> @enderror
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
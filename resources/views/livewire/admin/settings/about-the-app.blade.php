<div class="card w-100 mx-auto">
    <div class="card-body">
        <div class="pl-0">
            {{-- //image --}}
            <div class="main-profile-overview">
                <div class="main-img-user profile-user">
                    <img alt="" src="{{$image ? $image->temporaryUrl() : asset('assets/img/1.jpg')}}">
                    <label for="image" class="fas fa-camera profile-edit" type="button" title="{{__('Change Image')}}">
                    </label>
                    <div class="row d-flex justify-content-start" x-data="{confirm : false, deleted : false}">
                        @error('image') <div class="tx-danger"><strong>{{ $message }}</strong></div> @enderror
                    </div>
                </div>
                {{-- About The App --}}
                <div class="mb-4 main-content-label mt-4">{{__('About The App')}}</div>
								{!! Form::open(['wire:submit.prevent' => 'save']) !!}
                                    {!! Form::file('avatar', ['id' => 'image', 'class' => 'd-none', 'wire:model' => 'image']) !!}
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">{{__('Title')}}</label>
											</div>
											<div class="col-md-9">
                                                {!! Form::text('title', null, ['wire:model' => 'title', 'class' => ['form-control']]) !!}
                                                @error('title') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div> @enderror
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">{{__('Content')}}</label>
											</div>
											<div class="col-md-9">
                                                {!! Form::textarea('content', null, ['wire:model' => 'content', 'class' => 'form-control', 'rows' => 5]) !!}
                                                @error('content') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div> @enderror
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
<div wire:ignore.self class="modal" id={{$mode}}>
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{$title}}</h6><button aria-label="Close" class="close" data-dismiss="modal" 
                type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['wire:submit.prevent' => $mode ]) !!}
                {{-- image --}}
                <div class="row main-profile-overview d-flex justify-content-center">
                    <div class="main-img-user profile-user">
                        <img alt="" src="{{ $avatar ? $avatar->temporaryUrl() : asset('storage/' . $user->avatar) }}">
                        <label for="avatar" class="fas fa-camera profile-edit" type="button"
                            title="{{ __('chaneg Image') }}">
                        </label>
                        {!! Form::file('avatar', ['wire:model' => 'avatar', 'class' => 'd-none', 'id' => 'avatar']) !!}
                        {{-- delete image - in edit mode --}}
                        <div class="row d-flex justify-content-start" x-data="{confirm : false, deleted : false}">
                            @error('avatar') <div class="tx-danger"><strong>{{ $message }}</strong></div>@enderror
                            {{-- delete  image button --}}
                            @if ($user->avatar != 'users/default.jpg')
                                <a type="button" wire:click='confirmDelete' class="fas fa-eraser  tx-18 mx-3"
                                    title="{{ __('Delete Image') }}"></a>
                            @endif
                            {{-- confirm and delete success message component --}}
                            <x-delete-image-inline-alert />
                        </div>
                    </div>
                </div>
                {{-- 1 name - email --}}
                <div class="row form-group">
                    <div class="col">
                        {!! Form::label('user_name', __('Name'), ['class' => 'label-required']) !!}
                        {!! Form::text('name', null, ['wire:model' => 'user.name', 'id' => 'user_name', 'class' => ['form-control']]) !!}
                        @error('user.name') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>
                    <div class="col">
                        {!! Form::label('email', __('E-mail'), ['class' => 'label-required']) !!}
                        {!! Form::email('email', null, ['wire:model' => 'user.email', 'id' => 'email', 'class' => ['form-control']]) !!}
                        @error('user.email') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>
                </div>
            
                {{-- 2  password --}}
                <div class="row form-group">
                    <div class="col">
                        {!! Form::label('password', __('Password'), ['class' => 'label-required']) !!}
                        {!! Form::password('password', ['wire:model' => 'password', 'id' => 'password', 'class' => ['form-control']]) !!}
                        @error('password') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>
                    <div class="col">
                        {!! Form::label('password_confirmation', __('Confirm Password'), ['class' => 'label-required']) !!}
                        {!! Form::password('password_confirmation', ['wire:model' => 'password_confirmation', 'id' => 'password_confirmation', 'class' => ['form-control']]) !!}
                    </div>
                </div>
            
                {{-- 3 phone and gender --}}
                <div class="row form-group">
                    <div class="col">
                        {!! Form::label('gender', __('Gender'), ['class' => ['label-required']]) !!}
                        {!! Form::select('gender', ['' => __('Select one'),'m' => 'Male', 'f' => 'Female'], null, ['id' => 'gender', 'class' => ['form-control'], 'wire:model' => 'user.gender']) !!}
                    @error('user.gender') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div> @enderror
                    </div>
                    <div class="col">
                        {!! Form::label('age', __('Age'), ['class' => ['label-required']]) !!}
                        {!! Form::number('age', 13, ['wire:model' => 'user.age', 'class' => ['form-control'], 'min' => 13 ]) !!}
                    @error('user.gender') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div> @enderror
                    </div>
                    <div class="col">
                        {!! Form::label('phone', __('Phone'), ['class' => ['label-required']]) !!}
                        {!! Form::text('phone', null, ['wire:model' => 'user.phone', 'class' => ['form-control'], 'id' => 'phone']) !!}
                        @error('user.phone') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div> @enderror
                    </div>
                </div>

                 {{-- 4 country and city --}}
                 <div class="row form-group">
                    <div class="col">
                        {!! Form::label('country', __('Country'), ['class' => ['label-required']]) !!}
                        {!! Form::select('country', Arr::prepend($countries, '' . __('Select one')), '', ['wire:model' => 'country', 'wire:change' => 'getCities' , 'id' => 'country', 'class' => ['form-control']]) !!}
                    @error('country') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div> @enderror
                    </div>
                    <div class="col">
                        {!! Form::label('city', __('City'), ['class' => ['label-required']]) !!}
                        {!! Form::select('city', Arr::prepend($cities, '' . __('Select one')), null, ['wire:model' => 'user.city_id', 'id' => 'city', 'class' => ['form-control']]) !!}
                    @error('user.city_id') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div> @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{ __('cancel') }}</button>
                <button class="btn ripple btn-primary" type="submit">{{ __('confirm') }}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

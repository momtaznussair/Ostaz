            <div class="modal-body">
                {!! Form::open(['wire:submit.prevent' => 'submit']) !!}
                {{-- image and active status --}}
                <div class="row main-profile-overview d-flex justify-content-center">
                    <div class="main-img-user profile-user">
                        <img alt="" src="{{ $avatar ? $avatar->temporaryUrl() : asset('storage/' . $admin->avatar) }}">
                        <label for="avatar" class="fas fa-camera profile-edit" type="button"
                            title="{{ __('chaneg Image') }}">
                        </label>
                        {!! Form::file('avatar', ['wire:model' => 'avatar', 'class' => 'd-none', 'id' => 'avatar']) !!}
                        {{-- delete image - in edit mode --}}
                        <div class="row d-flex justify-content-start" x-data="{confirm : false, deleted : false}">
                            @error('avatar') <div class="tx-danger"><strong>{{ $message }}</strong></div>
                            @enderror
                            {{-- delete  image button --}}
                            @if ($admin->avatar != 'admins/default.jpg')
                                <a type="button" wire:click='confirmDelete' class="fas fa-eraser  tx-18 mx-3"
                                    title="{{ __('Delete Image') }}"></a>
                            @endif
                            {{-- confirm and delete success message component --}}
                            <x-delete-image-inline-alert />
                        </div>
                    </div>
                </div>
                <div class="row form-group d-flex justify-content-end mt-0">
                    <div class="col-lg-3 mg-t-20 mg-lg-t-0 mx-5">
                        {!! Form::checkbox('active', 1, true, ['wire:model' => 'admin.active', 'id' => 'active']) !!}
                        {!! Form::label('active', __('Active'), ['class' => ['tx-success mx-1']]) !!}
                    </div>
                </div>
                {{-- 1 name - email --}}
                <div class="row form-group">
                    <div class="col">
                        {!! Form::label('name', __('Name'), ['class' => 'label-required']) !!}
                        {!! Form::text('name', null, ['wire:model' => 'admin.name', 'id' => 'name', 'class' => ['form-control']]) !!}
                        @error('admin.name') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>
                    <div class="col">
                        {!! Form::label('email', __('E-mail'), ['class' => 'label-required']) !!}
                        {!! Form::email('email', null, ['wire:model' => 'admin.email', 'id' => 'email', 'class' => ['form-control']]) !!}
                        @error('admin.email') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div>
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

                {{-- 3 phone and roles --}}
                <div class="row form-group">
                    <div class="col">
                        {!! Form::label('phone', __('Phone'), ['class' => ['label-required']]) !!}
                        {!! Form::text('phone', null, ['wire:model' => 'admin.phone', 'class' => ['form-control'], 'id' => 'phone']) !!}
                        @error('admin.phone') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>
                    <div class="col">
                        <div wire:ignore>
                            {!! Form::label('roles', __('Roles'), ['class' => ['label-required']]) !!}
                            {!! Form::select('roles', $allRoles, null, ['id' => 'roles', 'class' => ['select2', 'form-control'], 'wire:model' => 'roles', 'multiple', 'style' => 'width: 100%']) !!}
                        </div>
                        @error('roles') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div> @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{ __('cancel') }}</button>
                <button  wire:click='submit' class="btn ripple btn-primary" type="submit">{{ __('confirm') }}</button>
            </div>
            {!! Form::close() !!}
            </div>
            </div>
            @section('js')
                <script>
                    $(document).ready(function() {
                        $('#roles').select2();
                        $('#roles').on('change', function(e) {
                            let data = $('#roles').select2("val");
                            @this.set('roles', data);
                        });
                    });
                </script>
            @endsection

<div wire:ignore.self class="modal" id="createOrUpdate">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{$mode == 'create' ? __('Add New') : __('Edit')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" 
                type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['wire:submit.prevent' => 'submit' ]) !!}
                {{-- image --}}
                <div class="row main-profile-overview d-flex justify-content-center mb-3">
                    <div class="main-img-user profile-user">
                        <img alt="" src="{{ $avatar ? $avatar->temporaryUrl() : asset('storage/' . $admin->avatar) }}">
                        <label for="avatar" class="fas fa-camera profile-edit" type="button"
                            title="{{ __('chaneg Image') }}">
                        </label>
                        {!! Form::file('avatar', ['wire:model' => 'avatar', 'class' => 'd-none', 'id' => 'avatar']) !!}
                        {{-- delete image - in edit mode --}}
                        <div class="row d-flex justify-content-start" x-data="{confirm : false, deleted : false}">
                            @error('avatar') <div class="tx-danger"><strong>{{ $message }}</strong></div>@enderror
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
                {{-- 1 name - email --}}
                <div class="row form-group">
                    <div class="col">
                        {!! Form::label('admin_name', __('Name'), ['class' => 'label-required']) !!}
                        {!! Form::text('name', null, ['wire:model' => 'admin.name', 'id' => 'admin_name', 'class' => ['form-control']]) !!}
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
                       <div>
                        {!! Form::label('roles', __('Roles'), ['class' => ['label-required']]) !!}
                        {{-- roles of current selected admin --}}
                        @foreach ($admin->roles as $role)
                            <span class="badge badge-success mx-2">{{$role->name}}</span>
                        @endforeach
                       </div>
                        <div wire:ignore>
                            {!! Form::select('roles', $allRoles, null, ['id' => 'roles', 'class' => ['select2', 'form-control'], 'wire:model' => 'roles', 'multiple', 'style' => 'width: 100%']) !!}
                        </div>
                        @error('roles') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div> @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{ __('Cancel') }}</button>
                <button class="btn ripple btn-primary" type="submit">{{ __('Confirm') }}</button>
            </div>
            {!! Form::close() !!}
        </div>
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
        // reset select to roles field each time we select a new admin
        @this.on('changeRoles', (roles) => {
            $('#roles').val(null).trigger('change');
        })

        $('#createOrUpdate').on('hidden.bs.modal', function () {
            @this.resetAll();
        })
    });
</script>
@endsection

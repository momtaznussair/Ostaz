{!! Form::open() !!}
<!-- row -->
<div class="row">
    <div class="col-md-12">
        <div class="card mg-b-20">
            <div class="card-header">
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.roles.index') }}">{{__('Back')}}</a>
            </div>
            <div class="card-body">
                <div class="mg-b-5">
                    <div class="col-xs-7 col-sm-7 col-md-7">
                        <div class="form-group">
                            <p>
                                {{__('Name') . ' : '}}
                                <span class="text-danger mx-2"> *</span>
                            </p>
                            @error('name')<div class="tx-danger"><strong>{{ $message }}</strong></div>@enderror
                            {!! Form::text('name', null, array('class' => 'form-control', 'required' => 'true', 'wire:model' => 'name')) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- col -->
                    <div x-data="{ open: '' }" class="col-lg-4 mb-5">

                        {{-- mass selection --}}
                       <div class='ht-15 mb-2'>
                        <a  wire:click="toggleSelectAll(true)" x-show="!open" @click="open = true;" type="button" class="fas fa-check-circle text-success"><span class="mx-1">{{__('Select All')}}</span></a>
                        <a wire:click="toggleSelectAll(false)" x-show="open" @click="open = false;" type="button" class="far fa-check-circle text-secondary"><span class="mx-1">{{__('Deselect All')}}</span></a>
                       </div>
                       @error('permissions')
                        <span class="tx-danger mx-2">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                       <div x-data="{open: false}" class="row mx-4">

                        <div class="row mt-1">
                            <p @click="open = !open">
                            <i x-show="!open" class="fas fa-chevron-down"></i>
                            <i x-show="open" class="fas fa-chevron-up"></i>
                            <span >{{__('Permissions')}}</span>
                            <span class="text-danger"> *</span>
                            </p>
                        </div>
                        <div x-show="open" class="row tx-18 d-flex justify-content-md-between">
                            @foreach($allPermissions as $permission)
                            <div class="form-check col-5">
                                {!! Form::checkbox('permissions[]', $permission->id, false, ['wire:model' => 'permissions', 'id' => $permission->id, 'class' => 'form-check-input']) !!}
                                {!! Form::label($permission->id, $permission->name, ['class' => 'form-check-label']) !!}
                            </div>
                            @endforeach
                        </div>
                       </div>
                    </div>
                    <!-- /col -->
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center mb-5 fixed-bottom">
                        {!! Form::submit(__('Confirm'), ['class' => 'btn btn-main-primary', 'wire:click.prevent' => 'submit']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->

{!! Form::close() !!}
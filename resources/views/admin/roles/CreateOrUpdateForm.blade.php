{!! Form::open() !!}
        <div class="card mg-b-20">
            <div class="card-header">
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.roles.index') }}">{{__('Back')}}</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- name -->
                    <div class="col-4">
                        <div class="form-group">
                            <p>
                                {{__('Name') . ' : '}}
                                <span class="text-danger mx-2"> *</span>
                            </p>
                            @error('name')<div class="tx-danger"><strong>{{ $message }}</strong></div>@enderror
                            {!! Form::text('name', null, array('class' => 'form-control', 'required' => 'true', 'wire:model' => 'name')) !!}
                        </div>
                         <!-- confirm -->
                         <div class="col-xs-12 col-sm-12 col-md-12 mt-5">
                            {!! Form::submit(__('Confirm'), ['class' => 'btn btn-main-primary', 'wire:click.prevent' => 'submit']) !!}
                        </div>
                    </div>
                    <!-- permissions -->
                    <div x-data="{ open: '' }" class="col-8">
                        <div class="row">
                            {{-- mass selection --}}
                            <div class='ht-15 mb-4'>
                                {{-- select all --}}
                                 <a  wire:click="toggleSelectAll(true)" x-show="!open" @click="open = true;" type="button" 
                                 class="fas fa-check-circle text-success"><span class="mx-1">{{__('Select All')}}</span></a>
                                 {{-- deselect all --}}
                                 <a wire:click="toggleSelectAll(false)" x-show="open" @click="open = false;" type="button" 
                                 class="far fa-check-circle text-secondary"><span class="mx-1">{{__('Deselect All')}}</span></a>
                            </div>
                            <div class="col-8">
                                @error('permissions')
                                    <span class="tx-danger mx-auto">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                {{-- single permission --}}
                                @error('permissions.*')<span class="tx-danger mx-auto"> <strong>{{ $message }}</strong> </span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            {{-- permissions selection --}}
                           <div x-data="{open: false}" class="row mx-4">
                                <div class="row mt-1">
                                    <p @click="open = ! open">
                                        <i x-show="open" class="fas fa-chevron-down"></i>
                                        <i x-show="!open" class="fas fa-chevron-up"></i>
                                        <span >{{__('Permissions')}}</span>
                                        <span class="text-danger"> *</span>
                                    </p>
                                </div>
                                <div x-show="open" @click.away="open = false" class="row tx-18 overflow-y-auto" style="max-height: 70vh;">
                                    @foreach($allPermissions as $permission)
                                        <div class="form-check col-6">
                                            {!! Form::checkbox('permissions', $permission->id, null, 
                                            ['wire:model' => "permissions.$permission->id", 'id' => $permission->id, 'class' => 'form-check-input']) !!}
                                            {!! Form::label($permission->id, $permission->name, ['class' => 'form-check-label']) !!}
                                        </div>
                                    @endforeach
                                </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->

{!! Form::close() !!}
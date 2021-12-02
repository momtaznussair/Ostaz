<div class="card-body">
    <x-filters />
    <div class="table-responsive">
        <table id="rolesTable" class="table text-md-nowrap">
            <thead>
                <tr class="text-center">
                    <th class="border-bottom-0">#</th>
                    <th class="border-bottom-0">{{__('Image')}}</th>
                    <th class="border-bottom-0">{{__('Name')}}</th>
                    <th class="border-bottom-0">{{__('E-mail')}}</th>
                    <th class="border-bottom-0">{{__('Phone')}}</th>
                    <th class="border-bottom-0">{{__('Roles')}}</th>
                    <th class="border-bottom-0">{{__('Active')}}</th>
                    <th class="border-bottom-0">{{__('Operations')}}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($admins as $Admin)
                    <tr>
                       <td>{{$loop->iteration}}</td>
					   <td>
						   <img alt="{{$Admin->name}}" src="{{asset('storage/' . $Admin->avatar)}}" class="img-fluid img-thumbnail rounded-circle" style="max-width: 6rem">
					   </td>
					   <td>{{$Admin->name}}</td>
					   <td>{{$Admin->email}}</td>
					   <td>{{$Admin->phone}}</td>
					   <td>
						   @foreach ($Admin->getRoleNames() as $role)
							   <span class="badge badge-success p-1">{{ $role }}</span>
						   @endforeach
					   </td>
                        <td>
                            @can('Admin_edit')
                            <div class="custom-control custom-switch">
                                <input wire:change="toggleActive({{$Admin->active}})" wire:click="select({{$Admin}})"
                                type="checkbox" {{ $Admin->active ? 'checked' : '' }} {{ ($Admin->deleted_at || $admin->count() == 1) ? 'disabled' : '' }} class="custom-control-input" id="{{$Admin->id}}">
                                <label class="custom-control-label" for="{{$Admin->id}}"></label>
                            </div>
                            @endcan
                        </td>
                        <td>
                            @can('Admin_edit')
                                @empty($Admin->deleted_at)
                                <a  
                                    wire:click="select({{$Admin}}, true)" class="btn btn-sm btn-info text-white" type="button"
                                    data-toggle="modal" href="#createOrUpdate"
                                    title="{{__('Edit')}}"><i class="las la-pen"></i>
                                </a> 
                                @endempty
                            @endcan
                            @can('Admin_delete')
                                @if ($Admin->deleted_at)
                                    <a  
                                        wire:click="restore({{$Admin}})" class="btn btn-sm btn-info"
                                        title="{{__('Restore')}}"><i class="fas fa-trash-restore tx-white"></i>
                                    </a> 
                                    @else
							        @if ($admin->count() > 1)
                                    <a
                                        wire:click="select({{$Admin}})"
                                        class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                        data-toggle="modal" href="#delete" title="{{__('Delete')}}"><i
                                        class="las la-trash"></i>
                                    </a>
                                    @endif
                                @endif
                            @endcan     
                        </td>
                    </tr>
                @empty
                <tr class="tx-center">
                    <td colspan="8">{{__('No results found.')}}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="row mx-3">{{$admins->links()}} </div>

    {{-- modals --}}
    @livewire('admin.admins.update-or-create-admin')
    <x-crud-by-name-modal :name="$name" :title="__('Delete')" mode="delete" />
   

</div>

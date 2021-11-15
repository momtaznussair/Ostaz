<div class="card-body">
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
                    <th class="border-bottom-0">{{__('Status')}}</th>
                    <th class="border-bottom-0">{{__('Operations')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            <img alt="{{$admin->name}}" src="{{asset('storage/' . $admin->avatar)}}" style="width: 70px; height: 70px; border-radius:50%">
                        </td>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->email}}</td>
                        <td>{{$admin->phone}}</td>
                        <td>
                            @foreach ($admin->getRoleNames() as $role)
                                <span class="badge badge-success p-1">{{ $role }}</span>
                            @endforeach
                        </td>
                        <td>
                            <x-account-status-badge :status="$admin->active" />
                        </td>
                        <td wire:click='Select({{$admin}})'>
                            @can('Admin_edit')
                                <a  
                                    data-toggle="modal" href="#editModal" class="btn btn-sm btn-info"
                                    title="{{__('Edit')}}"><i class="las la-pen"></i></a> 
                            @endcan
                            
                            @can('Admin_delete')
                                {{-- we first check if there are more than one admin --}}
                                @if ($admin->count() > 1)
                                <a
                                class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                data-toggle="modal" href="#deleteModal" title="{{__('modal.Delete')}}"><i
                                    class="las la-trash"></i></a>
                                @endif
                            @endcan                                        
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row mx-3">{{$admins->links()}} </div>
    @isset($selectedAdmin)
    <x-delete-alert :name="$selectedAdmin->name"/>
    <livewire:admin.admins.edit :admin="$selectedAdmin" />
    @endisset
    @livewire('admin.admins.create')
</div>
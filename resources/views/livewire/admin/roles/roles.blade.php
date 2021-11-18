<div class="card-body">
    <div class="table-responsive">
        <table id="rolesTable" class="table text-md-nowrap">
            <thead>
                <tr class="text-center">
                    <th class="border-bottom-0">#</th>
                    <th class="border-bottom-0">{{__('Name')}}</th>
                    <th class="border-bottom-0">{{__('Operations')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr class="text-center">
                    <td class="align-middle">{{$loop->iteration}}</td>
                    <td class="align-middle">{{$role->name}}</td>
                    <td>
                        @if ($role->name == 'Super Admin')
                        <i class="fas fa-crown tx-warning"></i>
                        @else
                        @can('Role_edit')
                            <a class="btn btn-primary btn-sm"
                            href="{{route('admin.roles.edit', $role->id)}}">{{__('Edit')}}</a> 
                        @endcan

                        @can('Role_delete')
                            <a wire:click="selectToDelete({{$role}})"
                            class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                             data-toggle="modal"
                            href="#delete" title="{{__('Delete')}}"><i class="las la-trash"></i></a>	
                        @endcan
                        @endif 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row mx-3">{{$roles->links()}} </div>
    <x-crud-by-name-modal :name="$name" mode="delete" title="delete" />
</div>
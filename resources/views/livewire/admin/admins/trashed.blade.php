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
                        @can('Role_delete')
                            <a wire:click=""
                            type="button" title="{{__('Restore')}}"><i class="fas fa-trash-restore-alt"></i></a>	
                        @endcan
                        @endif 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row mx-3">{{$roles->links()}} </div>
    @isset($selectedTodelete)
    <x-delete-alert :name="$selectedTodelete['name']"/>
    @endisset
</div>
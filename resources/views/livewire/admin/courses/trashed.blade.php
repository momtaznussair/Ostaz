<div class="card-body">
    <div class="row d-flex justify-content-end px-4">
        <div class="col-2">
                <input wire:model='search' type="search" placeholder="{{__('Search...')}}" class="form-control mb-3 h-6">
        </div>
    </div>
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
                @forelse ($courses  as $course)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$course->name}}</td>
                        <td>
                            @can('Category_edit')
                                <a  
                                    wire:click="restore({{$course->id}})" class="btn btn-sm btn-info"
                                    title="{{__('Restore')}}"><i class="fas fa-trash-restore tx-white"></i></a> 
                            @endcan
                        </td>
                    </tr>
                @empty
                <tr class="tx-center">
                    <td colspan="4">{{__('No results found.')}}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="row mx-3">{{$courses->links()}} </div>
</div>
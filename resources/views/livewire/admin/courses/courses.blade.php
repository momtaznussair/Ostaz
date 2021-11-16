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
                    <th class="border-bottom-0">{{__('Active')}}</th>
                    <th class="border-bottom-0">{{__('Category')}}</th>
                    <th class="border-bottom-0">{{__('Operations')}}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($courses as $course)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$course->name}}</td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input wire:change="toggleActive({{$course->active}})" wire:click="selectcourse({{$course->id}})"
                                type="checkbox" {{ $course->active ? 'checked' : '' }} class="custom-control-input" id="{{$course->id}}">
                                <label class="custom-control-label" for="{{$course->id}}"></label>
                            </div>
                        </td>
                        <td>{{$course->category->name}}</td>
                        <td>
                            @can('Course_edit')
                                <a  
                                    wire:click="selectcourse({{$course->id}})"
                                    data-toggle="modal" href="#update" class="btn btn-sm btn-info"
                                    title="{{__('Edit')}}"><i class="las la-pen"></i></a> 
                            @endcan
                            @can('Course_delete')
                                <a
                                wire:click="selectcourse({{$course->id}})"
                                class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                data-toggle="modal" href="#delete" title="{{__('Delete')}}"><i
                                class="las la-trash"></i></a>
                            @endcan     
                        </td>
                    </tr>
                @empty
                <tr class="tx-center">
                    <td colspan="5">{{__('No results found.')}}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="row mx-3">{{$courses->links()}} </div>
    {{-- modal --}}
    <x-create-or-update-course mode="save" title="{{__('Add New')}}" :categories="$categories"/>
    <x-create-or-update-course mode="update" title="{{__('Edit')}}" :categories="$categories"/>
    <x-crud-by-name-modal mode="delete" title="{{__('Delete')}}"/>
</div>
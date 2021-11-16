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
                    <th class="border-bottom-0">{{__('Operations')}}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$category->name}}</td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input wire:change="toggleActive({{$category->active}})" wire:click="selectCategory({{$category->id}})"
                                type="checkbox" {{ $category->active ? 'checked' : '' }} class="custom-control-input" id="{{$category->id}}">
                                <label class="custom-control-label" for="{{$category->id}}"></label>
                            </div>
                        </td>
                        <td>
                            @can('Category_edit')
                                <a  
                                    wire:click="selectCategory({{$category->id}})"
                                    data-toggle="modal" href="#update" class="btn btn-sm btn-info"
                                    title="{{__('Edit')}}"><i class="las la-pen"></i></a> 
                            @endcan
                            @can('Category_delete')
                                <a
                                wire:click="selectCategory({{$category->id}})"
                                class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                data-toggle="modal" href="#delete" title="{{__('Delete')}}"><i
                                class="las la-trash"></i></a>
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
    <div class="row mx-3">{{$categories->links()}} </div>
    {{-- modal --}}
    <x-crud-by-name-modal mode="save" title="{{__('Add New')}}"/>
    <x-crud-by-name-modal mode="delete" title="{{__('Delete')}}"/>
    <x-crud-by-name-modal mode="update" title="{{__('Edit')}}"/>
</div>
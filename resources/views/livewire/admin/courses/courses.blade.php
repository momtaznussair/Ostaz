<div class="card-body">
   {{-- filters --}}
   <x-filters />
    <div class="table-responsive">
        <table id="rolesTable" class="table text-md-nowrap">
            <thead>
                <tr class="text-center">
                    <th class="border-bottom-0">#</th>
                    <th class="border-bottom-0">{{__('Name')}}</th>
                    <th class="border-bottom-0">{{__('Active')}}</th>
                    <th class="border-bottom-0">{{__('Category')}}</th>
                    <th class="border-bottom-0">{{__('Students Count')}}</th>
                    <th class="border-bottom-0">{{__('Instructor')}}</th>
                    <th class="border-bottom-0">{{__('Instructor') . ' / ' . __('E-mail')}}</th>
                    <th class="border-bottom-0">{{__('Operations')}}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($courses as $course)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$course->name}}</td>
                        <td>
                            @can('Category_edit')
                            <div class="custom-control custom-switch">
                                <input wire:change="toggleActive({{$course->active}})" wire:click="select({{$course->id}})"
                                type="checkbox" {{ $course->active ? 'checked' : '' }} {{ $course->deleted_at ? 'disabled' : '' }} class="custom-control-input" id="{{$course->id}}">
                                <label class="custom-control-label" for="{{$course->id}}"></label>
                            </div>
                            @endcan
                        </td>
                        <td>{{$course->category ? $course->category->name : __('Deleted')}}</td>
                        <td>{{$course->student_count}}</td>
                        <td>{{$course->instructor ? $course->instructor->name : __('Deleted')}}</td>
                        <td>{{$course->instructor ? $course->instructor->email  : __('Deleted') }}</td>
                        <td>
                            @empty($course->deleted_at)
                                @can('Course_edit')
                                <a  
                                    wire:click="select({{$course->id}})"
                                    data-toggle="modal" href="#update" class="btn btn-sm btn-info"
                                    title="{{__('Edit')}}"><i class="las la-pen"></i></a> 
                                @endcan
                            @endempty
                            @can('Course_delete')

                            @if ($course->deleted_at)
                                <a  
                                    wire:click="restore({{$course->id}})" class="btn btn-sm btn-info"
                                    title="{{__('Restore')}}"><i class="fas fa-trash-restore tx-white"></i>
                                </a> 
                                @else
                                <a
                                wire:click="select({{$course->id}})"
                                class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                data-toggle="modal" href="#delete" title="{{__('Delete')}}"><i
                                class="las la-trash"></i></a>
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
    <div class="row mx-3">{{$courses->links()}} </div>
    {{-- modal --}}
    <x-crud-by-name-modal mode="delete" title="{{__('Delete')}}"/>
    <x-create-or-update-course mode="save" title="{{__('Add New')}}" :categories="$categories" :instructors="$instructors" />
    <x-create-or-update-course mode="update" title="{{__('Edit')}}" :categories="$categories" :instructors="$instructors" />
</div>
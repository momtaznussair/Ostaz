<div class="card-body">
    {{-- filters --}}
    <x-filters />
     <div class="table-responsive">
         <table id="rolesTable" class="table text-md-nowrap">
             <thead>
                 <tr class="text-center">
                    <th class="border-bottom-0">#</th>
                    <th class="border-bottom-0">{{__('Image')}}</th>
                    <th class="border-bottom-0">{{__('Name')}}</th>
                    <th class="border-bottom-0">{{__('Gender')}}</th>
                    <th class="border-bottom-0">{{__('Age')}}</th>
                    <th class="border-bottom-0">{{__('E-mail')}}</th>
                    <th class="border-bottom-0">{{__('Phone')}}</th>
                    <th class="border-bottom-0">{{__('Country')}}</th>
                    <th class="border-bottom-0">{{__('Courses')}}</th>
                    <th class="border-bottom-0">{{__('Active')}}</th>
                    <th class="border-bottom-0">{{__('Operations')}}</th>
                 </tr>
             </thead>
             <tbody>
                 @forelse ($instructors as $instructor)
                     <tr>
                         <td>{{$loop->iteration}}</td>
                         <td>
                            <img alt="{{$instructor->name}}" src="{{$instructor->avatar_path}}" class="img-fluid img-thumbnail rounded-circle" style="max-width: 6rem">
                        </td>
                         <td>{{$instructor->name}}</td>
                         <td>{{$instructor->gen}}</td>
                         <td>{{$instructor->age}}</td>
                         <td>{{$instructor->email}}</td>
                         <td>{{$instructor->phone}}</td>
                         <td>{{$instructor->city ? $instructor->city->country->name  : __('Deleted')}}</td>
                         <td><i wire:click="select({{$instructor->id}}, 'toViewCourses')" data-toggle="modal" href="#coursesList" class="fas fa-envelope-open-text tx-22 tx-success" type="button"></i></td>
                         <td>
                            @can('User_edit')
                             <div class="custom-control custom-switch">
                                 <input wire:change="toggleActive({{$instructor->active}})" wire:click="select({{$instructor->id}})"
                                 type="checkbox" {{ $instructor->active ? 'checked' : '' }} {{ $instructor->deleted_at ? 'disabled' : '' }} class="custom-control-input" id="{{$instructor->id}}">
                                 <label class="custom-control-label" for="{{$instructor->id}}"></label>
                             </div>
                             @endcan
                         </td>
                         <td>
                             <div class="row d-flex justify-content-around">
                            @empty($instructor->deleted_at)
                                @can('User_edit')
                                 <a  
                                     wire:click="select({{$instructor->id}}, 'toUpdate')"
                                     data-toggle="modal" href="#updateOrCreate" class="btn btn-sm btn-info col-5"
                                     title="{{__('Edit')}}"><i class="las la-pen"></i></a> 
                                 @endcan
                             @endempty
                             @can('User_delete')
 
                             @if ($instructor->deleted_at)
                                 <a  
                                     wire:click="restore({{$instructor->id}})" class="btn btn-sm btn-info col-5"
                                     title="{{__('Restore')}}"><i class="fas fa-trash-restore tx-white"></i>
                                 </a> 
                                 @else
                                 <a
                                 wire:click="select({{$instructor->id}})"
                                 class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                 data-toggle="modal" href="#delete" title="{{__('Delete')}}"><i
                                 class="las la-trash"></i></a>
                             @endif
                             @endcan     
                             </div>
                         </td>
                     </tr>
                 @empty
                 <tr class="tx-center">
                     <td colspan="9">{{__('No results found.')}}</td>
                 </tr>
                 @endforelse
             </tbody>
         </table>
     </div>
     <div class="row mx-3">{{$instructors->links()}} </div>
     {{-- modal --}}
     <x-crud-by-name-modal mode="delete" title="{{__('Delete')}}"/>
    @livewire('admin.users.update-or-create-user', ['userRole' => 'Instructor'])
    @livewire('admin.instructors.assign-course-to-instructor', ['user' => $user])
     
    
{{-- end of root --}}
 </div>
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
                    <th class="border-bottom-0">{{__('City')}}</th>
                    <th class="border-bottom-0">{{__('Active')}}</th>
                    <th class="border-bottom-0">{{__('Operations')}}</th>
                 </tr>
             </thead>
             <tbody>
                 @forelse ($students as $student)
                     <tr>
                         <td>{{$loop->iteration}}</td>
                         <td>
                            <img alt="{{$student->name}}" src="{{asset('storage/' . $student->avatar)}}" style="width: 70px; height: 70px; border-radius:50%">
                        </td>
                         <td>{{$student->name}}</td>
                         <td>{{$student->gen}}</td>
                         <td>{{$student->age}}</td>
                         <td>{{$student->email}}</td>
                         <td>{{$student->phone}}</td>
                         <td>{{$student->city->name}}</td>
                         <td>
                             <div class="custom-control custom-switch">
                                 <input wire:change="toggleActive({{$student->active}})" wire:click="select({{$student->id}})"
                                 type="checkbox" {{ $student->active ? 'checked' : '' }} {{ $student->deleted_at ? 'disabled' : '' }} class="custom-control-input" id="{{$student->id}}">
                                 <label class="custom-control-label" for="{{$student->id}}"></label>
                             </div>
                         </td>
                         <td>
                             @empty($student->deleted_at)
                                 @can('User_edit')
                                 <a  
                                     wire:click="select({{$student->id}})"
                                     data-toggle="modal" href="#update" class="btn btn-sm btn-info"
                                     title="{{__('Edit')}}"><i class="las la-pen"></i></a> 
                                 @endcan
                             @endempty
                             @can('User_delete')
 
                             @if ($student->deleted_at)
                                 <a  
                                     wire:click="restore({{$student->id}})" class="btn btn-sm btn-info"
                                     title="{{__('Restore')}}"><i class="fas fa-trash-restore tx-white"></i>
                                 </a> 
                                 @else
                                 <a
                                 wire:click="select({{$student->id}})"
                                 class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                 data-toggle="modal" href="#delete" title="{{__('Delete')}}"><i
                                 class="las la-trash"></i></a>
                             @endif
                             @endcan     
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
     <div class="row mx-3">{{$students->links()}} </div>
     {{-- modal --}}
     <x-crud-by-name-modal mode="delete" title="{{__('Delete')}}"/>

     <x-create-or-update-user mode="save" :title="__('Add New')" :user="$user" type="student" :avatar="$avatar"
    :countries="$countries" :cities="$cities" />

    <x-create-or-update-user mode="update" :title="__('Edit')" :user="$user" type="student" :avatar="$avatar"
    :countries="$countries" :cities="$cities" />
 </div>
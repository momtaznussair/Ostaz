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
                     <th class="border-bottom-0">{{__('Country')}}</th>
                     <th class="border-bottom-0">{{__('Operations')}}</th>
                 </tr>
             </thead>
             <tbody>
                 @forelse ($cities as $city)
                     <tr>
                         <td>{{$loop->iteration}}</td>
                         <td>{{$city->name}}</td>
                         <td>
                            @can('city_edit')
                             <div class="custom-control custom-switch">
                                 <input wire:change="toggleActive({{$city->active}})" wire:click="select({{$city->id}})"
                                 type="checkbox" {{ $city->active ? 'checked' : '' }} {{ $city->deleted_at ? 'disabled' : '' }} class="custom-control-input" id="{{$city->id}}">
                                 <label class="custom-control-label" for="{{$city->id}}"></label>
                             </div>
                             @endcan
                         </td>
                         <td>{{$city->country->name}}</td>
                         <td>
                             @empty($city->deleted_at)
                                 @can('city_edit')
                                 <a  
                                     wire:click="select({{$city->id}})"
                                     data-toggle="modal" href="#update" class="btn btn-sm btn-info"
                                     title="{{__('Edit')}}"><i class="las la-pen"></i></a> 
                                 @endcan
                             @endempty
                             @can('city_delete')
 
                             @if ($city->deleted_at)
                                 <a  
                                     wire:click="restore({{$city->id}})" class="btn btn-sm btn-info"
                                     title="{{__('Restore')}}"><i class="fas fa-trash-restore tx-white"></i>
                                 </a> 
                                 @else
                                 <a
                                 wire:click="select({{$city->id}})"
                                 class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                 data-toggle="modal" href="#delete" title="{{__('Delete')}}"><i
                                 class="las la-trash"></i></a>
                             @endif
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
     <div class="row mx-3">{{$cities->links()}} </div>
     {{--delete modal --}}
     <x-crud-by-name-modal mode="delete" title="{{__('Delete')}}"/>
     {{-- add modal --}}
     <div wire:ignore.self class="modal" id="save">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">{{__('Add New')}}</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                {!! Form::open(['wire:submit.prevent' => 'save']) !!}
    
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col">
                            <div>
                                {!! Form::label('country_id', __('Country'), ['class' => 'label-required']) !!}
                            </div>
                            {!! Form::select('country_id', $countries->prepend(__('Select one'), ''), null, ['wire:model' => 'city.country_id','wire:change' => 'getCities', 'id' => 'country_id', 'class' => ['form-control']]) !!}
                            @error('city.country_id') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div> @enderror
                        </div>
                    </div>
    
                    <div class="row form-group">
                        <div class="col">
                            <div>
                                {!! Form::label('name', __('City'), ['class' => 'label-required']) !!}
                            </div>
                            <Select wire:model='city.name' id="name", class="form-control">
                                @foreach ($allCitiesOfSelectedCountry as $city)
                                    <option value="{{$city}}">{{$city}}</option>
                                @endforeach
                            </Select>
                            @error('city.name') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div> @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
                    {!! Form::submit(__('Confirm'), ['class' => ['btn btn-primary'], ]) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
        {{--end of add modal --}}
 </div>
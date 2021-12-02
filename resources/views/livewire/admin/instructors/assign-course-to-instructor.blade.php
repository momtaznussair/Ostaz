<div class="root">
    <div  wire:ignore.self class="modal" id="coursesList">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title mx-3">{{__('Instructor') . ': ' . $user->name  . ' (' . __('Courses') . ')'}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table mg-b-0 text-md-nowrap">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Category')}}</th>
                                    <th>{{__('Status')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($user->courses as $course)
                                <tr class="text-center">
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$course->name}}</td>
                                    <td>{{$course->category->name}}</td>
                                    <td>
                                        <x-account-status-badge :status="$course->active" />
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4">{{__('No results found.')}}</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>                    
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" data-toggle="modal" href="#assignCourse" class="btn ripple btn-primary" type="button">{{__('Assign a course')}}</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{__('Close')}}</button>
                </div>
            </div>
        </div>
    </div>
    {{-- assign a course form --}}
    
    <div  wire:ignore.self class="modal" id="assignCourse">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title mx-3">{{__('Instructor') . ': ' . $user->name  . ' (' . __('Courses') . ')'}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['wire:submit.prevent' => 'submit']) !!}
    
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="col">
                                <div>
                                    {!! Form::label('category_id', __('Category'), ['class' => 'label-required']) !!}
                                </div>
                                {!! Form::select('category_id', $categories->prepend(__('Select one'), ''), null, ['wire:model' => 'category_id', 'id' => 'category_id', 'class' => ['form-control']]) !!}
                                @error('category_id') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>
                        </div>
        
                        <div class="row form-group">
                            <div class="col">
                                {!! Form::label('name', __('Name'), ['class' => 'label-required']) !!}
                                {!! Form::text('name', null, ['wire:model' => 'name', 'id' => 'name', 'class' => ['form-control']]) !!}
                                @error('name') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                {{-- footer --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
                    {!! Form::submit(__('Confirm'), ['class' => ['btn btn-primary'], ]) !!}
                </div>
                {!! Form::close() !!}                   
            </div>
        </div>
    </div>
</div>
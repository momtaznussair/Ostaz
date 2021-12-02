<div wire:ignore.self class="modal" id="{{$mode}}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{$title}}</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            {!! Form::open(['wire:submit.prevent' => $mode]) !!}

            <div class="modal-body">
                <div class="row form-group">
                    <div class="col">
                        <div>
                            {!! Form::label('category_id', __('Category'), ['class' => 'label-required']) !!}
                        </div>
                        {!! Form::select('category_id', $categories->prepend(__('Select one'), ''), null, ['wire:model' => 'course.category_id', 'id' => 'category_id', 'class' => ['form-control']]) !!}
                        @error('course.category_id') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col">
                        {!! Form::label('name', __('Name'), ['class' => 'label-required']) !!}
                        {!! Form::text('name', null, ['wire:model' => 'course.name', 'id' => 'name', 'class' => ['form-control']]) !!}
                        @error('course.name') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div>@enderror
                    </div>
                </div>

                <div class="col">
                    <div>
                        {!! Form::label('instructor_id', __('Instructor'), ['class' => 'label-required']) !!}
                    </div>
                    {!! Form::select('instructor_id', $instructors->prepend(__('Select one'), ''), null, ['wire:model' => 'course.instructor_id', 'id' => 'instructor_id', 'class' => ['form-control']]) !!}
                    @error('course.instructor_id') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div>@enderror
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
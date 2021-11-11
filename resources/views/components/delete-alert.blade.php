 {{-- delete modal --}}
 <div wire:ignore.self class="modal" id="deleteModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{__('Delete')}}</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            {!! Form::open(['wire:submit.prevent' => 'delete']) !!}

            <div class="modal-body">
                <p>{{__('Are you sure you wanna delete?')}}</p><br>
                {{ Form::text('name', $name,['class' => 'form-control', 'id' => 'name', 'readonly' => 'on']) }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
                {!! Form::submit(__('Confirm'), ['class' => 'btn btn-danger']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
{{--end of delete modal --}}
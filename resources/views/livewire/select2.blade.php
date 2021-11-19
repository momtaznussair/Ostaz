<div>
    <button wire:click='select'>Show Modal</button>
    <button wire:click='request'>Make a request</button>
    @foreach ($numbers as $n)
        {{$n}}
    @endforeach
    {{$name}}

    {{--  modal --}}
<div wire:ignore.self class="modal" id="test">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Test</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            {!! Form::open(['wire:submit.prevent' => 'submit']) !!}

            <div class="modal-body">
                <div class="row form-group">
                    <div class="col">
                        <div wire:ignore>
                            {!! Form::select('number[]', [1 => 'One', 2 => 'Two', 3 => 'three'], null, ['wire:model' => 'numbers',
                        'id' => 'test', 'class' => 'select2', 'style' => 'width:100px', 'multiple']) !!}
                        </div>
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
@section('js')
<script>
    $(document).ready(function() {
        $('#test').select2();
        $('#test').on('change', function(e) {
            let data = $('#test').select2("val");
            @this.set('numbers', data);
        });
        @this.on('show', function(e) {
            $('#test').modal('show');
        })
    });
</script>
@endsection
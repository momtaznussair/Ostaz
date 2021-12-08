<div>
    <form >
        <div class="form-group">
            <div class="row align-items-center">
                {!! Form::label(null, __('To'), ['class' => 'col-sm-2']) !!}
                <div class="col-sm-10">
                {!! Form::select('to', [null => __('All'),  'Instructor' => __('Instructors'), 'Student' => __('Students')], null, ['wire:model' => 'userType', 'class' => ['text-center', 'custom-select', 'p-1' ], 'style' => 'width:5rem']) !!}
                @error('userType') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row ">
                {!! Form::label(null, __('Content'), ['class' => 'col-sm-2']) !!}
                <div class="col-sm-10">
                    {!! Form::textarea('content', null, ['wire:model' => 'content', 'rows' => 5, 'class' => 'form-control']) !!}
                    @error('content') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>
        </div>
        <div x-data="{sent : false}" class="form-group d-flex justify-content-md-end">
            <div>
                <p x-show="sent" x-transition.opacity.out.duration.1500ms
                x-init="@this.on('Notified', () => {sent = true; setTimeout(() => {sent = false}, 3000)})"
                class=" tx-success mx-3 mt-3 tx-16">{{'Sent Successfully!'}}</p>
            </div>

            <div>
                <button wire:loading wire:target="notify" class="btn btn-primary" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    {{__('Sending...')}}
                </button>
                <button wire:click='notify'  wire:loading.remove class="btn ripple btn-primary" type="button">{{__('Send')}}</button>
            </div>
        </div>
    </form>
</div>

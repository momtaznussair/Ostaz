<div class="card-body">
    {{-- filters --}}
    <div>
        <div class="row d-flex justify-content-between px-4 mb-3">
            <div class="col-3">
                <div class="custom-control custom-switch">
                    <input wire:model='trashed' type="checkbox"  class="custom-control-input" id={{$type . "trashed"}}>
                    <label class="custom-control-label tx-danger" for={{$type . "trashed"}}>{{__('Trashed')}}</label>
                </div>
            </div>
            <div class="col-2">
                <input wire:model='search' type="search" placeholder="{{ __('Search...') }}"
                    class="form-control mb-3 h-6">
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="rolesTable" class="table text-md-nowrap">
            <thead>
                <tr class="text-center">
                    <th class="border-bottom-0">#</th>
                    <th class="border-bottom-0">{{ __('Name') }}</th>
                    <th class="border-bottom-0">{{ __('E-mail') }}</th>
                    <th class="border-bottom-0">{{ __('Phone') }}</th>
                    <th class="border-bottom-0">{{ __('Message') }}</th>
                    <th class="border-bottom-0">{{ __('Operations') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $message)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->phone }}</td>
                        <td>
                            @can('UserMessages_view')
                            <a  
                                wire:click='select({{$message}})'
                                class="btn btn-sm btn-info" data-toggle="modal" href="{{'#' . $type}}"
                                title="{{__('Read')}}"><i class="fas fa-envelope tx-white"></i>
                            </a> 
                            @endcan
                        </td>
                        <td>
                            @can('UserMessages_delete')
                                @if ($message->deleted_at)
                                    <a  
                                        wire:click="restore({{$message->id}})" class="btn btn-sm btn-info"
                                        title="{{__('Restore')}}"><i class="fas fa-trash-restore tx-white"></i>
                                    </a> 
                                    @else
                                    <a
                                    wire:click="delete({{$message->id}})"
                                     class="btn btn-sm btn-danger" 
                                    data-toggle="modal" href="#delete" title="{{__('Delete')}}"><i
                                    class="las la-trash"></i></a>
                                @endif
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr class="tx-center">
                        <td colspan="6">{{ __('No results found.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="row mx-3">{{ $messages->links() }} </div>

    @if ($selectedMessage)
    <!-- Read Messsage modal -->
		<div wire:ignore.self class="modal" id="{{$type}}">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">
                            <i class="fas fa-envelope-open mx-1 tx-primary"></i>
                            {{__('Message From:') . ' ' . $selectedMessage['name']}}</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<h6 class="text-muted">{{Carbon\Carbon::parse($selectedMessage['created_at'])->diffForHumans()}}</h6>
						<p>{{$selectedMessage['message']}}</p>
					</div>
					<div class="modal-footer">
						<button class="btn ripple btn-primary" data-dismiss="modal" data-toggle="modal" href="{{'#' . $type . 'Reply'}}" type="button">{{__('Reply')}}</button>
						<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{__('Close')}}</button>
					</div>
				</div>
			</div>
		</div>
    <!-- End of read message modal -->

    <!-- Read Messsage modal -->
		<div wire:ignore.self class="modal" id="{{$type . 'Reply'}}">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">
                            <i class="fas fa-reply-all mx-1 tx-primary"></i>
                            {{__('Reply To: ') . ' ' . $selectedMessage['name']}}</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<form >
                            <div class="form-group">
                                <div class="row align-items-center">
                                    {!! Form::label(null, __('To'), ['class' => 'col-sm-2']) !!}
                                    <div class="col-sm-10">
                                    {!! Form::email('email', null, ['wire:model' => 'email', 'class' => 'form-control']) !!}
                                    @error('email') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row align-items-center">
                                    {!! Form::label(null, __('Subject'), ['class' => 'col-sm-2']) !!}
                                    <div class="col-sm-10">
                                        {!! Form::email('text', null, ['wire:model' => 'subject', 'class' => 'form-control']) !!}
                                        @error('subject') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row ">
                                    {!! Form::label(null, __('Message'), ['class' => 'col-sm-2']) !!}
                                    <div class="col-sm-10">
                                        {!! Form::textarea('message', null, ['wire:model' => 'message', 'rows' => 5, 'class' => 'form-control']) !!}
                                        @error('message') <div class="tx-danger mt-1"><strong>{{ $message }}</strong></div> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <a href="{{'#' . $type}}" data-toggle="modal" data-dismiss="modal" class="fa fa-arrow-alt-circle-left mx-3 tx-20" title="{{__('Message')}}"></a>
                            </div>
                        </form>
					</div>
					<div class="modal-footer">

                        <button wire:loading wire:target="reply" class="btn btn-primary" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            {{__('Sending...')}}
                        </button>
                        
						<button wire:click='reply'  wire:loading.remove class="btn ripple btn-primary" type="button">{{__('Send')}}</button>
						<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{__('Close')}}</button>
					</div>
				</div>
			</div>
		</div>
    <!-- End of read message modal -->
    @endif

</div>


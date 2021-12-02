<div>
    <div class="row d-flex justify-content-between px-4">
        <div class="col-3">
           <div class="row mx-2">
            <div class="custom-control custom-switch">
                <input wire:model='trashed' type="checkbox"  class="custom-control-input" id="trashed">
                <label class="custom-control-label tx-danger" for="trashed">{{__('Trashed')}}</label>
            </div>
            <div class="custom-control custom-switch mx-2">
                <input wire:model='active' type="checkbox"  class="custom-control-input" id="active">
                <label class="custom-control-label tx-success" selected for="active">{{__('Active')}}</label>
            </div>
           </div>
        </div>
        <div class="col-2">
                <input wire:model='search' type="search" placeholder="{{__('Search...')}}" class="form-control mb-3 h-6">
        </div>
    </div>
</div>
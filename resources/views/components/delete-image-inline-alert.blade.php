{{-- delete success message --}}
<span  
x-show="deleted" x-transition.opacity.out.duration.1500ms class="tx-success mx-4 my-1"
x-init="@this.on('deleted', () => {deleted = true; setTimeout(() => {deleted = false}, 3000)})">
{{__('Image Deleted!')}}
</span>
{{-- confirm message--}}
<span x-show="confirm" x-transition.opacity.in.duration.500ms class="mt-1"
x-init="@this.on('confirmDelete', () => {confirm = true; setTimeout(() => {confirm = false}, 3000)})">
{{__('Sure?')}} 
<i @click="confirm = false" class="far fa-window-close mx-1 tx-danger" type="button"></i> 
<i  wire:click="deleteImage" @click="confirm = false" class="far fa-thumbs-up mx-1 tx-success" type="button"></i>
</span>
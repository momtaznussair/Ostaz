<div class="dropdown user-pro-body">
    <div class="">
        <img alt="user-img" class="avatar avatar-xl brround" src="{{asset('storage/' . Auth('admin')->user()->avatar)}}"><span class="avatar-status profile-status bg-green"></span>
    </div>
    <div class="user-info">
        <h4 class="font-weight-semibold mt-3 mb-0">{{Auth('admin')->user()->name}}</h4>
    </div>
</div>
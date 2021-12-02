<div class="dropdown main-profile-menu nav nav-item nav-link">
    <a class="profile-user d-flex" href=""><img alt="" src="{{asset('storage/' . Auth('admin')->user()->avatar)}}"></a>
<div class="dropdown-menu">
    <div class="main-header-profile bg-primary p-3">
        <div class="d-flex wd-100p">
            <div class="main-img-user">
                <a class="profile-user d-flex" href=""><img alt="" src="{{asset('storage/' . Auth('admin')->user()->avatar)}}"></a>
            </div>
            <div class="mr-3 my-auto">
                <h6 class="ml-2">{{Auth('admin')->user()->name}}</h6>
            </div>
        </div>
    </div>
    <a class="dropdown-item" href="{{route('admin.profile')}}"><i class="fas fa-user-alt"></i>{{__('Profile')}}</a>
    <a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="bx bx-log-out"></i>{{__('Logout')}}</a>
    <form action="{{route('admin.logout')}}" method="POST" id="logout-form">
        @csrf
    </form>
</div>
</div>
<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				{{-- logo --}}
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					@livewire('admin.profile.sidebar')
				</div>
				<ul class="side-menu">
					<li class="slide mt-3">
						<a class="side-menu__item" href="/admin"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg>
							<span class="side-menu__label">{{__('Main')}}</span>
						</a>
					</li>

					@can('Admin_access')
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide">
						<i class="fas fa-user-shield" style="color: gray; font-size:1.3rem;"></i>
						<span class="side-menu__label mx-2">{{__('Admins')}}</span>
						<i class="angle fe fe-chevron-down"></i></a>
		
						<ul class="slide-menu">
								<li><a class="slide-item" href="{{ route('admin.admins') }}">{{__('Admins')}}</a></li>
		
							@can('Role_access')
								<li><a class="slide-item" href="{{ route('admin.roles.index') }}">{{__('Roles')}}</a></li>
							@endcan

							<li><a class="slide-item" href="#" title="{{__('Trashed')}}"><i class="fas fa-trash mx-2"></i></a></li>
						</ul>
					</li>
					@endcan

					@can('Category_access')
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide">
						<i class="si si-layers" style="color: gray; font-size:1.3rem;"></i>
						<span class="side-menu__label mx-2">{{__('Categories')}}</span>
						<i class="angle fe fe-chevron-down"></i></a>
		
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('admin.categories') }}">{{__('Categories')}}</a></li>
							<li><a class="slide-item" href="#" title="{{__('Trashed')}}"><i class="fas fa-trash mx-2"></i></a></li>
						</ul>
					</li>
					@endcan

				</ul>
			</div>
		</aside>
<!-- main-sidebar -->

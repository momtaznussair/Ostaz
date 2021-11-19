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

					@can('Category_access')
					<li class="slide">
						<a class="side-menu__item" href="{{ route('admin.categories') }}">
							<i class="si si-layers side-menu__icon"></i>
							<span class="side-menu__label mt-2">{{__('Categories')}}</span>
						</a>
					</li>
					@endcan

					@can('Course_access')
					<li class="slide">
						<a class="side-menu__item" href="{{ route('admin.courses') }}">
							<i class="fas fa-compact-disc side-menu__icon"></i>
							<span class="side-menu__label mt-2">{{__('Courses')}}</span>
						</a>
					</li>
					@endcan

					@can('Country_access')
					<li class="slide">
						<a class="side-menu__item" href="{{ route('admin.countries') }}">
							<i class="fas fa-globe-europe side-menu__icon"></i>
							<span class="side-menu__label mt-2">{{__('Countries')}}</span>
						</a>
					</li>
					@endcan

					@can('City_access')
					<li class="slide">
						<a class="side-menu__item" href="{{ route('admin.cities') }}">
							<i class="fas fa-city side-menu__icon"></i>
							<span class="side-menu__label mt-2">{{__('Cities')}}</span>
						</a>
					</li>
					@endcan

					@can('User_access')
					<li class="slide">
						<a class="side-menu__item" href="{{ route('admin.instructors') }}">
							<i class="fas fa-chalkboard-teacher side-menu__icon"></i>
							<span class="side-menu__label mt-2">{{__('Instructors')}}</span>
						</a>
					</li>

					<li class="slide">
						<a class="side-menu__item" href="{{ route('admin.students') }}">
							<i class="fas fa-user-graduate side-menu__icon"></i>
							<span class="side-menu__label mt-2">{{__('Students')}}</span>
						</a>
					</li>
					@endcan

					@can('Admin_access')
					<li class="slide">
						<a class="side-menu__item" href="{{ route('admin.admins') }}">
							<i class="fas fa-user-shield side-menu__icon"></i>
							<span class="side-menu__label mt-2">{{__('Admins')}}</span>
						</a>
					</li>
					@endcan

					@can('Role_access')
					<li class="slide">
						<a class="side-menu__item" href="{{ route('admin.roles.index') }}">
							<i class="fas fa-user-tag side-menu__icon"></i>
							<span class="side-menu__label mt-2">{{__('Roles')}}</span>
						</a>
					</li>
					@endcan

				</ul>
			</div>
		</aside>
<!-- main-sidebar -->

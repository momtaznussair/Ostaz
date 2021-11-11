@extends('layouts.master')

@section('title')
	{{__('Roles')}}
@endsection

@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{__('Roles')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('All')}}</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
                <!-- row -->
				<div class="row">
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0 mb-3">
								<div class="d-flex justify-content-between">
									@can('Role_create')
										<div class="col-sm-6 col-md-4 col-xl-3">
											<a class="modal-effect btn btn-outline-primary btn-block"  href="{{route('admin.roles.create')}}">{{__('Add New')}}</a>
										</div>
									@endcan									
								</div>
							</div>
							@livewire('admin.roles.roles')
						</div>
					</div>
				</div>
				{{-- row closed  --}}
			</div>
			{{-- Container closed  --}}
		</div>
		 {{-- main-content closed --}}
@endsection
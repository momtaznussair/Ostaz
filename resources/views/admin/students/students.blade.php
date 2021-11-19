@extends('layouts.master')
@section('title')
	{{__('Students')}}
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{__('Students')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('Students')}}</span>
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
									@can('Admin_create')
										<div class="col-sm-6 col-md-4 col-xl-3">
											<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-fall" data-toggle="modal" href="#save")}}">{{__('Add New')}}</a>
										</div>
									@endcan									
								</div>
							</div>
							@livewire('admin.students.students')
						</div>
					</div>
				</div>
				{{-- row closed  --}}
			</div>
			{{-- Container closed  --}}
		</div>
		 {{-- main-content closed --}}
@endsection
@extends('layouts.master')
@section('title')
	{{__('Reports') . ' - ' .  __('Countries')}}
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{__('Reports')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('Countries')}}</span>
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
							@livewire('admin.reports.countries')
						</div>
					</div>
				</div>
				{{-- row closed  --}}
			</div>
			{{-- Container closed  --}}
		</div>
		 {{-- main-content closed --}}
@endsection
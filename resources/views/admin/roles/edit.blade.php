@extends('layouts.master')
@section('title')
	{{__('Roles') . ' - ' .  __('Edit')}}
@endsection

@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{__('Roles')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('Edit')}}</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

    @livewire('admin.roles.edit-role', ['role' => Request::route('role')])

@endsection
@extends('layouts.master')

@section('title')
	{{__('Settings')}}
@endsection

@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{__('Settings')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('Main')}}</span>
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
                            <div class="panel panel-primary tabs-style-3">
                                <div class="tab-menu-heading">
                                    <div class="tabs-menu ">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs">
                                            <li class=""><a href="#tab11" class="active" data-toggle="tab"><i class="fa fa-cogs"></i> {{__('About Us')}}</a></li>
                                            <li><a href="#tab12" data-toggle="tab"><i class="far fa-envelope"></i> {{__('Contact Us')}}</a></li>
                                            <li><a href="#tab13" data-toggle="tab"><i class="far fa-comment-dots"></i> {{__('Your Opinion')}}</a></li>
                                            <li><a href="#tab14" data-toggle="tab"><i class="far fa-bell"></i> {{__('Notifications')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab11">
                                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p>
                                            <p class="mb-0">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. </p>
                                        </div>
                                        <div class="tab-pane" id="tab12">
                                            @livewire('admin.settings.user-messages')
                                        </div>
                                        <div class="tab-pane" id="tab13">
                                            @livewire('admin.settings.user-messages', ['type' => 'opinion'])
                                        </div>
                                        <div class="tab-pane" id="tab14">
                                            @livewire('admin.settings.notify-users')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
						</div>
					</div>
				</div>
				{{-- row closed  --}}
			</div>
			{{-- Container closed  --}}
		</div>
		 {{-- main-content closed --}}
@endsection
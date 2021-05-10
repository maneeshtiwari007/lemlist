@extends('layout.auth')
@section('content')
 <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container ">
		   <!--begin::Page Heading-->
			<div class="d-flex align-items-baseline flex-wrap mr-5">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold my-1 mr-5">Projects</h5>
				<!--end::Page Title-->
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a class="text-muted">Projects</a>
					</li>
				</ul>
				<!--end::Breadcrumb-->
				<a href="{{ route('projects.add') }}" class="btn btn-primary font-weigh ml-auto"><i class="la la-plus"></i>New Project</a>
				
			</div>
			<!--end::Page Heading-->
		
		
	</div>
</div>
<!--end::Subheader-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<!--begin::Container-->
	<div class="container">
		<!--begin::Notice-->
		@if(session()->get('success'))
			<div class="alert alert-custom alert-notice alert-light-success fade show" role="alert">
				<div class="alert-icon"><i class="flaticon-warning"></i></div>
				<div class="alert-text">{{ session()->get('success') }}  </div>
				<div class="alert-close">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true"><i class="ki ki-close"></i></span>
					</button>
				</div>
			</div>
		@endif
		@if(session()->get('error'))
			<div class="alert alert-custom alert-notice alert-light-danger fade show" role="alert">
				<div class="alert-icon"><i class="flaticon-warning"></i></div>
				<div class="alert-text">{{ session()->get('error') }} </div>
				<div class="alert-close">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true"><i class="ki ki-close"></i></span>
					</button>
				</div>
			</div>
		@endif
		<div class="alert alert-custom alert-white alert-shadow fade show gutter-b d-none" role="alert">
			<div class="card-title">
			   <h3 class="card-label">Projects</h3>
			   <a href="{{ route('projects.add') }}" class="btn btn-primary font-weight-bolder text-right"><i class="la la-plus"></i>New Project</a>
			</div>
		</div>
		<!--end::Notice-->
		<div class="row mb-5">
		
		    @if(!empty($projects['data'][0]))
				@php $i=1; @endphp
	          @foreach($projects['data'] as $pro)
					<div class="col-xl-4">
						<!--begin::Card-->
						<div class="card card-custom">
							<div class="card-header">
							   <a href="{{ route('projects.view',['id'=>$pro->id])}}" class="mt-5">
								<div class="card-title">
								<h3 class="card-label">
								
									 {{ $pro['name'] }} 
								      <br>
								    <small>{{  date('d M Y',(strtotime($pro['created_at']))) }}</small><br>
								 
								 </h3>
								</div>
								</a>
								 <div class="card-toolbar">
								     @if($pro->jobs->count() != 0)
										<a href="{{ route('jobs.index').'?project='.$pro['name'] }}"> 
										  <h5> {{ $pro->jobs->count() }} Job</h5>
										 </a>
										@endif
									<div class="dropdown dropdown-inline d-none" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
										<a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="ki ki-bold-more-hor"></i>
										</a>
										<div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right" style="">
											<!--begin::Navigation-->
											<ul class="navi navi-hover">
												<li class="navi-header font-weight-bold py-4">
													<span class="font-size-lg">Choose Action:</span>
													<i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="" data-original-title="Click to learn more..."></i>
												</li>
												<li class="navi-separator mb-3 opacity-70"></li>
												@if(($user->id == $pro->user_id) || ($user->role_id == 1))
												<li class="navi-item">
													<a href="{{ route('projects.edit',['id'=>$pro->id])}}" class="navi-link">
														<span class="navi-text">
															<span class="label label-xl label-inline label-light-primary w-100"><i class="la la-edit mr-1"></i>Edit</span>
														</span>
													</a>
												</li>
												@endif
												<li class="navi-item">
													<a href="{{ route('projects.view',['id'=>$pro->id])}}" class="navi-link">
														<span class="navi-text">
															<span class="label label-xl label-inline label-light-success w-100"><i class="la la-eye mr-1"></i>View</span>
														</span>
													</a>
												</li>
												@if(($user->id == $pro->user_id) || ($user->role_id == 1))
												<li class="navi-item">
													<a href="javascript:;" class="navi-link remove-project"  data-id="{{ $pro->id }}" data-href="{{ route('projects.remove',['id'=>$pro->id])}}" id="project-delete-{{ $pro->id }}" data-toggle="modal" data-target="#success-modal">
														<span class="navi-text">
															<span class="label label-xl label-inline label-light-danger w-100"><i class="la la-close mr-1"></i>Remove</span>
														</span>
													</a>
												</li>
												@endif
												<li class="navi-separator mt-3 opacity-70"></li>
												
											</ul>
											<!--end::Navigation-->
										</div>
									</div>
								</div>
								<div class="card-toolbar d-none">
								@if(($user->id == $pro->user_id) || ($user->role_id == 1))
									<a href="{{ route('projects.edit',['id'=>$pro->id])}}" class="btn btn-sm btn-icon btn-light-primary mr-2">
										<i class="la la-edit mr-1"></i>
									</a>
								@endif
									<a href="{{ route('projects.view',['id'=>$pro->id])}}" class="btn btn-sm btn-icon btn-light-success mr-2">
										<i class="la la-eye mr-1"></i>
									</a>
								@if(($user->id == $pro->user_id) || ($user->role_id == 1))
									<a class="btn btn-sm btn-icon btn-light-danger remove-project" data-id="{{ $pro->id }}" data-href="{{ route('projects.remove',['id'=>$pro->id])}}" id="project-delete-{{ $pro->id }}" data-toggle="modal" data-target="#success-modal">
										<i class="la la-close mr-1"></i>
									</a>
								@endif
								</div>
								
							</div>
							<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<div class="heading">Url <strong>(+{{ $pro->urls->count() }})</strong></div>
								</div>
								@if($pro->urls->count() !=0)
								<div class="col-md-6 text-right">
									<a href="{{ route('projects.viewurl',['id'=>$pro->id])}}" class="btn btn-sm btn-icon btn-light-success mr-2">
										<i class="la la-eye mr-1"></i>
									</a>
								</div>
								@endif
							</div>
							<hr>
							@if($pro->urls->count() !=0)
								@foreach($pro->urls as $proUrl)
								<!--<div class="row">
									<div class="col-md-12">
										<div class="heading"> {{ $proUrl->url_name }} <strong>(+{{ $pro->exactKeywords->count() }})</strong></div>
									</div>
								</div>
								<hr>-->
							@endforeach
							@endif
							<div class="row">
								<div class="col-md-12">
									<div class="heading">Exact keyword <strong>(+{{ $pro->exactKeywords->count() }})</strong></div>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-12">
									<div class="heading">Partial keyword <strong>(+{{ $pro->partialKeywords->count() }})</strong></div>
								</div>
							</div>
							
							<hr>
							<div class="row">
								<div class="col-md-12">
									<div class="card-toolbar text-right">
										@if(($user->id == $pro->user_id) || ($user->role_id == 1))
											<a href="{{ route('projects.edit',['id'=>$pro->id])}}" class="btn btn-sm btn-icon btn-light-primary mr-2">
												<i class="la la-edit mr-1"></i>
											</a>
										@endif
											<a href="{{ route('projects.view',['id'=>$pro->id])}}" class="btn btn-sm btn-icon btn-light-success mr-2">
												<i class="la la-eye mr-1"></i>
											</a>
										@if(($user->id == $pro->user_id) || ($user->role_id == 1))
											<a class="btn btn-sm btn-icon btn-light-danger remove-project" data-id="{{ $pro->id }}" data-href="{{ route('projects.remove',['id'=>$pro->id])}}" id="project-delete-{{ $pro->id }}" data-toggle="modal" data-target="#success-modal">
												<i class="la la-close mr-1"></i>
											</a>
										@endif
										</div>
								</div>
							</div>
							
							</div>
							
						</div>
				<!--end::Card-->
				</div>
				 @if(($i%3==0))
					 </div>
				     <div class="row mb-5">
				  @endif
				   @php $i=$i+1;@endphp
				@endforeach
				@else
					<div class="col-xl-12">
					 <div class="card card-custom">
					  <div class="card-body">
						<h3>No Data Found</h3>
					  </div>
					  </div>
				
					</div>
				@endif
				
				
				
			
			</div>
			<div class="ht-80 bd d-flex align-items-center justify-content-end">
				<ul class="pagination pagination-basic pagination-primary mg-r-10">
					{{ $projects['data']->appends(request()->except('page'))->render() }}
				</ul>
			</div>
	</div>
	<!--end::Container-->
</div>
<!--end::Entry-->
</div>
<!-- Start Remove Modal -->
<!-- Start Remove Modal -->
<div id="success-modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Project Removal Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure you want remove this Project,url & all keywords?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <a type="button" class="btn btn-primary text-white remove-activity">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- End Remove Modal -->
@endsection
@section('script')
<script>

$("body").on("click",".remove-project",function(){
	    var id = $(this).attr('data-id');
		var dataHref = $("#project-delete-"+id).attr('data-href');
		$(".remove-activity").attr('href',dataHref);
	 });
</script>
@endsection
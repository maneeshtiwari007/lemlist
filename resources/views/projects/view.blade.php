@extends('layout.auth')
@section('content')
 <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<!--begin::Info-->
		<div class="d-flex align-items-center flex-wrap mr-1">
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
						<a class="text-muted">{{ $getProjects->name }}</a>
					</li>
				</ul>
				<!--end::Breadcrumb-->
			</div>
			<!--end::Page Heading-->
		</div>
		<!--end::Info-->
		
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
			   <h3 class="card-label">Projects
			   <a href="{{ route('projects.add') }}" class="btn btn-primary font-weight-bolder text-right"><i class="la la-plus"></i>New Project</a>
			</div>
		</div>
		<!--end::Notice-->
		<div class="row mb-5">
		
					<div class="col-xl-12">
						<!--begin::Card-->
						<div class="card card-custom">
							<div class="card-header">
								<div class="card-title">
									<h3 class="card-label">{{ $getProjects->name }}<br>
									<small>
									   {{ date('d M Y',strtotime($getProjects->created_at)) }}
									</small><br>
									 @if($getProjects->jobs->count() != 0)
									<a href="{{ route('jobs.index').'?project='.$getProjects->name }}"> 
									 <small class="text-primary">
									 ({{ $getProjects->jobs->count() }} Job)
									 </small>
									 </a>
									 @endif
									 
									 </h3>
								</div>
								<div class="card-toolbar">
										<a href="{{ route('projects.index') }}" class="btn btn-light-primary font-weight-bolder mr-2">
										<i class="fa fa-arrow-left icon-xs"></i>Back</a>
										@if(($user->id == $getProjects->user_id) || ($user->role_id == 1))
										<a href="{{ route('projects.edit',['id'=>$getProjects->id]) }}" class="btn btn-light-primary font-weight-bolder mr-2">
										<i class="fa fa-edit icon-xs"></i>Edit</a>
										@endif
										
									</div>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										{{ $getProjects->description }}
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12">
										<!--begin::Example-->
										<div class="example mb-10">
											<div class="table-responsive project-url">
												<table class="table table-borderless" id="exports-table">
													<thead>
														<tr>
															<th colspan="3">Url (<strong>+ {{ $getProjects->urls->count() }}</strong>)</th>
														</tr>
													</thead>
													<tbody>
													 @if($getProjects->urls->count() !=0)
													  @foreach($getProjects->urls as $proUrl)
													   <tr>
													     <td>{{ $loop->iteration }}</td>
													     <td>{{ $proUrl->url_name }} <br> 
															 <span class='badge badge-info mt-3 brand_keyword' data-project-url-id="{{ $proUrl->id }}" style="font-size:11px; cursor:pointer;" title="Brand keyword List">Brand Keyword ({{ $proUrl->brandKeywords->count() }})</span>  
															 <span class='badge badge-success mt-3 secondary_keyword' data-project-url-id="{{ $proUrl->id }}" style="font-size:11px; cursor:pointer;" title="Secondary keyword List">Seondary Keyword ({{ $proUrl->secondaryKeywords->count() }})</span>
														 </td>
														 <td><a href="{{ route('projects.managekeyword',['id'=>$proUrl->id])}}" class="btn btn-light-primary font-weight-bolder mr-2" title="Add Brand & Secondary Keywords">
																	Manage
																</a>
														</td>
													   </tr>
													  @endforeach 
												   @endif
													  
														
													</tbody>
												</table>
												</div>
											
											
										</div>
										<!--end::Example-->
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-6 exact">
										<div class="heading">Exact keyword (<strong>+ {{ $getProjects->exactKeywords->count() }}</strong>)</div>
										 @if($getProjects->exactKeywords->count() !=0)
										  @foreach($getProjects->exactKeywords as $proExactKeyword)
											<div>
											  <span class='badge badge-secondary mt-3' style="font-size:11px">{{ $proExactKeyword->exact_keywords }}</span>
											</div>
											
										  @endforeach 
									  @endif
									</div>
									<div class="col-md-6 partial">
										<div class="heading">Partial keyword (<strong>+ {{ $getProjects->partialKeywords->count() }}</strong>)</div>
										@if($getProjects->partialKeywords->count() !=0)
										  @foreach($getProjects->partialKeywords as $proPartialKeyword)
									       <div>
											  <span class='badge badge-info mt-3' style="font-size:11px">{{ $proPartialKeyword->partial_keywords }}</span>
											</div>
										@endforeach 
									  @endif
									</div>
								</div>
								<hr>
								
							
							<div class="row">
									<div class="col-md-12">
										<!--begin::Card-->
											<div class="card-title">
														<h3 class="card-label">Recent Jobs</h3>
													</div>
												   <!--begin::Accordion-->
													<div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample3">
													  @if($getProjects->jobs->count() !=0)
														 @php $i=1; @endphp
														  @foreach($getProjects->jobs->take(5) as $job)
															<div class="card">
																<div class="card-header" id="heading{{$i}}">
																	<div class="card-title {{ ($i==1) ? '' : 'collapsed'}}" data-toggle="collapse" data-target="#collapse{{$i}}"><h4>{{ $job->job_title }}</h4></div>
																</div>
																<div id="collapse{{$i}}" class="collapse {{ ($i==1) ? 'show' : ''}}" data-parent="#accordionExample3">
																	<div class="card-body">
																	   <div class="row mb-5">
																	    <div class="col-xl-12">
																			
																			<div class="card-toolbar text-right">
																			@if(($user->id == $job->created_by_user) || ($user->role_id == 1))
																				<a href="{{ route('projects.job.edit',['id'=>$job->id])}}" class="btn btn-sm btn-icon btn-light-primary mr-2" title="Edit">
																						<i class="la la-edit mr-1"></i>
																					</a>
																			@endif
																				<a href="{{ route('projects.job.view',['id'=>$job->id])}}" class="btn btn-sm btn-icon btn-light-success mr-2" title="View">
																						<i class="la la-eye mr-1"></i>
																				</a>
																			@if(($user->id == $job->created_by_user) || ($user->role_id == 1))
																				<a href="{{ route('projects.job.csv.download',['id'=>$job->id])}}" class="btn btn-sm btn-icon btn-light-info mr-2" title="Csv Download">
																						<i class="la la-download mr-1"></i>
																				</a>
																			@endif
																				</div>
																			</div>
																			</div>
																	   <div class="row">
																	         <div class="col-xl-6">
																			   <div class="table-responsive">
																						<table class="table table-borderless">
																							<tbody>
																								<tr>
																									<td><h6><span class="">Choose number of searches</span></h6></td>
																									<td>{{ $job->no_of_searches}}</td>
																								</tr>
																								<tr>
																									<td><h6><span class="">Yes Percentage</span></h6></td>
																									<td>{{ $job->project_url_yes_percentage }} %</td>
																								</tr>
																								<tr>
																									<td><h6><span class="">Length Of Job</span></h6></td>
																									<td>{{ ucfirst($job->project_url_length_of_job) }}</td>
																								</tr>
																								<tr>
																									<td><h6><span class="">Minimum Range</span></h6></td>
																									<td>{{ $job->project_url_minimum_range }} Seconds</td>
																								</tr>
																								
																								
																							</tbody>
																						</table>
																					</div>
																			</div>
																			 <div class="col-xl-6">
																			   <div class="table-responsive">
																						<table class="table table-borderless">
																							<tbody>
																								<tr>
																									<td><span class=""><h6>Capitalize First Letter Percentage</h6></span></td>
																									<td>{{ $job->project_url_capitalize_percentage }} %</td>
																								</tr>
																								<tr>
																									<td><h6><span class="">No Percentage</span></h6></td>
																									<td>{{ $job->project_url_no_percentage }} %</td>
																								</tr>
																								@if($job->project_url_length_of_job == 'random')
																								<tr>
																									<td><h6><span class="">Random Job Hours</span></h6></td>
																									<td>{{ $job->project_url_random_job }} Hours</td>
																								</tr>
																								@endif
																								<tr>
																									<td><h6><span class="">Maximum Range</span></h6></td>
																									<td>{{ $job->project_url_maximum_range }} Seconds</td>
																								</tr>
																							</tbody>
																						</table>
																					</div>
																			</div>
																		  </div>
																		  <hr>
																		  <div class="row">
																		    <div class="col-12">
																				<div class="table-responsive">
																						<table class="table table-borderless mb-0">
																						   <thead>
																								<tr>
																									<th>#</th>
																									<th>Country Code</th>
																									<th>Weight</th>
																								</tr>
																							</thead>
																							<tbody>
																							@if($job->countryPercentage->count()!=0)
																							  @php $j=1; @endphp
																							   @foreach($job->countryPercentage as $countryPercentageData)
																								<tr>
																									<td>{{ $loop->iteration }}</td>
																									<td>{{ $countryPercentageData->country_code }}</td>
																									<td>{{ $countryPercentageData->country_weight }} %</td>
																									
																								</tr>
																								
																								 @php $j=$j+1; @endphp
																							@endforeach
																						  @else
																							<tr>
																							   <td colspan="3" class="text-center">No Data Found</td>
																							 </tr>  
																						  @endif
																							</tbody>
																						</table>
																					</div>
																				
																			</div>
																		  </div>
																		  <hr>
																		@if($job->jobDetails->count()!=0)
																			@foreach($job->jobDetails as $jobDetailsData)
																			<div class="row mt-3">
																				  <div class="col-xl-12">
																							    <h4 class="">{{ $loop->iteration }}. {{ $jobDetailsData->projectUrls->url_name }}</h4>
																								  <div class="row mt-5">
																									  <div class="col-6">
																									       <div class="table-responsive">
																														<table class="table table-borderless mb-0">
																															<tbody>
																																<tr>
																																	<td><h6><span class="">Url Weight</span></h6></td>
																																	<td>{{ $jobDetailsData->project_url_weight }} %</td>
																																</tr>
																																
																																<tr>
																																	<td><h6><span class="">Brand + Exact Keyword</span></h6></td>
																																	<td>{{ $jobDetailsData->project_url_brand_plus_exact }} %</td>
																																</tr>
																																
																																<tr>
																																	<td><h6><span class="">Partial + Secondary Keyword</span></h6></td>
																																	<td>{{ $jobDetailsData->project_url_partial_plus_exact }} %</td>
																																</tr>
																																
																															</tbody>
																														</table>
																													</div>
																													
																									  </div>
																									  <div class="col-6">
																									 
																										   <div class="table-responsive">
																												<table class="table table-borderless mb-0">
																													<tbody>
																														<tr>
																															<td><h6><span class="">Exact Keyword</span></h6></td>
																															<td>{{ $jobDetailsData->project_url_exact }} %</td>
																														</tr>
																														<tr>
																															<td><h6><span class="">Secondary + Exact Keyword</span></h6></td>
																															<td>{{ $jobDetailsData->project_url_secondary_plus_exact }} %</td>
																														</tr>
																														<tr>
																															<td><h6><span class="">Partial + Brand Keyword</span></h6></td>
																															<td>{{ $jobDetailsData->project_url_partial_plus_brand }} %</td>
																														</tr>
																														
																													
																													</tbody>
																												</table>
																											</div>
																											
																									  </div>
																								  </div>
																								
																							
																								
																						
																					<!--end::Card-->
																					</div>
																			</div>
																			@endforeach
																		@endif
																	</div>
																</div>
															</div>
															 @php $i=$i+1; @endphp
															@endforeach
															 @if(($getProjects->jobs->count()) !=0 && ($getProjects->jobs->count() >5))
															  <div class="toolbar text-right">
																   <a href="{{ route('jobs.index') }}" class="btn btn-info font-weight-bolder font-size-sm">View More job</a>
																</div>
															 @endif
														@else
															<div class="card">
														       <h3 class="text-center">No Job Found</h3>
														    </div>
														@endif
														
													</div>
													<!--end::Accordion-->
													
												
											
											<!--end::Card-->
									</div>
								</div>
							</div>
							
						</div>
				<!--end::Card-->
				</div>
				
				
				
				
			
			</div>
			
	</div>
	<!--end::Container-->
</div>
<!--end::Entry-->
</div>
<!-- Start Remove Modal -->
<div id="brand-keyword-modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Brand Keywords</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body brand_result">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
             </div>
        </div>
    </div>
</div>
<div id="secondary-keyword-modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Secondary Keywords</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body seconadry_result">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
             </div>
        </div>
    </div>
</div>
<!-- End Remove Modal -->
@endsection
@section('script')
<script>
$("body").on("click",".brand_keyword",function(){
	var selectUrl = "{{route('projects.projecturl.brandkeyword.list')}}";
	var projectUrlId = $(this).attr('data-project-url-id');
	if(projectUrlId!=''){
		$('#brand-keyword-modal').modal('show');
		$('.brand_result').html('Loading ...');
		var objData = {};
		var sendData = {};
		sendData = {
			projectUrlId: projectUrlId
			};
			objData = {
		      url: selectUrl,
			  type: 'post',
			  sendData: sendData
			 };
			send_ajax_request(objData, function (callback) {
			  if (callback.status == "200") {
				$('.brand_result').html('');
				$(".brand_result").html(callback.result);
				return false;
			  }
			 });
	}
});
$("body").on("click",".secondary_keyword",function(){
	var selectUrl = "{{route('projects.projecturl.secondarykeyword.list')}}";
	var projectUrlId = $(this).attr('data-project-url-id');
	if(projectUrlId!=''){
		$('#secondary-keyword-modal').modal('show');
		$('.seconadry_result').html('Loading ...');
		var objData = {};
		var sendData = {};
		sendData = {
			projectUrlId: projectUrlId
			};
			objData = {
		      url: selectUrl,
			  type: 'post',
			  sendData: sendData
			 };
			send_ajax_request(objData, function (callback) {
			  if (callback.status == "200") {
				$('.seconadry_result').html('');
				$(".seconadry_result").html(callback.result);
				return false;
			  }
			 });
	}
});
</script>
@endsection
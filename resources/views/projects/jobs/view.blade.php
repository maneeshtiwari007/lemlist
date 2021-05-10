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
				<h5 class="text-dark font-weight-bold my-1 mr-5">{{ $getJobs->job_title}}  Job</h5>
				<!--end::Page Title-->
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a href="{{ route('jobs.index') }}" class="text-muted">projects</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a href="{{ route('jobs.index') }}" class="text-muted">Jobs</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a class="text-muted">{{ $getJobs->job_title}}  Job</a>
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
		
		<!--end::Notice-->
		<div class="row mb-5">
              <div class="col-xl-12">
						<!--begin::Card-->
						<div class="card card-custom">
							<div class="card-header">
								<div class="card-title">
									<h3 class="card-label">{{ $getJobs->job_title}} Job
								</div>
								<div class="card-toolbar">
										<a href="{{ route('projects.view',['id'=>$getJobs->project_id]) }}" class="btn btn-light-primary font-weight-bolder mr-2">
										<i class="ki ki-long-arrow-back icon-xs"></i>Back</a>
								 @if(($user->id == $getJobs->created_by_user) || ($user->role_id == 1))
										<a href="{{ route('projects.job.edit',['id'=>$getJobs->id]) }}" class="btn btn-light-primary font-weight-bolder mr-2">
										<i class="fa fa-edit icon-xs"></i>Edit</a>
								 @endif
								  @if(($user->id == $getJobs->created_by_user) || ($user->role_id == 1))
										<a href="{{ route('projects.job.csv.download',['id'=>$getJobs->id]) }}" class="btn btn-light-primary font-weight-bolder mr-2">
										<i class="fa fa-download icon-xs"></i>CSV Download</a>
										<a href="{{ route('api.v1.get-crawler',['id'=>$getJobs->id]) }}" class="btn btn-light-primary font-weight-bolder mr-2">Post Your Job</a>
										@if(!empty($getPostJobCrawler[0]))
								        <a href="javascript:;" class="btn btn-light-primary font-weight-bolder mr-2 report-job" data-id="{{ $getJobs->id }}" data-toggle="modal" data-target="#report-modal" title="Report Job Crawler">Report</a>
									   @endif
								 @endif
								</div>
								
							</div>
							     <div class="card-body">
							        <div class="row">
									 <div class="col-6">
									 <div class="widget has-shadow">

										   <div class="table-responsive">
												<table class="table table-borderless mb-0">
													<tbody>
														<tr>
															<td><h6><span class="">Job Title</span></h6></td>
															<td>{{ $getJobs->job_title}}</td>
														</tr>
														<tr>
															<td><h6><span class="">Choose number of searches</span></h6></td>
															<td>{{ $getJobs->no_of_searches}}</td>
														</tr>
														<tr>
															<td><h6><span class="">Yes Percentage</span></h6></td>
															<td>{{ $getJobs->project_url_yes_percentage }} %</td>
														</tr>
														<tr>
															<td><h6><span class="">Length Of Job</span></h6></td>
															<td>{{ ucfirst($getJobs->project_url_length_of_job) }}</td>
														</tr>
														
														<tr>
															<td><h6><span class="">Minimum Range</span></h6></td>
															<td>{{ $getJobs->project_url_minimum_range }} Seconds</td>
														</tr>
														
													</tbody>
												</table>
											</div>
											</div>
									 </div>
									  <div class="col-6">
									 <div class="widget has-shadow">

										   <div class="table-responsive">
												<table class="table table-borderless mb-0">
													<tbody>
														<tr>
															<td><h6><span class="">Project</span></h6></td>
															<td>{{ $getJobs->projects->name}}</td>
														</tr>
														<tr>
															<td><span class=""><h6>Capitalize First Letter Percentage</h6></span></td>
															<td>{{ $getJobs->project_url_capitalize_percentage }} %</td>
														</tr>
														<tr>
															<td><h6><span class="">No Percentage</span></h6></td>
															<td>{{ $getJobs->project_url_no_percentage }} %</td>
														</tr>
														@if($getJobs->project_url_length_of_job == 'random')
														<tr>
															<td><h6><span class="">Random Job Hours</span></h6></td>
															<td>{{ $getJobs->project_url_random_job }} Hours</td>
														</tr>
														@endif
														<tr>
															<td><h6><span class="">Maximum Range</span></h6></td>
															<td>{{ $getJobs->project_url_maximum_range }} Seconds</td>
														</tr>
													</tbody>
												</table>
											</div>
											</div>
									 </div>
									</div>
									<div class="row">
									<div class="col-12">
										<div class="widget has-shadow">
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
														@if($getJobs->countryPercentage->count()!=0)
														  @php $i=1; @endphp
														   @foreach($getJobs->countryPercentage as $countryPercentageData)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $countryPercentageData->country_code }}</td>
																<td>{{ $countryPercentageData->country_weight }} %</td>
																
															</tr>
															
															 @php $i=$i+1; @endphp
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
									</div>
							    </div>
							
						</div>
				<!--end::Card-->
				</div>
		</div>
		@if($getJobs->jobDetails->count()!=0)
		@foreach($getJobs->jobDetails as $jobDetailsData)
		<div class="row mb-5">
              <div class="col-xl-12">
						<!--begin::Card-->
						<div class="card card-custom">
							<div class="card-header">
								<div class="card-title">
									<h3>{{ $loop->iteration }}. {{ $jobDetailsData->projectUrls->url_name }}</h3>
								</div>
							</div>
							<div class="card-body">
							 <div class="row">
								  <div class="col-6">
								    <div class="widget has-shadow">
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
								  </div>
								  <div class="col-6">
								  <div class="widget has-shadow">
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
							  </div>
							
							
						</div>
							
						</div>
				<!--end::Card-->
				</div>
		</div>
		@endforeach
	@endif
			
	</div>
	<!--end::Container-->
</div>
<!--end::Entry-->
</div>
<!-- Start Remove Modal -->
<div id="modal-remove-activity" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">User Removal Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal">
                   <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure you want remove this User?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <a type="button" class="btn btn-primary text-white remove-activity">Yes</a>
            </div>
        </div>
    </div>
</div>
<div id="report-modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Job Report</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body display-report">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <a type="button" class="btn btn-primary text-white remove-activity d-none">Yes</a>
            </div>
        </div>
    </div>
</div>
<!-- End Remove Modal -->
@endsection
@section('script')
<script>

$("body").on("click",".remove-job",function(){
		var id = $(this).attr('data-id');
		var dataHref = $("#job-delete-"+id).attr('data-href');
		$(".remove-activity").attr('href',dataHref);
	 });
	 $("body").on("click",".report-job",function(){
		$('.display-report').html('Loading ...');
		var id = $(this).attr('data-id');
		var selectUrl = "{{route('api.v1.report-crawler')}}";
	   if(id != ''){
			var objData = {};
			var sendData = {};
			sendData = {
				id: id
				};
				objData = {
			      url: selectUrl,
				  type: 'post',
				  sendData: sendData
				 };
				send_ajax_request(objData, function (callback) {
				  if (callback.status == "200") {
					$('.display-report').html('');
					$(".display-report").html(callback.result);
					return false;
				  }
				 });
			
	   }
 });
</script>
@endsection
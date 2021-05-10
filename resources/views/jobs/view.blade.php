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
		<!--begin::Toolbar-->
		<div class="d-flex align-items-center">
			<!--begin::Actions-->
			<!--end::Actions-->
			<!--begin::Dropdown-->
			<div class="dropdown dropdown-inline d-none" data-toggle="tooltip" title="Quick actions" data-placement="left">
				<a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="svg-icon svg-icon-success svg-icon-2x">
						<!--begin::Svg Icon | path:assets/media/svg/icons/Files/File-plus.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24" />
								<path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
								<path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
				</a>
				<div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 m-0 d-none">
					<!--begin::Navigation-->
					<ul class="navi navi-hover">
						<li class="navi-header font-weight-bold py-4">
							<span class="font-size-lg">Choose Label:</span>
							<i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
						</li>
						<li class="navi-separator mb-3 opacity-70"></li>
						<li class="navi-item">
							<a href="#" class="navi-link">
								<span class="navi-text">
									<span class="label label-xl label-inline label-light-success">Customer</span>
								</span>
							</a>
						</li>
						<li class="navi-item">
							<a href="#" class="navi-link">
								<span class="navi-text">
									<span class="label label-xl label-inline label-light-danger">Partner</span>
								</span>
							</a>
						</li>
						<li class="navi-item">
							<a href="#" class="navi-link">
								<span class="navi-text">
									<span class="label label-xl label-inline label-light-warning">Suplier</span>
								</span>
							</a>
						</li>
						<li class="navi-item">
							<a href="#" class="navi-link">
								<span class="navi-text">
									<span class="label label-xl label-inline label-light-primary">Member</span>
								</span>
							</a>
						</li>
						<li class="navi-item">
							<a href="#" class="navi-link">
								<span class="navi-text">
									<span class="label label-xl label-inline label-light-dark">Staff</span>
								</span>
							</a>
						</li>
						<li class="navi-separator mt-3 opacity-70"></li>
						<li class="navi-footer py-4">
							<a class="btn btn-clean font-weight-bold btn-sm" href="#">
							<i class="ki ki-plus icon-sm"></i>Add new</a>
						</li>
					</ul>
					<!--end::Navigation-->
				</div>
			</div>
			<!--end::Dropdown-->
		</div>
		<!--end::Toolbar-->
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
										<a href="{{ route('jobs.index') }}" class="btn btn-light-primary font-weight-bolder mr-2">
										<i class="ki ki-long-arrow-back icon-xs"></i>Back</a>
								 @if(($user->id == $getJobs->created_by_user) || ($user->role_id == 1))
										<a href="{{ route('jobs.edit',['id'=>$getJobs->id]) }}" class="btn btn-light-primary font-weight-bolder mr-2">
										<i class="fa fa-edit icon-xs"></i>Edit</a>
								 @endif
								 @if(($user->id == $getJobs->created_by_user) || ($user->role_id == 1))
										<a href="{{ route('jobs.csv.download',['id'=>$getJobs->id]) }}" class="btn btn-light-primary font-weight-bolder mr-2">
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
								<div class="row w-100 mb-5">
									<div class="col-3 exact">
									   <span class='badge badge-secondary mt-3 exact_keyword' data-project-id="{{ $getJobs->project_id }}" style="font-size:11px; cursor:pointer;" title="Exact keyword List">Exact Keyword ({{ $getJobs->projectExactKeyword->count() }})</span>  
									</div>
									<div class="col-3 project-url">
									  <span class='badge badge-primary mt-3 brand_keyword' data-project-url-id="{{ $jobDetailsData->projectUrls->id }}" style="font-size:11px; cursor:pointer;" title="Brand keyword List">Brand Keyword ({{ $jobDetailsData->projectUrls->brandKeywords->count() }})</span>  
									</div>
									<div class="col-3 project-url">
									  <span class='badge badge-success mt-3 secondary_keyword' data-project-url-id="{{ $jobDetailsData->projectUrls->id }}" style="font-size:11px; cursor:pointer;" title="Secondary keyword List">Secondary Keyword ({{ $jobDetailsData->projectUrls->secondaryKeywords->count() }})</span>  
									</div>
									<div class="col-3 partial">
									   <span class='badge badge-info mt-3 partial_keyword' data-project-id="{{ $getJobs->project_id }}" style="font-size:11px; cursor:pointer;" title="Partial keyword List">Partial Keyword ({{ $getJobs->projectPartialKeyword->count() }})</span>  
									</div>
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
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">close</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure you want remove this User?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-shadow" data-dismiss="modal">Close</button>
                <a type="button" class="btn btn-primary text-white remove-activity">Yes</a>
            </div>
        </div>
    </div>
</div>
<!-- End Remove Modal -->
<!-- Start Remove Modal -->
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
<div id="exact-keyword-modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Exact Keywords</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body exact_result">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
             </div>
        </div>
    </div>
</div>
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
<div id="partial-keyword-modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Partial Keywords</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body partial_result">
                
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
 $("body").on("click",".exact_keyword",function(){
	var selectUrl = "{{route('projects.exactkeyword.list')}}";
	var projectId = $(this).attr('data-project-id');
	if(projectId!=''){
		$('#exact-keyword-modal').modal('show');
		$('.exact_result').html('Loading ...');
		var objData = {};
		var sendData = {};
		sendData = {
			projectId: projectId
			};
			objData = {
		      url: selectUrl,
			  type: 'post',
			  sendData: sendData
			 };
			send_ajax_request(objData, function (callback) {
			  if (callback.status == "200") {
				$('.exact_result').html('');
				$(".exact_result").html(callback.result);
				return false;
			  }
			 });
	}
});
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
$("body").on("click",".partial_keyword",function(){
	var selectUrl = "{{route('projects.partialkeyword.list')}}";
	var projectId = $(this).attr('data-project-id');
	if(projectId!=''){
		$('#partial-keyword-modal').modal('show');
		$('.partial_result').html('Loading ...');
		var objData = {};
		var sendData = {};
		sendData = {
			projectId: projectId
			};
			objData = {
		      url: selectUrl,
			  type: 'post',
			  sendData: sendData
			 };
			send_ajax_request(objData, function (callback) {
			  if (callback.status == "200") {
				$('.partial_result').html('');
				$(".partial_result").html(callback.result);
				return false;
			  }
			 });
	}
});
	 
</script>
@endsection
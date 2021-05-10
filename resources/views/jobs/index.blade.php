@extends('layout.auth')
@section('content')
 <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container ">
		<!--begin::Info-->
		
			<!--begin::Page Heading-->
			<div class="d-flex align-items-baseline flex-wrap mr-5">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold my-1 mr-5">Jobs</h5>
				<!--end::Page Title-->
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a class="text-muted">Jobs</a>
					</li>
				</ul>
				<!--end::Breadcrumb-->
				<a href="{{ route('jobs.add') }}" class="btn btn-primary font-weigh ml-auto"><i class="la la-plus"></i>New Job</a>
			</div>
			<!--end::Page Heading-->
		
		<!--end::Info-->
		
	</div>
</div>
<!--end::Subheader-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<!--begin::Container-->
	<div class="container">
	@if(session()->get('success'))
			<div class="alert alert-custom alert-notice alert-light-success fade show" role="alert">
				<div class="alert-icon"><i class="flaticon-warning"></i></div>
				<div class="alert-text">{!! session()->get('success') !!}  </div>
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
				<div class="alert-text">{!! session()->get('error') !!} </div>
				<div class="alert-close">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true"><i class="ki ki-close"></i></span>
					</button>
				</div>
			</div>
		@endif
		
		<div class="row">
			<div class="col-xl-12">
				<!--begin::Card-->
				<div class="card card-custom gutter-b">
					<div class="card-header flex-wrap py-3">
										<div class="card-title">
											<h3 class="card-label">Jobs
											</div>
											
												<div class="card-toolbar">
												
													<div class="form-group mb-0 mr-3">
															<select class="form-control search_by_user" name="user" id="search_bu_user" >
															  <option value="">Search By User</option>
															  @if(!empty($getUsers['total'] !=0))
																  @foreach($getUsers['data'] as $user)
																	<option value="{{ $user->id }}" {{ (!empty($get['user']) && ($get['user'] == $user->id)) ? 'selected' : '' }}>{{ $user->name }}</option>
																  @endforeach
															   @endif
															</select>
														</div>
														<div class="form-group mb-0 mr-3">
															<select class="form-control search_by_project" name="project" id="search_by_project" >
															  <option value="">Search By Project</option>
															  @if(!empty($getProjects['total'] !=0))
																  @foreach($getProjects['data'] as $project)
																	<option value="{{ $project->id }}" {{ (!empty($get['project']) && ($get['project'] == $project->id)) ? 'selected' : '' }}>{{ $project->name }}</option>
																  @endforeach
															   @endif
															</select>
														</div>
														<!--begin::Button-->
														<button type="button" class="btn btn-primary font-weight-bolder search-filter">
														<i class="la la-search"></i>Search</button>
														<!--end::Button-->
													
												</div>
										
									</div>
					<div class="card-body">
					   
						<!--begin::Example-->
						
						<div class="example mb-10">
							<div class="table-responsive">
								<table class="table" id="exports-table">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">Job Title</th>
											<th scope="col">Project</th>
											<th scope="col">No Of Searches</th>
											<th scope="col">Project Url</th>
											<th scope="col">Actions</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
								</div>
							
							
						</div>
						<!--end::Example-->
						
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
<div id="success-modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Job Removal Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>
                   Are you sure you want remove this Job & all job details?
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
<!-- End Remove Modal -->
@endsection
@section('script')
<script>

		$('#exports-table').DataTable({
		dom: 'Bfrtip',
		buttons: [],
		processing: true,
		serverSide: true,
		ajax: {
			url:"{{ route('jobs.index')}}",
			 type: 'GET',
			  data: function (d) {
			  d.user = $('.search_by_user').val();
			  d.project = $('#search_by_project').val();
			  }
		},
		order: [
				[1, "asc"]
				   ],
			columnDefs: [ { orderable: false, targets: [0,4,5] } ],
		columns: [
			{ data: 'DT_RowIndex', searchable: false },
			{ data: 'job_title' },
			{ data: 'projects.name' },
			{ data: 'no_of_searches' },
			{ data: 'count' },
			{ data: 'action'},
		],
		searching: true,
		language: {
				searchPlaceholder: 'Search by job title ...',
				sSearch: '',
				lengthMenu: '',
			  }
	});
$(".search-filter").click(function(){

	 $('#exports-table').DataTable().draw(true);

});
 // var getVal = $('.search_by_project').val();
   // $('.form-control-sm').val(getVal);
	// $('.form-control-sm').keyup();
// $('.search-filter').on('click', function () {
	// var getVal = $('.search_by_project').val();
	// $('.form-control-sm').val(getVal);
	// $('.form-control-sm').keyup();
  // } );
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
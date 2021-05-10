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
				<h5 class="text-dark font-weight-bold my-1 mr-5">Jobs</h5>
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
						<a class="text-muted">Add New Job</a>
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
			<a href="#" class="btn btn-light-primary font-weight-bolder btn-sm d-none">Actions</a>
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
		<div class="row">
			<div class="col-md-12">
				<!--begin::Card-->
				<div class="card card-custom gutter-b example example-compact">
					<div class="card-header">
						<h3 class="card-title">Add New Job</h3>
						<div class="card-toolbar">
							<a href="{{ route('jobs.index') }}" class="btn btn-light-primary font-weight-bolder mr-2">
							<i class="ki ki-long-arrow-back icon-xs"></i>Back</a>
							
						</div>
						
					</div>
					<!--begin::Form-->
					  <form action="{{ route('jobs.add.post') }}" class="form-horizontal" enctype="multipart/form-data" method="post" id="job-form">
						@csrf
						<div class="card-body">
						<div class="row">
						  <div class="col-md-6">
							<div class="form-group">
							 <label>Job Title
							  <span class="text-danger">*</span></label>
							  <input type="hidden" id="hid_weight_percetage_val" value="">
							   <input required type="text" name="job_title" placeholder="Enter Job Title " class="form-control" data-parsley-error-message="Please enter job title">
							</div>
						  </div>
						 <div class="col-md-6">
							<div class="form-group">
								<label id="exampleSelect1">Project
								<span class="text-danger">*</span></label>
								<select name="project_id" class="form-control select_project" id="exampleSelect1" data-parsley-error-message="Please select role" required>
									<option value="">Select a project</option>
									  @if(!empty($projects['data'][0]))
                                        @foreach($projects['data'] as $pro)
									      <option value="{{ $pro['id'] }}">{{ $pro['name'] }}</option>
										@endforeach
                                      @endif
								</select>
							</div>
						 </div>
					   </div>
					   <div class="row">
						  <div class="col-md-12">
							<div class="form-group">
							 <label>Choose number of searches
							  <span class="text-danger">*</span></label>
							   <input required type="text" name="no_of_searches" placeholder="Choose number of searches between 0-1000" class="form-control" data-parsley-type="number" data-parsley-min="1" data-parsley-max="1000" data-parsley-error-message="Please enter number between 0-1000">
							</div>
						  </div>
						
					   </div>
					   <hr>
					   <div class="display_project">
					        
				       </div>
					  
					</div>
					<div class="card-footer">
						<button type="submit" class="btn btn-primary mr-2">Submit</button>
						
					</div>
					</form>
					<!--end::Form-->
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
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function () {
	$('#job-form').parsley();
	 var selectprojectval = $('.select_project').val();
	  var hid_job_id = '';
	   var selectUrl = "{{route('jobs.projecturl.list')}}";
	   $(".display_project").html("Loading...");
	   if(selectprojectval != ''){
			var objData = {};
			var sendData = {};
			sendData = {
				dataval: selectprojectval,
				hid_job_id:hid_job_id,
				};
				objData = {
			      url: selectUrl,
				  type: 'post',
				  sendData: sendData
				 };
				send_ajax_request(objData, function (callback) {
				  if (callback.status == "200") {
					$(".display_project").html("");
					$(".display_project").html(callback.result);
				  }
				 });
			
	   }else{
		  $(".display_project").html("");
	   }
   
});  

   
$('body').on('change', '.select_project', function () {
   var dataval = $(this).val();
   var hid_job_id = '';
   var selectUrl = "{{route('jobs.projecturl.list')}}";
   $(".display_project").html("Loading...");
   if(dataval != ''){
        var objData = {};
		var sendData = {};
		sendData = {
			dataval: dataval,
			hid_job_id:hid_job_id,
			};
			objData = {
		      url: selectUrl,
			  type: 'post',
			  sendData: sendData
			 };
			send_ajax_request(objData, function (callback) {
			  if (callback.status == "200") {
				$(".display_project").html("");
				$(".display_project").html(callback.result);
				$(".display_project_url_related").addClass('d-none');
                return false;
			  }
			 });
		
   }else{
	  $(".display_project").html("");
	  $(".display_project_url_related").addClass('d-none');
      return false;
   }
   
    
});
$('body').on('click', 'input[type="checkbox"]', function () {
	var inputValue = $(this).attr("value"); 
	var selectUrl = "{{route('jobs.projecturldata.list')}}";
   $(".display_project_url_related_" + inputValue).html("Loading...");
   if(inputValue != ''){
        var objData = {};
		var sendData = {};
		sendData = {
			inputValue: inputValue
			};
			objData = {
		      url: selectUrl,
			  type: 'post',
			  sendData: sendData
			 };
			send_ajax_request(objData, function (callback) {
			  if (callback.status == "200") {
				$(".display_project_url_related_" + inputValue).html("");
				$(".display_project_url_related_" + inputValue).html(callback.result);
				$(".display_project_url_related_" + inputValue).toggle();
				return false;
			  }
			 });
		
   }else{
	  $(".display_project_url_related_" + inputValue).html("");
	  return false;
   }
	
	//$(".display_project_url_related_" + inputValue).toggle(); 
}); 
$('body').on('keyup', '.exact_keyword', function () {
	var dataexact = $(this).val();
	if(dataexact == ''){
		var dataexactVal = 0;
	}else{
		var dataexactVal = parseInt(dataexact);
	}
	var dataId = $(this).attr('data-id');
	
	var projectBrandPlusExact = $('#project_brand_plus_exact_'+dataId).val();
	if(projectBrandPlusExact == ''){
		var projectBrandPlusExactVal = 0;
	}else{
		var projectBrandPlusExactVal = parseInt(projectBrandPlusExact);
	}
	var projectSecondaryPlusExact = $('#project_secondary_plus_exact_'+dataId).val();
	if(projectSecondaryPlusExact == ''){
		var projectSecondaryPlusExactVal = 0;
	}else{
		var projectSecondaryPlusExactVal = parseInt(projectSecondaryPlusExact);
	}
	var projectPartialPlusExact = $('#project_partial_plus_exact_'+dataId).val();
	if(projectPartialPlusExact == ''){
		var projectPartialPlusExactVal = 0;
	}else{
		var projectPartialPlusExactVal = parseInt(projectPartialPlusExact);
	}
	var projectPartialPlusBrand = $('#project_partial_plus_brand_'+dataId).val();
	if(projectPartialPlusBrand == ''){
		var projectPartialPlusBrandVal = 0;
	}else{
		var projectPartialPlusBrandVal = parseInt(projectPartialPlusBrand);
	}
	var totalKeyword = (dataexactVal+projectBrandPlusExactVal+projectSecondaryPlusExactVal+projectPartialPlusExactVal+projectPartialPlusBrandVal);
	if(totalKeyword > 100){
		$('#error-brand-plus-exact-keyword-'+dataId).addClass('d-none');
		$('#error-secondary-plus-exact-keyword-'+dataId).addClass('d-none');
		$('#error-partial-plus-exact-keyword-'+dataId).addClass('d-none');
		$('#error-partial-plus-brand-keyword-'+dataId).addClass('d-none');
		$('#error-exact-keyword-'+dataId).removeClass('d-none');
		$('#project_exact_'+dataId).val('');
		totalKeyword = totalKeyword-dataexactVal;
		var totalPercentage = (100 - totalKeyword);
		$('#success-keyword-'+dataId).removeClass('d-none');
		$('#success-keyword-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
		return false;
	}else{
		var totalPercentage = (100 - totalKeyword);
		$('#success-keyword-'+dataId).removeClass('d-none');
		$('#success-keyword-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
		$('#error-exact-keyword-'+dataId).addClass('d-none');
		return false;
	}
	
});
$('body').on('keyup', '.brand_plus_exact', function () {
	var projectBrandPlusExact = $(this).val();
	if(projectBrandPlusExact == ''){
		var projectBrandPlusExactVal = 0;
	}else{
		var projectBrandPlusExactVal = parseInt(projectBrandPlusExact);
	}
	var dataId = $(this).attr('data-id');
	
	var dataexact = $('#project_exact_'+dataId).val();
	if(dataexact == ''){
		var dataexactVal = 0;
	}else{
		var dataexactVal = parseInt(dataexact);
	}
	var projectSecondaryPlusExact = $('#project_secondary_plus_exact_'+dataId).val();
	if(projectSecondaryPlusExact == ''){
		var projectSecondaryPlusExactVal = 0;
	}else{
		var projectSecondaryPlusExactVal = parseInt(projectSecondaryPlusExact);
	}
	var projectPartialPlusExact = $('#project_partial_plus_exact_'+dataId).val();
	if(projectPartialPlusExact == ''){
		var projectPartialPlusExactVal = 0;
	}else{
		var projectPartialPlusExactVal = parseInt(projectPartialPlusExact);
	}
	var projectPartialPlusBrand = $('#project_partial_plus_brand_'+dataId).val();
	if(projectPartialPlusBrand == ''){
		var projectPartialPlusBrandVal = 0;
	}else{
		var projectPartialPlusBrandVal = parseInt(projectPartialPlusBrand);
	}
	var totalKeyword = (dataexactVal+projectBrandPlusExactVal+projectSecondaryPlusExactVal+projectPartialPlusExactVal+projectPartialPlusBrandVal);
	var totalPercentage = (100 - totalKeyword);
		$('#success-keyword-'+dataId).removeClass('d-none');
		$('#success-keyword-'+dataId).html(totalKeyword+' added left '+totalPercentage);
		
	if(totalKeyword > 100){
		$('#error-exact-keyword-'+dataId).addClass('d-none');
		$('#error-secondary-plus-exact-keyword-'+dataId).addClass('d-none');
		$('#error-partial-plus-exact-keyword-'+dataId).addClass('d-none');
		$('#error-partial-plus-brand-keyword-'+dataId).addClass('d-none');
		$('#error-brand-plus-exact-keyword-'+dataId).removeClass('d-none');
		$('#project_brand_plus_exact_'+dataId).val('');
		totalKeyword = totalKeyword-projectBrandPlusExactVal;
		var totalPercentage = (100 - totalKeyword);
		$('#success-keyword-'+dataId).removeClass('d-none');
		$('#success-keyword-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
		return false;
	}else{
		var totalPercentage = (100 - totalKeyword);
		$('#success-keyword-'+dataId).removeClass('d-none');
		$('#success-keyword-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
		$('#error-brand-plus-exact-keyword-'+dataId).addClass('d-none');
		return false;
	}
	
});
$('body').on('keyup', '.secondary_plus_exact', function () {
	var dataId = $(this).attr('data-id');
	var dataexact = $('#project_exact_'+dataId).val();
	if(dataexact == ''){
		var dataexactVal = 0;
	}else{
		var dataexactVal = parseInt(dataexact);
	}
	var projectBrandPlusExact = $('#project_brand_plus_exact_'+dataId).val();
	if(projectBrandPlusExact == ''){
		var projectBrandPlusExactVal = 0;
	}else{
		var projectBrandPlusExactVal = parseInt(projectBrandPlusExact);
	}
	var projectSecondaryPlusExact = $(this).val();
	if(projectSecondaryPlusExact == ''){
		var projectSecondaryPlusExactVal = 0;
	}else{
		var projectSecondaryPlusExactVal = parseInt(projectSecondaryPlusExact);
	}
	var projectPartialPlusExact = $('#project_partial_plus_exact_'+dataId).val();
	if(projectPartialPlusExact == ''){
		var projectPartialPlusExactVal = 0;
	}else{
		var projectPartialPlusExactVal = parseInt(projectPartialPlusExact);
	}
	var projectPartialPlusBrand = $('#project_partial_plus_brand_'+dataId).val();
	if(projectPartialPlusBrand == ''){
		var projectPartialPlusBrandVal = 0;
	}else{
		var projectPartialPlusBrandVal = parseInt(projectPartialPlusBrand);
	}
	var totalKeyword = (dataexactVal+projectBrandPlusExactVal+projectSecondaryPlusExactVal+projectPartialPlusExactVal+projectPartialPlusBrandVal);
	if(totalKeyword > 100){
		$('#error-exact-keyword-'+dataId).addClass('d-none');
		$('#error-brand-plus-exact-keyword-'+dataId).addClass('d-none');
		$('#error-partial-plus-exact-keyword-'+dataId).addClass('d-none');
		$('#error-partial-plus-brand-keyword-'+dataId).addClass('d-none');
		$('#error-secondary-plus-exact-keyword-'+dataId).removeClass('d-none');
		$('#project_secondary_plus_exact_'+dataId).val('');
		totalKeyword = totalKeyword-projectSecondaryPlusExactVal;
		var totalPercentage = (100 - totalKeyword);
		$('#success-keyword-'+dataId).removeClass('d-none');
		$('#success-keyword-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
		return false;
	}else{
		var totalPercentage = (100 - totalKeyword);
		$('#success-keyword-'+dataId).removeClass('d-none');
		$('#success-keyword-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
		$('#error-secondary-plus-exact-keyword-'+dataId).addClass('d-none');
		return false;
	}
	
});
$('body').on('keyup', '.partial_plus_exact', function () {
	var dataId = $(this).attr('data-id');
	var dataexact = $('#project_exact_'+dataId).val();
	if(dataexact == ''){
		var dataexactVal = 0;
	}else{
		var dataexactVal = parseInt(dataexact);
	}
	var projectBrandPlusExact = $('#project_brand_plus_exact_'+dataId).val();
	if(projectBrandPlusExact == ''){
		var projectBrandPlusExactVal = 0;
	}else{
		var projectBrandPlusExactVal = parseInt(projectBrandPlusExact);
	}
	var projectSecondaryPlusExact = $('#project_secondary_plus_exact_'+dataId).val();
	if(projectSecondaryPlusExact == ''){
		var projectSecondaryPlusExactVal = 0;
	}else{
		var projectSecondaryPlusExactVal = parseInt(projectSecondaryPlusExact);
	}
	var projectPartialPlusExact = $(this).val();
	if(projectPartialPlusExact == ''){
		var projectPartialPlusExactVal = 0;
	}else{
		var projectPartialPlusExactVal = parseInt(projectPartialPlusExact);
	}
	var projectPartialPlusBrand = $('#project_partial_plus_brand_'+dataId).val();
	if(projectPartialPlusBrand == ''){
		var projectPartialPlusBrandVal = 0;
	}else{
		var projectPartialPlusBrandVal = parseInt(projectPartialPlusBrand);
	}
	var totalKeyword = (dataexactVal+projectBrandPlusExactVal+projectSecondaryPlusExactVal+projectPartialPlusExactVal+projectPartialPlusBrandVal);
	if(totalKeyword > 100){
		$('#error-exact-keyword-'+dataId).addClass('d-none');
		$('#error-brand-plus-exact-keyword-'+dataId).addClass('d-none');
		$('#error-secondary-plus-exact-keyword-'+dataId).addClass('d-none');
		$('#error-partial-plus-brand-keyword-'+dataId).addClass('d-none');
		$('#error-partial-plus-exact-keyword-'+dataId).removeClass('d-none');
		$('#project_partial_plus_exact_'+dataId).val('');
		totalKeyword = totalKeyword-projectPartialPlusExactVal;
		var totalPercentage = (100 - totalKeyword);
		$('#success-keyword-'+dataId).removeClass('d-none');
		$('#success-keyword-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
		return false;
	}else{
		var totalPercentage = (100 - totalKeyword);
		$('#success-keyword-'+dataId).removeClass('d-none');
		$('#success-keyword-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
		$('#error-partial-plus-exact-keyword-'+dataId).addClass('d-none');
		return false;
	}
	
});
$('body').on('keyup', '.partial_plus_brand', function () {
	var dataId = $(this).attr('data-id');
	var dataexact = $('#project_exact_'+dataId).val();
	if(dataexact == ''){
		var dataexactVal = 0;
	}else{
		var dataexactVal = parseInt(dataexact);
	}
	var projectBrandPlusExact = $('#project_brand_plus_exact_'+dataId).val();
	if(projectBrandPlusExact == ''){
		var projectBrandPlusExactVal = 0;
	}else{
		var projectBrandPlusExactVal = parseInt(projectBrandPlusExact);
	}
	var projectSecondaryPlusExact = $('#project_secondary_plus_exact_'+dataId).val();
	if(projectSecondaryPlusExact == ''){
		var projectSecondaryPlusExactVal = 0;
	}else{
		var projectSecondaryPlusExactVal = parseInt(projectSecondaryPlusExact);
	}
	var projectPartialPlusExact = $('#project_partial_plus_exact_'+dataId).val();
	if(projectPartialPlusExact == ''){
		var projectPartialPlusExactVal = 0;
	}else{
		var projectPartialPlusExactVal = parseInt(projectPartialPlusExact);
	}
	var projectPartialPlusBrand = $(this).val();
	if(projectPartialPlusBrand == ''){
		var projectPartialPlusBrandVal = 0;
	}else{
		var projectPartialPlusBrandVal = parseInt(projectPartialPlusBrand);
	}
	var totalKeyword = (dataexactVal+projectBrandPlusExactVal+projectSecondaryPlusExactVal+projectPartialPlusExactVal+projectPartialPlusBrandVal);
	if(totalKeyword > 100){
		$('#error-exact-keyword-'+dataId).addClass('d-none');
		$('#error-brand-plus-exact-keyword-'+dataId).addClass('d-none');
		$('#error-secondary-plus-exact-keyword-'+dataId).addClass('d-none');
		$('#error-partial-plus-exact-keyword-'+dataId).addClass('d-none');
		$('#error-partial-plus-brand-keyword-'+dataId).removeClass('d-none');
		$('#project_partial_plus_brand_'+dataId).val('');
		totalKeyword = totalKeyword-projectPartialPlusBrandVal;
		var totalPercentage = (100 - totalKeyword);
		$('#success-keyword-'+dataId).removeClass('d-none');
		$('#success-keyword-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
		return false;
	}else{
		var totalPercentage = (100 - totalKeyword);
		$('#success-keyword-'+dataId).removeClass('d-none');
		$('#success-keyword-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
		$('#error-partial-plus-brand-keyword-'+dataId).addClass('d-none');
		return false;
	}
	
});
// $('body').on('change', '.project_url_weight', function () {
	// var hid_weight_val = $('#hid_weight_percetage_val').val();
	// var dataId = $(this).attr('data-id');
	// var dataexact = $(this).val();
	// if(dataexact == ''){
		// var dataexactVal = 0;
	// }else{
		// var dataexactVal = parseInt(dataexact);
	// }
	// if(hid_weight_val == ''){
		// var hidWeightVal = 0;
	// }else{
		// var hidWeightVal = parseInt(hid_weight_val);
	// }
	// var totalVal = 0;
	// totalVal = (hidWeightVal+dataexactVal);
	// $('#hid_weight_percetage_val').val(totalVal);
	// alert(totalVal);
	
	
	
// });


// $('body').on('click', '.check_project_url', function () {
	// var dataval = $(this).val();
	// alert(dataval);
	// var length_of_job = $('.select_length_of_job').val();
	// var id = [];
	// $('.check_project_url:checked').each(function(){
		// id.push($(this).val());
	// });
	// if(id.length > 0){
		// $(".display_project_url_related_"+dataval).removeClass('d-none');
		// if((length_of_job != '') && (length_of_job == 'random')){
			// $(".display_random").removeClass('d-none');
				// return false;
			// }else{
				// $(".display_random").addClass('d-none');
				// return false;
			// }
		// return false;
	// }else{
		// $(".display_project_url_related_"+dataval).addClass('d-none');
		// return false;
	// }
// });
$('body').on('change', '.select_length_of_job', function () {
	var dataval = $(this).val();
	if((dataval != '') && (dataval == 'random')){
		$(".display_random").removeClass('d-none');
		return false;
	}else{
		$(".display_random").addClass('d-none');
		return false;
	}
});
$('body').on('click', '.add_more', function () {
   var dataval = $(this).attr("data-type");
   var dataId = $(this).attr("data-id");
   dataval++;
   //alert(dataval);
   if(dataval < 11){
	   varHtml = "";
	   varHtml = '<div class="form-group row d-flex align-items-center mb-5"><label class="col-lg-2 form-control-label">Country</label><div class="col-lg-4"><input type="text" name="country_code['+dataId+'][]" placeholder="Enter Country Code" class="form-control" data-parsley-error-message="Please enter country code"></div><div class="col-lg-4"><input type="text" name="country_weight['+dataId+'][]" id="country_weight_'+dataId+'_'+dataval+'" data-type="'+dataval+'" placeholder="Enter Country Weight Percentage between 0-100" class="form-control country_weight_val_'+dataId+' country_weight" data-id="'+dataId+'" data-parsley-type="number" data-parsley-min="1" data-parsley-max="100" data-parsley-error-message="Please enter number between 0-100"></div><div class="col-lg-2"><button class="btn btn-primary add_more" data-type="'+dataval+'" data-id="'+dataId+'" id="add_more_type_'+dataId+'" type="button">Add More</button></div></div>';
	   $('.display_country_'+dataId).append(varHtml);
		$(this).removeClass('btn-primary');
		$(this).addClass('btn-danger');
		$(this).removeClass('add_more');
		$(this).addClass('remove_add');
		$(this).text('Remove');
		$(this).attr('id','remove_add_type_'+dataId);
   }else{
	    alert('Have exceeded their limits');
	   return false;
   }
    
});

$("body").on("click", ".remove_add", function () {
	var dataId = $(this).attr("data-id");
	$(this).parent().parent().remove();
	var dataval = $('#add_more_type_'+dataId).attr("data-type");
	dataval--;
	$('#add_more_type_'+dataId).attr("data-type",dataval);
});
$('body').on('keyup', '.country_weight', function () {
	var weightVal = $(this).val();
	var dataId = $(this).attr('data-id');
	var dataVal = $(this).attr('data-type');
	//if(weightVal != 0){
		var id=[];
		var total = 0;
		$('.country_weight_val_'+dataId).each(function(){
			id.push($(this).val());
		});
		for (var i = 0; i < id.length; i++) {
				total += id[i] << 0;
			}
		if(total > 100){
			$('#error-country-'+dataId).removeClass('d-none');
			$('#country_weight_'+dataId+'_'+dataVal).val('');
			total = total-weightVal;
			var totalPercentage = (100 - total);
			 $('#success-country-'+dataId).removeClass('d-none');
			 $('#success-country-'+dataId).html('Remaining  '+totalPercentage+' out of '+total);
			return false;
		}else{
			 var totalPercentage = (100 - total);
			  $('#success-country-'+dataId).removeClass('d-none');
			  $('#success-country-'+dataId).html('Remaining  '+totalPercentage+' out of '+total);
			$('#error-country-'+dataId).addClass('d-none');
			return false;
		}
	//}else{
	//	$('#country_weight_'+dataId+'_'+dataVal).val('');
	//	return false;
	//}
		
});
$("body").on("keyup", ".yes_percentage", function () {
	var dataId = $(this).attr("data-id");
	var dataval = $('#project_yes_percentage_'+dataId).val();
	var totalNoVal = (100-dataval);
	$('#project_no_percentage_'+dataId).val(totalNoVal);
	
});

</script>
@endsection
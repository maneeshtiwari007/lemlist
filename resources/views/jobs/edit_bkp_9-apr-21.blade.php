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
						<a class="text-muted">Edit Job</a>
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
		<div class="row">
			<div class="col-md-12">
				<!--begin::Card-->
				<div class="card card-custom gutter-b example example-compact">
					<div class="card-header">
						<h3 class="card-title">Edit Job</h3>
						<div class="card-toolbar">
							<a href="{{ route('jobs.index') }}" class="btn btn-light-primary font-weight-bolder mr-2">
							<i class="ki ki-long-arrow-back icon-xs"></i>Back</a>
							
						</div>
						
					</div>
					<!--begin::Form-->
					  <form action="{{ route('jobs.edit.post',['id'=>$editJobs->id]) }}" class="form-horizontal" enctype="multipart/form-data" method="post" id="job-form">
						@csrf
						<div class="card-body">
						<div class="row">
						  <div class="col-md-6">
							<div class="form-group">
							 <label>Job Title
							  <span class="text-danger">*</span></label>
							  <input type="hidden" name="hid_job_id" id="hid_job_id" value="{{ $editJobs->id }}">
							   <input required type="text" name="job_title" placeholder="Enter Job Title " class="form-control" data-parsley-error-message="Please enter job title" value="{{ $editJobs->job_title }}">
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
									      <option value="{{ $pro['id'] }}" {{ (!empty($editJobs->project_id) && ($editJobs->project_id == $pro['id'])) ? 'selected':'' }}>{{ $pro['name'] }}</option>
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
							   <input required type="text" name="no_of_searches" placeholder="Choose number of searches between 0-1000" class="form-control" data-parsley-type="number" data-parsley-min="1" data-parsley-max="1000" data-parsley-error-message="Please enter number between 0-1000" value="{{ $editJobs->no_of_searches }}">
							</div>
						  </div>
						
					   </div>
					  <div class="row">
						  <div class="col-md-6">
							<div class="form-group">
							 <label class="form-control-label">Capitalize First Letter Percentage<span class="text-danger">*</span></label>
	                          <input required type="text" name="capitalize_first_letter_percentage" placeholder="Enter Capitalize First Letter Percentage between 0-100" class="form-control" data-parsley-type="number" data-parsley-min="1" data-parsley-max="100" data-parsley-error-message="Please enter number between 0-100" value="{{ !empty($editJobs->project_url_capitalize_percentage)? $editJobs->project_url_capitalize_percentage : ''  }}">
							</div>
						  </div>
						   <div class="col-md-6">
							<div class="form-group">
							 <label class="form-control-label">Yes Percentage<span class="text-danger">*</span></label>
	                          <input required type="text" name="yes_percentage"   id="project_yes_percentage" placeholder="Enter Yes Percentage between 0-100" class="form-control yes_percentage" data-parsley-type="number" data-parsley-min="1" data-parsley-max="100" data-parsley-error-message="Please enter number between 0-100" value="{{ !empty($editJobs->project_url_yes_percentage)? $editJobs->project_url_yes_percentage : ''  }}">
							</div>
						  </div>
						
					   </div>
					    <div class="row">
						  <div class="col-md-6">
							<div class="form-group">
							 <label class="form-control-label">Length Of Job<span class="text-danger">*</span></label>
	                           <div class="select">
										<select name="select_length_of_job" class="custom-select form-control select_length_of_job" data-parsley-error-message="Please select Length Of Job" required>
											<option value="">Select Length Of Job</option>
											  <option value="random" {{ (!empty($editJobs->project_url_length_of_job) && ($editJobs->project_url_length_of_job == 'random')) ? 'selected' : ''}}>Random</option>
											  <option value="specific" {{ (!empty($editJobs->project_url_length_of_job) && ($editJobs->project_url_length_of_job == 'specific')) ? 'selected' : ''}}>Specific</option>
											</select>
								 </div>
							</div>
						  </div>
						   <div class="col-md-6 display_random {{ (!empty($editJobs->project_url_length_of_job == 'random') && ($editJobs->project_url_length_of_job == 'random')) ? '' : 'd-none' }}">
								 <label class="form-control-label">Random Job Hours</label>
								<div class="select">
										<select name="random_job_value" class="custom-select form-control" data-parsley-error-message="Please select a random job">
											  <option value="6" {{ (!empty($editJobs->project_url_random_job) && ($editJobs->project_url_random_job == 6)) ? 'selected' : ''}}>6 Hours</option>
											  <option value="12" {{ (!empty($editJobs->project_url_random_job) && ($editJobs->project_url_random_job == 12)) ? 'selected' : ''}}>12 Hours</option>
											  <option value="24" {{ (!empty($editJobs->project_url_random_job) && ($editJobs->project_url_random_job == 24)) ? 'selected' : ''}}>24 Hours</option>
											  <option value="48" {{ (!empty($editJobs->project_url_random_job) && ($editJobs->project_url_random_job == 48)) ? 'selected' : ''}}>2 Days</option>
											  <option value="72" {{ (!empty($editJobs->project_url_random_job) && ($editJobs->project_url_random_job == 72)) ? 'selected' : ''}}>3 Days</option>
											  <option value="120" {{ (!empty($editJobs->project_url_random_job) && ($editJobs->project_url_random_job == 120)) ? 'selected' : ''}}>5 Days</option>
											</select>
								 </div>
							</div>
						
					   </div>
					    <div class="row">
						  <div class="col-md-6">
							<div class="form-group">
							 <label class="form-control-label">Minimum Range<span class="text-danger">*</span></label>
	                          <input required type="text" name="minimum_range" placeholder="Enter Minimum Range between 0-150 Second" class="form-control" data-parsley-type="number" data-parsley-min="1" data-parsley-max="150" data-parsley-error-message="Please enter number between 0-150 Second" value="{{ !empty($editJobs->project_url_minimum_range)? $editJobs->project_url_minimum_range : ''  }}">
							</div>
						  </div>
						   <div class="col-md-6">
								<label class="form-control-label">Maximum Range<span class="text-danger">*</span></label>
	                             <input required type="text" name="maximum_range" placeholder="Enter Maximum Range between 0-150 Second" class="form-control" data-parsley-type="number" data-parsley-min="1" data-parsley-max="150" data-parsley-error-message="Please enter number between 0-150 Second" value="{{ !empty($editJobs->project_url_maximum_range)? $editJobs->project_url_maximum_range : ''  }}">
							</div>
						
					   </div><hr>
					   <div class="row">
					    <div class="col-md-12">
					        <div class="display-country">
							<div class="section-title mt-5 mb-5">
									<h4>Country Percentage(Total numbers must add up to 100%)</h4>
									<p id="success-country" class="text-danger pt-3 d-none" style="font-size:16px;"></p>
									<p id="error-country" class="text-danger display- d-none" style="font-size:16px;">Total numbers must add up to 100% only</p>
								</div>
							    @if($editJobs->countryPercentage->count()!=0)
									  @php $i=1; @endphp
									   @foreach($editJobs->countryPercentage as $countryPercentageData)
										   <div class="form-group row d-flex align-items-center mb-5">
												<label class="col-lg-2 form-control-label">Country</label>
												<div class="col-lg-4">
													<input type="text" name="country_code[]" placeholder="Enter Country Code" class="form-control" data-parsley-error-message="Please enter country code" value="{{ $countryPercentageData->country_code }}">
												</div>
												<div class="col-lg-4">
													<input type="text" name="country_weight[]" id="country_weight_{{ $i }}"  data-type="{{ $i }}" placeholder="Enter Weight Percentage between 0-100 " class="form-control country_weight" data-parsley-type="number" data-parsley-min="1" data-parsley-max="100" data-parsley-error-message="Please enter number between 0-100" value="{{ $countryPercentageData->country_weight }}">
												</div>
												<div class="col-lg-2">
												   <button class="btn btn-danger remove_add" data-type="" data-id ="" id="remove_add_type" type="button">Remove</button>
												</div>
												
											</div>
											 @php $i=$i+1; @endphp
									@endforeach
									@endif
								@if($editJobs->countryPercentage->count() < 10)
								<div class="form-group row d-flex align-items-center mb-5">
									<label class="col-lg-2 form-control-label">Country</label>
									<div class="col-lg-4">
										<input type="text" name="country_code[]" placeholder="Enter Country Code" class="form-control" data-parsley-error-message="Please enter country code">
									</div>
									<div class="col-lg-4">
										<input type="text" name="country_weight[]" id="country_weight_{{ !empty($editJobs->countryPercentage) ? $editJobs->countryPercentage->count()+1 : 1}}"  data-type="{{ !empty($editJobs->countryPercentage) ? $editJobs->countryPercentage->count()+1 : 1}}" placeholder="Enter Weight Percentage between 0-100 " class="form-control country_weight_val country_weight" data-id="1" data-parsley-type="number" data-parsley-min="1" data-parsley-max="100" data-parsley-error-message="Please enter number between 0-100">
									</div>
									<div class="col-lg-2">
									   <button class="btn btn-primary add_more" data-type="{{ !empty($editJobs->countryPercentage) ? $editJobs->countryPercentage->count()+1 : 1}}" data-id ="1" id="add_more_type" type="button">Add More</button>
									</div>
									
								</div>
								@endif
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
<!-- End Remove Modal -->
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function () {
	$('#job-form').parsley();
	 var selectprojectval = $('.select_project').val();
	 var hid_job_id = $('#hid_job_id').val();
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
					    var id = [];
						$('.check_project_url:checked').each(function(){
							id.push($(this).val());
						});
						console.log(id);
					    if(id.length > 0){
						$(".display_project_url_related").removeClass('d-none');
						return false;
						}else{
							$(".display_project_url_related").addClass('d-none');
							return false;
						}
				  }
				 });
			
	   }else{
		  $(".display_project").html("");
	   }
	  
});  

   
$('body').on('change', '.select_project', function () {
   var dataval = $(this).val();
   var hid_job_id = $('#hid_job_id').val();
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
				var length_of_job = $('.select_length_of_job').val();
				var id = [];
						$('.check_project_url:checked').each(function(){
							id.push($(this).val());
						});
					    if(id.length > 0){
						$(".display_project_url_related").removeClass('d-none');
						if((length_of_job != '') && (length_of_job == 'random')){
						$(".display_random").removeClass('d-none');
							return false;
						}else{
							$(".display_random").addClass('d-none');
							return false;
						}
						return false;
						}else{
							$(".display_project_url_related").addClass('d-none');
							return false;
						}
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
	var dataId = $(this).attr('data-id');
	var dataexact = $(this).val();
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
		$('#success-keyword-edit-'+dataId).removeClass('d-none');
		$('#success-keyword-edit-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
		return false;
	}else{
		var totalPercentage = (100 - totalKeyword);
		$('#success-keyword-'+dataId).removeClass('d-none');
		$('#success-keyword-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
		$('#success-keyword-edit-'+dataId).removeClass('d-none');
		$('#success-keyword-edit-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
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
		$('#success-keyword-edit-'+dataId).removeClass('d-none');
		$('#success-keyword-edit-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
	}else{
		var totalPercentage = (100 - totalKeyword);
		$('#success-keyword-'+dataId).removeClass('d-none');
		$('#success-keyword-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
		$('#success-keyword-edit-'+dataId).removeClass('d-none');
		$('#success-keyword-edit-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
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
		$('#success-keyword-edit-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
		$('#error-partial-plus-brand-keyword-'+dataId).addClass('d-none');
		return false;
	}else{
		var totalPercentage = (100 - totalKeyword);
		$('#success-keyword-'+dataId).removeClass('d-none');
		$('#success-keyword-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
		$('#success-keyword-edit-'+dataId).removeClass('d-none');
		$('#success-keyword-edit-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
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
		$('#success-keyword-edit-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
		$('#error-partial-plus-brand-keyword-'+dataId).addClass('d-none');
		return false;
	}else{
		var totalPercentage = (100 - totalKeyword);
		$('#success-keyword-'+dataId).removeClass('d-none');
		$('#success-keyword-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
		$('#success-keyword-edit-'+dataId).removeClass('d-none');
		$('#success-keyword-edit-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
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
		$('#success-keyword-edit-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
		$('#error-partial-plus-brand-keyword-'+dataId).addClass('d-none');
		return false;
	}else{
		var totalPercentage = (100 - totalKeyword);
		$('#success-keyword-'+dataId).removeClass('d-none');
		$('#success-keyword-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
		$('#success-keyword-edit-'+dataId).removeClass('d-none');
		$('#success-keyword-edit-'+dataId).html('Remaining  '+totalPercentage+' out of '+totalKeyword);
		$('#error-partial-plus-brand-keyword-'+dataId).addClass('d-none');
		return false;
	}
	
});
$('body').on('click', '.add_more', function () {
   var dataval = $(this).attr("data-type");
   var dataId = $(this).attr("data-id");
   dataval++;
  if(dataval < 11){
	   varHtml = "";
	   varHtml = '<div class="form-group row d-flex align-items-center mb-5"><label class="col-lg-2 form-control-label">Country</label><div class="col-lg-4"><input type="text" name="country_code[]" placeholder="Enter Country Code" class="form-control" data-parsley-error-message="Please enter country code"></div><div class="col-lg-4"><input type="text" name="country_weight[]" id="country_weight_'+dataval+'" data-type="'+dataval+'" placeholder="Enter Country Weight Percentage between 0-100" class="form-control country_weight" data-parsley-type="number" data-parsley-min="1" data-parsley-max="100" data-parsley-error-message="Please enter number between 0-100"></div><div class="col-lg-2"><button class="btn btn-primary add_more" data-type="'+dataval+'" id="add_more_type" type="button">Add More</button></div></div>';
	   $('.display-country').append(varHtml);
		$(this).removeClass('btn-primary');
		$(this).addClass('btn-danger');
		$(this).removeClass('add_more');
		$(this).addClass('remove_add');
		$(this).text('Remove');
		//$(this).attr('id','remove_add_type');
   }else{
	    alert('Have exceeded their limits');
	   return false;
   }
    
});

$("body").on("click", ".remove_add", function () {
	$(this).parent().parent().remove();
	var dataval = $('.add_more').attr("data-type");
	dataval--;
	$('.add_more').attr("data-type",dataval);
});
$('body').on('keyup', '.country_weight', function () {
	var weightVal = $(this).val();
	var dataVal = $(this).attr('data-type');
	//if(weightVal != 0){
		var id=[];
		var total = 0;
		$('.country_weight').each(function(){
			id.push($(this).val());
		});
		for (var i = 0; i < id.length; i++) {
				total += id[i] << 0;
			}
		if(total > 100){
			$('#error-country').removeClass('d-none');
			$('#country_weight_'+dataVal).val('');
			total = total-weightVal;
			var totalPercentage = (100 - total);
			 $('#success-country').removeClass('d-none');
			 $('#success-country').html('Remaining  '+totalPercentage+' out of '+total);
			return false;
		}else{
			var totalPercentage = (100 - total);
			  $('#success-country').removeClass('d-none');
			  $('#success-country').html('Remaining  '+totalPercentage+' out of '+total);
			$('#error-country').addClass('d-none');
			return false;
		}
	//}else{
		//alert('aaaa');
		//var totalPercentage = (100 - total);
		///alert(total);
		//$('#country_weight_'+dataVal).val('');
		//return false;
	//}
		
});
$("body").on("keyup", ".yes_percentage", function () {
	var dataId = $(this).attr("data-id");
	var dataval = $('#project_yes_percentage_'+dataId).val();
	var totalNoVal = (100-dataval);
	$('#project_no_percentage_'+dataId).val(totalNoVal);
	
});
// $('body').on('change', '.check_project_url', function () {
	// var length_of_job = $('.select_length_of_job').val();
	// var id = [];
	// $('.check_project_url:checked').each(function(){
		// id.push($(this).val());
	// });
	// if(id.length > 0){
		// $(".display_project_url_related").removeClass('d-none');
		// if((length_of_job != '') && (length_of_job == 'random')){
			// $(".display_random").removeClass('d-none');
				// return false;
			// }else{
				// $(".display_random").addClass('d-none');
				// return false;
			// }
		// return false;
	// }else{
		// $(".display_project_url_related").addClass('d-none');
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
$("body").on("click", ".remove_add_partial", function () {
    $(this).parent().parent().remove();
	var dataval = $('.add_more_partial').attr("data-type");
    dataval--;
	$('.add_more_partial').attr("data-type",dataval);
});
</script>
@endsection
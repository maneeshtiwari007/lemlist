<div class="row">

  <div class="col-md-12">
  <div class="section-title mt-5 mb-5">
		<h4>Project Url's</h4>
	</div>
	@if(!empty($getProjectUrl['data'][0]))
	@php $i=1; @endphp
	@foreach($getProjectUrl['data'] as $projectUrl)
		<div class="form-group">
			  <div class="checkbox-inline">
				<label class="checkbox checkbox-lg" for="check-{{ $i }}">
				<input type="checkbox" name="project_url[]" class="check_project_url"  id="check-{{ $i }}" value="{{ $projectUrl['id'] }}" {{ (!empty($projectUrlId) && in_array($projectUrl['id'],$projectUrlId))?'checked':'' }}><span></span>{{ $projectUrl['url_name'] }}</label>
			 </div>
			  <div class="box p-3 bg-light display-checkbox-data display_project_url_related_{{ $projectUrl['id'] }}" style="{{ (!empty($projectUrlId) && in_array($projectUrl['id'],$projectUrlId))?'display:block':'' }}">
				 @if($projectUrl->jobDetailsByUrl->count() !=0)
					 @foreach($projectUrl->jobDetailsByUrl as $jobDetails)
				      @if(!empty($jobId) && ($jobId == $jobDetails->job_id))
						  <div class="form-group row d-flex align-items-center mb-5">
								<label class="col-lg-3 form-control-label"> Url Weight<span class="text-danger">*</span></label>
								<div class="col-lg-6">
									<input required type="text" name="project_url_weight[]" placeholder="Enter Project Url Weight percentage between 0-100 " class="form-control" data-parsley-type="number" data-parsley-min="0" data-parsley-max="100" data-parsley-error-message="Please enter number between 0-100" value="{{ $jobDetails->project_url_weight }}">
								 </div>
							</div>
							<hr>
							<div class="section-title mt-5 mb-5">
							<h4>Keyword Percentage(Total numbers must add up to 100%)</h4>
							<p id="success-keyword-edit-{{ $projectUrl['id'] }}" class="text-danger pt-3 d-none" style="font-size:16px;"></p>
							</div>
							<div class="form-group row mb-5">
							<div class="col-md-6">
								 <label class="form-control-label">Exact Keyword<span class="text-danger">*</span></label>
								<input required type="text" name="project_exact[]" id="project_exact_{{ $projectUrl['id'] }}" placeholder="Enter Project Exact Keyword Percentage between 0-100" class="form-control exact_keyword" data-id="{{ $projectUrl['id'] }}" data-parsley-type="number" data-parsley-min=0" data-parsley-max="100" data-parsley-error-message="Please enter number between 0-100" value="{{ $jobDetails->project_url_exact }}">
								<p id="error-exact-keyword-{{ $projectUrl['id'] }}" class="text-danger d-none" >Total keyword numbers must add up to 100% only</p>
							</div>
							<div class="col-md-6">
							  <label class="form-control-label">Brand + Exact Keyword<span class="text-danger">*</span></label>
								<input required type="text" name="project_brand_plus_exact[]" id="project_brand_plus_exact_{{ $projectUrl['id'] }}" placeholder="Enter Project Brand + Exact Keyword Percentage between 0-100" class="form-control brand_plus_exact" data-id="{{ $projectUrl['id'] }}" data-parsley-type="number" data-parsley-min="0" data-parsley-max="100" data-parsley-error-message="Please enter number between 0-100" value="{{ $jobDetails->project_url_brand_plus_exact }}">
								<p id="error-brand-plus-exact-keyword-{{ $projectUrl['id'] }}" class="text-danger d-none" >Total keyword numbers must add up to 100% only</p>
							</div>
							
							</div>
							<div class="form-group row mb-5">
							<div class="col-md-6">
								 <label class="form-control-label">Secondary + Exact Keyword<span class="text-danger">*</span></label>
								<input required type="text" name="project_secondary_plus_exact[]" id="project_secondary_plus_exact_{{ $projectUrl['id'] }}" placeholder="Enter Project Secondary + Exact Percentage between 0-100 " class="form-control secondary_plus_exact" data-id="{{ $projectUrl['id'] }}" data-parsley-type="number" data-parsley-min="0" data-parsley-max="100" data-parsley-error-message="Please enter number between 0-100" value="{{ $jobDetails->project_url_secondary_plus_exact }}">
								<p id="error-secondary-plus-exact-keyword-{{ $projectUrl['id'] }}" class="text-danger d-none" >Total keyword numbers must add up to 100% only</p>
							</div>
							<div class="col-md-6">
							  <label class="form-control-label">Partial + Secondary Keyword<span class="text-danger">*</span></label>
								<input required type="text" name="project_partial_plus_exact[]"  id="project_partial_plus_exact_{{ $projectUrl['id'] }}" placeholder="Enter Project Partial + Secondary Percentage between 0-100 " class="form-control partial_plus_exact" data-id="{{ $projectUrl['id'] }}"  data-parsley-type="number" data-parsley-min="0" data-parsley-max="100" data-parsley-error-message="Please enter number between 0-100" value="{{ $jobDetails->project_url_partial_plus_exact }}">
								<p id="error-partial-plus-exact-keyword-{{ $projectUrl['id'] }}" class="text-danger d-none" >Total keyword numbers must add up to 100% only</p>
							</div>
							
							</div>
							
							<div class="form-group row mb-5">
							<div class="col-md-6">
								 <label class="form-control-label">Partial + Brand  Keyword<span class="text-danger">*</span></label>
								<input required type="text" name="project_partial_plus_brand[]" id="project_partial_plus_brand_{{ $projectUrl['id'] }}" placeholder="Enter Project Partial + Brand Percentage between 0-100 " class="form-control partial_plus_brand" data-id="{{ $projectUrl['id'] }}" data-parsley-type="number" data-parsley-min="0" data-parsley-max="100" data-parsley-error-message="Please enter number between 0-100" value="{{ $jobDetails->project_url_partial_plus_brand }}">
								<p id="error-partial-plus-brand-keyword-{{ $projectUrl['id'] }}" class="text-danger d-none" >Total keyword numbers must add up to 100% only</p>
							</div>
							
								
							</div>

							
							@endif
					@endforeach
			     @endif
				 </div>
		</div>
	  @php $i=$i+1; @endphp
    @endforeach
@endif
 </div>

</div>
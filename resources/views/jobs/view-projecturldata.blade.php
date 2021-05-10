 <div class="form-group row d-flex align-items-center mb-5">
	<label class="col-lg-3 form-control-label"> Url Weight<span class="text-danger">*</span></label>
	<div class="col-lg-6">
		<input required type="text" name="project_url_weight[]" id="project_url_weight_{{ $inputValue }}" data-id="{{ $inputValue }}" placeholder="Enter Project Url Weight percentage between 0-100 " class="form-control project_url_weight" data-parsley-type="number" data-parsley-min="0" data-parsley-max="100" data-parsley-error-message="Please enter number between 0-100">
	 </div>
</div>
<hr>
<div class="section-title mt-5 mb-5">
<h4>Keyword Percentage(Total numbers must add up to 100%)</h4>
<p id="success-keyword-{{ $inputValue }}" class="text-danger pt-3 d-none" style="font-size:16px;"></p>
</div>
<div class="form-group row mb-5">
<div class="col-md-6">
	 <label class="form-control-label">Exact Keyword<span class="text-danger">*</span></label>
	<input required type="text" name="project_exact[]" id="project_exact_{{ $inputValue }}" placeholder="Enter Project Exact Keyword Percentage between 0-100" class="form-control exact_keyword" data-id="{{ $inputValue }}" data-parsley-type="number" data-parsley-min="0" data-parsley-max="100" data-parsley-error-message="Please enter number between 0-100">
	<p id="error-exact-keyword-{{ $inputValue }}" class="text-danger d-none" >Total keyword numbers must add up to 100% only</p>
</div>
<div class="col-md-6">
  <label class="form-control-label">Brand + Exact Keyword<span class="text-danger">*</span></label>
	<input required type="text" name="project_brand_plus_exact[]" id="project_brand_plus_exact_{{ $inputValue }}" placeholder="Enter Project Brand + Exact Keyword Percentage between 0-100" class="form-control brand_plus_exact" data-id="{{ $inputValue }}" data-parsley-type="number" data-parsley-min="0" data-parsley-max="100" data-parsley-error-message="Please enter number between 0-100">
	<p id="error-brand-plus-exact-keyword-{{ $inputValue }}" class="text-danger d-none" >Total keyword numbers must add up to 100% only</p>
</div>
</div>
<div class="form-group row mb-5">
<div class="col-md-6">
	 <label class="form-control-label">Secondary + Exact Keyword<span class="text-danger">*</span></label>
	<input required type="text" name="project_secondary_plus_exact[]" id="project_secondary_plus_exact_{{ $inputValue }}" placeholder="Enter Project Secondary + Exact Percentage between 0-100 " class="form-control secondary_plus_exact" data-id="{{ $inputValue }}" data-parsley-type="number" data-parsley-min="0" data-parsley-max="100" data-parsley-error-message="Please enter number between 0-100">
	<p id="error-secondary-plus-exact-keyword-{{ $inputValue }}" class="text-danger d-none" >Total keyword numbers must add up to 100% only</p>
</div>
<div class="col-md-6">
  <label class="form-control-label">Partial + Secondary Keyword<span class="text-danger">*</span></label>
	<input required type="text" name="project_partial_plus_exact[]"  id="project_partial_plus_exact_{{ $inputValue }}" placeholder="Enter Project Partial + Secondary Percentage between 0-100 " class="form-control partial_plus_exact" data-id="{{ $inputValue }}"  data-parsley-type="number" data-parsley-min="0" data-parsley-max="100" data-parsley-error-message="Please enter number between 0-100">
	<p id="error-partial-plus-exact-keyword-{{ $inputValue }}" class="text-danger d-none" >Total keyword numbers must add up to 100% only</p>
</div>
</div>
<div class="form-group row mb-5">
<div class="col-md-6">
	 <label class="form-control-label">Partial + Brand  Keyword<span class="text-danger">*</span></label>
	<input required type="text" name="project_partial_plus_brand[]" id="project_partial_plus_brand_{{ $inputValue }}" placeholder="Enter Project Partial + Brand Percentage between 0-100 " class="form-control partial_plus_brand" data-id="{{ $inputValue }}" data-parsley-type="number" data-parsley-min="0" data-parsley-max="100" data-parsley-error-message="Please enter number between 0-100">
	<p id="error-partial-plus-brand-keyword-{{ $inputValue }}" class="text-danger d-none" >Total keyword numbers must add up to 100% only</p>
</div>

</div>




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
						<a href="{{ route('projects.index') }}" class="text-muted">Projects</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a class="text-muted">Edit project</a>
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
						<h3 class="card-title">Edit Project</h3>
						<div class="card-toolbar">
							<a href="{{ route('projects.index') }}" class="btn btn-light-primary font-weight-bolder mr-2">
							<i class="ki ki-long-arrow-back icon-xs"></i>Back</a>
							
						</div>
						
					</div>
					<!--begin::Form-->
					  <form action="{{ route('projects.edit.post',['id'=>$editProjects->id]) }}" class="form-horizontal" enctype="multipart/form-data" method="post" id="project-form">
						@csrf
						<div class="card-body">
						<div class="row">
						  <div class="col-md-6">
							<div class="form-group">
							 <label>Project Name
							  <span class="text-danger">*</span></label>
							   <input required type="text" name="project_name" placeholder="Project Name" class="form-control" data-parsley-error-message="Please enter project name" value="{{ $editProjects->name }}">
							</div>
						  </div>
						 <div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputPassword1">Description
								<span class="text-danger">*</span></label>
								<textarea class="form-control" name="description" placeholder="Type your Descrption here ..." required data-parsley-error-message="Please enter description">{{ $editProjects->description }}</textarea>
							</div>
						 </div>
					   </div>
					   <hr>
					   <div class="row display_url">
					            <div class="section-title mt-5 mb-5 col-12">
									<h4>Url's</h4>
								</div>
							@if(!empty($editProjects->urls))
								@php $i=0; @endphp
							    @php $j=1; @endphp
							 @foreach($editProjects->urls as $urlData)
							  <div class="col-md-12 select_url">
							    <div class="p-4 bg-secondary mb-2">
								<div class="form-group">
									<label> Url</label>
									<div class="input-group">
										<input type="text" name="old_url_name[]" placeholder="Enter Url" class="form-control" value="{{ $urlData->url_name }}">
										<input type="hidden" name="old_url_id[]" value="{{ $urlData->id }}">
									 </div>
								</div>
								<div class="row">
									<div class="col-md-6">
									  <div class="display_brand_keyword_{{ $j }}">
										<div class="section-title mt-5 mb-5">
											<h4>Brand Keyword's</h4>
										</div>
										 @if(!empty($urlData->brandKeywords->count() !=0))
											@foreach($urlData->brandKeywords as $brandKeywords)
											 <div class="form-group child_keyword">
												<label>Brand Keyword</label>
												<div class="input-group">
													<input type="text" name="old_brand_keyword[{{ $urlData->id }}][]" placeholder="Brand Keyword" class="form-control" value="{{ $brandKeywords->brand_keyword }}">
													<div class="input-group-append">
														  <button class="btn btn-danger remove_add_brand" id="remove_add_brand_{{ $j }}" data-type="1" data-parent-type="{{ $j }}" data-id="{{ $i }}" type="button">Remove</button>
													</div>
												</div>
											  </div>
											  
										  @endforeach
										 @endif
										 <div class="form-group child_keyword">
											<label>Brand Keyword</label>
											<div class="input-group">
												<input type="text" name="old_brand_keyword[{{ $urlData->id }}][]" placeholder="Brand Keyword" class="form-control" >
												<div class="input-group-append">
													  <button class="btn btn-info add_more_brand" id="add_more_brand_{{ $j }}" data-type="{{ !empty($urlData->brandKeywords) ? $urlData->brandKeywords->count()+1 : 1}}" data-parent-type="{{ $j }}" data-id="{{ $i }}" type="button">Add More</button>
												</div>
											</div>
										  </div>
									  </div>
									 </div>
									 <div class="col-md-6">
										<div class="display_secondary_keyword_{{ $j }}">
										<div class="section-title mt-5 mb-5">
											<h4>Secondary Keyword's</h4>
										</div>
										 @if(!empty($urlData->secondaryKeywords->count() !=0))
											 @foreach($urlData->secondaryKeywords as $secondaryKeywords)
										     <div class="form-group child_keyword">
												<label>Secondary Keywords</label>
												<div class="input-group">
													<input type="text" name="old_secondary_keyword[{{ $i }}][]" placeholder="Secondary Keyword" class="form-control" value="{{ $secondaryKeywords->secondary_keyword }}">
													<div class="input-group-append">
														<button class="btn btn-danger remove_add_secondary" id="remove_add_secondary_{{ $j }}" data-type="1" data-parent-type="{{ $j }}" data-id="{{ $i }}" type="button">Remove</button>
													</div>
												</div>
											</div>
											@endforeach
										 @endif
										<div class="form-group child_keyword">
											<label>Secondary Keywords</label>
											<div class="input-group">
												<input type="text" name="old_secondary_keyword[{{ $i }}][]" placeholder="Secondary Keyword" class="form-control">
												<div class="input-group-append">
													<button class="btn btn-info add_more_secondary" id="add_more_secondary_{{ $j }}" data-type="{{ !empty($urlData->secondaryKeywords) ? $urlData->secondaryKeywords->count()+1 : 1}}" data-parent-type="{{ $j }}" data-id="{{ $i }}" type="button">Add More</button>
												</div>
											</div>
										</div>
										</div>
									 </div>
								  </div>
								  <div class="row">
								   <div class="col-12 text-right">
								      <button class="btn btn-danger remove_add" data-type="1" data-id="{{ $i }}" type="button">Remove Url</button>
									</div>
								  </div>
							   </div>
							</div>
							@php 
							  $i=$i+1; 
							  $j=$j+1; 
							@endphp
							@endforeach
						  @endif
							<div class="col-md-12 select_url">
							    <div class="p-4 bg-secondary mb-2">
								<div class="form-group">
									<label> Url</label>
									<div class="input-group">
										<input type="text" name="url_name[]" placeholder="Enter Url" class="form-control">
									 </div>
								</div>
								<div class="row">
									<div class="col-md-6">
									  <div class="display_brand_keyword_{{ !empty($editProjects->urls) ? $editProjects->urls->count()+1 : 1}}">
										<div class="section-title mt-5 mb-5">
											<h4>Brand Keyword's</h4>
										</div>
										 
										 <div class="form-group child_keyword">
											<label>Brand Keyword</label>
											<div class="input-group">
												<input type="text" name="brand_keyword[0][]" placeholder="Brand Keyword" class="form-control" >
												<div class="input-group-append">
													  <button class="btn btn-info add_more_brand" id="add_more_brand_{{ !empty($editProjects->urls) ? $editProjects->urls->count()+1 : 1}}" data-type="1" data-parent-type="{{ !empty($editProjects->urls) ? $editProjects->urls->count()+1 : 1}}" data-id="0" type="button">Add More</button>
												</div>
											</div>
										  </div>
									  </div>
									 </div>
									 <div class="col-md-6">
										<div class="display_secondary_keyword_{{ !empty($editProjects->urls) ? $editProjects->urls->count()+1 : 1}}">
										<div class="section-title mt-5 mb-5">
											<h4>Secondary Keyword's</h4>
										</div>
										
										<div class="form-group child_keyword">
											<label>Secondary Keywords</label>
											<div class="input-group">
												<input type="text" name="secondary_keyword[0][]" placeholder="Secondary Keyword" class="form-control">
												<div class="input-group-append">
													<button class="btn btn-info add_more_secondary" id="add_more_secondary_{{ !empty($editProjects->urls) ? $editProjects->urls->count()+1 : 1}}" data-type="1" data-parent-type="{{ !empty($editProjects->urls) ? $editProjects->urls->count()+1 : 1}}" data-id="0" type="button">Add More</button>
												</div>
											</div>
										</div>
										</div>
									 </div>
								  </div>
								  <div class="row">
								   <div class="col-12 text-right">
								      <button class="btn btn-success add_more" data-type="{{ !empty($editProjects->urls) ? $editProjects->urls->count()+1 : 1}}" data-id="{{ !empty($editProjects->urls) ? $editProjects->urls->count() : 0}}" type="button">Add More Url</button>
									</div>
								  </div>
							   </div>
							</div>
							
							<hr>
					   </div>
					   <hr>
						<div class="row">
						 <div class="col-md-6">
							<div class="display_exactkeyword">
							<div class="section-title mt-5 mb-5">
								<h4>Exact Keyword's</h4>
							</div>
							@if(!empty($editProjects->exactKeywords))
							@foreach($editProjects->exactKeywords as $exactkeywordsData)
						    <div class="form-group">
								<label>Exact Keyword</label>
								<div class="input-group">
									<input type="text" name="exact_keyword[]" placeholder="Enter Exact Keyword" class="form-control" value="{{ $exactkeywordsData->exact_keywords }}">
									<div class="input-group-append">
										 <button class="btn btn-danger remove_add_exact" data-type="1" type="button">Remove</button>
									</div>
								</div>
							</div>
							@endforeach
						  @endif
							<div class="form-group">
								<label>Exact Keyword</label>
								<div class="input-group">
									<input type="text" name="exact_keyword[]" placeholder="Enter Exact Keyword" class="form-control">
									<div class="input-group-append">
										<button class="btn btn-primary add_more_exact" data-type="{{ !empty($editProjects->exactKeywords) ? $editProjects->exactKeywords->count()+1 : 1}}" type="button">Add More</button>
									</div>
								</div>
							</div>
							</div>
						 </div>
						  <div class="col-md-6">
							<div class="display_partialkeyword">
							<div class="section-title mt-5 mb-5">
								<h4>Partial Keyword's</h4>
							</div>
							 @if(!empty($editProjects->partialKeywords))
								@foreach($editProjects->partialKeywords as $partialkeywordsData)
							     <div class="form-group">
									<label>Partial Keyword</label>
									<div class="input-group">
										<input type="text" name="partial_keyword[]" placeholder="Enter Partial Keyword" class="form-control" value="{{ $partialkeywordsData->partial_keywords }}">
										<div class="input-group-append">
											<button class="btn btn-danger remove_add_partial" data-type="1" type="button">Remove</button>
										</div>
									</div>
								</div>
								
								@endforeach
							 @endif
							<div class="form-group">
								<label>Partial Keyword</label>
								<div class="input-group">
									<input type="text" name="partial_keyword[]" placeholder="Enter Partial Keyword" class="form-control">
									<div class="input-group-append">
										<button class="btn btn-primary add_more_partial" data-type="{{ !empty($editProjects->partialKeywords) ? $editProjects->partialKeywords->count()+1 : 1}}" type="button">Add More</button>
									</div>
								</div>
							</div>
							</div>
						  </div>
						
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
$('#project-form').parsley();
$('body').on('click', '.add_more', function () {
   var dataval = $(this).attr("data-type");
   var dataId = $(this).attr("data-id");
   dataval++;
   dataId++;
	//alert(dataval);
   if(dataval < 51){
	   varHtml = "";
	   varHtml = '<div class="col-md-12 select_url"><div class="p-4 bg-secondary mb-2"><div class="form-group"><label> Url</label><div class="input-group"><input type="text" name="url_name[]" placeholder="Enter Url" class="form-control"></div></div><div class="row"><div class="col-md-6"><div class="display_brand_keyword_'+dataval+'"><div class="section-title mt-5 mb-5"><h4>Brand Keywords</h4></div><div class="form-group child_keyword"><label>Brand Keyword</label><div class="input-group"><input type="text" name="brand_keyword['+dataId+'][]" placeholder="Brand Keyword" class="form-control" ><div class="input-group-append"><button class="btn btn-info add_more_brand" id="add_more_brand_1" data-type="1" data-parent-type="'+dataval+'" type="button">Add More</button></div></div></div></div></div><div class="col-md-6"><div class="display_secondary_keyword_'+dataval+'"><div class="section-title mt-5 mb-5"><h4>Secondary Keywords</h4></div><div class="form-group child_keyword"><label>Secondary Keywords</label><div class="input-group"><input type="text" name="secondary_keyword['+dataId+'][]" placeholder="Secondary Keyword" class="form-control"><div class="input-group-append"><button class="btn btn-info add_more_secondary" id="add_more_secondary_1" data-type="1" data-parent-type="'+dataval+'" type="button">Add More</button></div></div></div></div></div></div><div class="row"><div class="col-12 text-right"><button class="btn btn-success add_more" data-type="'+dataval+'" data-id="'+dataId+'" type="button">Add More Url</button></div></div></div></div>';
	   $('.display_url').append(varHtml);
	   $(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).removeClass('add_more');
		$(this).addClass('remove_add');
		$(this).text('Remove Url');
		
   }else{
	    alert('Have exceeded their limits');
	   return false;
   }
    
});
$("body").on("click", ".remove_add", function () {
    $(this).parent().parent().parent().parent().remove();
	var dataval = $('.add_more').attr("data-type");
    dataval--;
	$('.add_more').attr("data-type",dataval);
	$('#display-span').html(dataval);
});
$('body').on('click', '.add_more_brand', function () {
   var dataval = $(this).attr("data-type");
   var dataParentval = $(this).attr("data-parent-type");
   var dataId = $(this).attr("data-id");
   //alert(dataval);
   dataval++;
   //alert(dataParentval);
   if(dataval < 11){
	   varHtml = "";
	   varHtml = '<div class="form-group child_keyword"><label>Brand Keyword</label><div class="input-group"><input type="text" name="brand_keyword['+dataId+'][]" placeholder="Brand Keyword" class="form-control" ><div class="input-group-append"><button class="btn btn-info add_more_brand" id="add_more_brand_'+dataParentval+'" data-type="'+dataval+'" data-parent-type="'+dataParentval+'" data-id="'+dataId+'" type="button">Add More</button></div></div></div>';
	    $('.display_brand_keyword_'+dataParentval).append(varHtml);
		dataId++;
        $(this).removeClass('btn-primary');
		$(this).addClass('btn-danger');
		$(this).removeClass('add_more_brand');
		$(this).addClass('remove_add_brand');
		$(this).text('Remove');
		$(this).attr('id','remove_add_brand_'+dataParentval);
   }else{
	    alert('Have exceeded their limits');
	   return false;
   }
    
});
$("body").on("click", ".remove_add_brand", function () {
	var dataParentval = $(this).attr("data-parent-type");
	$(this).parent().parent().parent().remove();
	var dataval = $('#add_more_brand_'+dataParentval).attr("data-type");
	dataval--;
	$('#add_more_brand_'+dataParentval).attr("data-type",dataval);
});
$('body').on('click', '.add_more_secondary', function () {
   var dataval = $(this).attr("data-type");
   var dataParentval = $(this).attr("data-parent-type");
   var dataId = $(this).attr("data-id");
   dataval++;
   //alert(dataParentval);
   if(dataval < 31){
	   varHtml = "";
	   varHtml = '<div class="form-group child_keyword"><label>Secondary Keyword</label><div class="input-group"><input type="text" name="secondary_keyword['+dataId+'][]" placeholder="Secondary Keyword" class="form-control" ><div class="input-group-append"><button class="btn btn-info add_more_secondary" id="add_more_secondary_'+dataParentval+'" data-type="'+dataval+'" data-parent-type="'+dataParentval+'" data-id="'+dataId+'" type="button">Add More</button></div></div></div>';
	    $('.display_secondary_keyword_'+dataParentval).append(varHtml);
		dataId++;
		$(this).removeClass('btn-primary');
		$(this).addClass('btn-danger');
		$(this).removeClass('add_more_secondary');
		$(this).addClass('remove_add_secondary');
		$(this).text('Remove');
		$(this).attr('id','remove_add_secondary_'+dataParentval);
   }else{
	   alert('Have exceeded their limits');
	   return false; 
   }
    
});
$("body").on("click", ".remove_add_secondary", function () {
	var dataParentval = $(this).attr("data-parent-type");
	$(this).parent().parent().parent().remove();
	var dataval = $('#add_more_secondary_'+dataParentval).attr("data-type");
    dataval--;
	$('#add_more_secondary_'+dataParentval).attr("data-type",dataval);
});
$('body').on('click', '.add_more_exact', function () {
   var dataval = $(this).attr("data-type");
   dataval++;
   //alert(dataval);
   if(dataval < 11){
	   varHtml = "";
	    varHtml = '<div class="form-group"><label>Exact Keyword</label><div class="input-group"><input type="text" name="exact_keyword[]" placeholder="Enter Exact Keyword" class="form-control"><div class="input-group-append"><button class="btn btn-primary add_more_exact" data-type="'+dataval+'" type="button">Add More</button></div></div></div>';
	    $('.display_exactkeyword').append(varHtml);
		$(this).removeClass('btn-primary');
		$(this).addClass('btn-danger');
		$(this).removeClass('add_more_exact');
		$(this).addClass('remove_add_exact');
		$(this).text('Remove');
   }else{
	    alert('Have exceeded their limits');
	   return false;
   }
    
});
$("body").on("click", ".remove_add_exact", function () {
	$(this).parent().parent().parent().remove();
	var dataval = $('.add_more_exact').attr("data-type");
    dataval--;
	$('.add_more_exact').attr("data-type",dataval);
});
$('body').on('click', '.add_more_partial', function () {
   var dataval = $(this).attr("data-type");
   dataval++;
   //alert(dataval);
   if(dataval < 11){
	   varHtml = "";
	    varHtml = '<div class="form-group"><label>Partial Keyword</label><div class="input-group"><input type="text" name="partial_keyword[]" placeholder="Enter Partial Keyword" class="form-control"><div class="input-group-append"><button class="btn btn-primary add_more_partial" data-type="'+dataval+'" type="button">Add More</button></div></div></div>';
	    $('.display_partialkeyword').append(varHtml);
		$(this).removeClass('btn-info');
		$(this).addClass('btn-danger');
		$(this).removeClass('add_more_partial');
		$(this).addClass('remove_add_partial');
		$(this).text('Remove');
   }else{
	   alert('Have exceeded their limits');
	   return false; 
   }
    
});
$("body").on("click", ".remove_add_partial", function () {
    $(this).parent().parent().parent().remove();
	var dataval = $('.add_more_partial').attr("data-type");
    dataval--;
	$('.add_more_partial').attr("data-type",dataval);
});
</script>
@endsection
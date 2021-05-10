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
				<h5 class="text-dark font-weight-bold my-1 mr-5">Project Url Keyword</h5>
				<!--end::Page Title-->
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a href="{{ route('projects.index') }}" class="text-muted">Project Url</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a class="text-muted">Manage Brand & Secondary Keyword</a>
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
						<h3 class="card-title">Manage Brand & Secondary Keyword</h3>
						<div class="card-toolbar">
							<a href="{{ route('projects.view',['id'=>$projectUrlData->project_id])}}" class="btn btn-light-primary font-weight-bolder mr-2">
							<i class="ki ki-long-arrow-back icon-xs"></i>Back</a>
							
						</div>
					</div>
					<!--begin::Form-->
					  <form action="{{ route('projects.managekeyword.post') }}" class="form-horizontal" enctype="multipart/form-data" method="post" id="project-form">
						@csrf
						<div class="card-body">
						<div class="row">
						  <div class="col-md-6">
							<div class="form-group">
							 <label>Url Name
							  <span class="text-danger">*</span></label>
							   <input required type="text" name="project_name" placeholder="Project Name" class="form-control" value="{{ $projectUrlData->url_name }}" disabled>
							<input type="hidden" name="hid_url_id" value="{{ $id }}">
							</div>
						  </div>
						 
					   </div>
					   <hr>
					   <div class="row">
						  <div class="col-md-6">
						  <div class="display_brandkeyword">
							<div class="section-title mt-5 mb-5">
								<h4>Brand Keyword's</h4>
							</div>
							 @if(!empty($projectUrlBrandKeywordData[0]))
							 @foreach($projectUrlBrandKeywordData as $projectUrlBrandKeyword)
							   <div class="form-group">
								<label>Brand Keyword</label>
								<div class="input-group">
									<input type="text" name="brand_keyword[]" placeholder="Brand Keyword" class="form-control" value="{{ $projectUrlBrandKeyword->brand_keyword }}">
									<div class="input-group-append">
										 <button class="btn btn-danger remove_add_brand" data-type="1" type="button">Remove</button>
									</div>
								</div>
							  </div>
							 @endforeach
						   @endif
							 <div class="form-group">
								<label>Brand Keyword</label>
								<div class="input-group">
									<input type="text" name="brand_keyword[]" placeholder="Brand Keyword" class="form-control" >
									<div class="input-group-append">
										  <button class="btn btn-info add_more_brand" data-type="{{ !empty($projectUrlBrandKeywordData) ? $projectUrlBrandKeywordData->count()+1 : 1}}" type="button">Add More</button>
									</div>
								</div>
							  </div>
						  </div>
						 </div>
						 <div class="col-md-6">
							<div class="display_secondarykeyword">
							<div class="section-title mt-5 mb-5">
								<h4>Secondary Keyword's</h4>
							</div>
							@if(!empty($projectUrlSecondaryKeywordData[0]))
					          @foreach($projectUrlSecondaryKeywordData as $projectUrlSecondaryKeyword)
						    <div class="form-group">
								<label>Secondary Keyword</label>
								<div class="input-group">
									<input type="text" name="secondary_keyword[]" placeholder="Secondary Keyword" class="form-control" value="{{ $projectUrlSecondaryKeyword->secondary_keyword }}">
									<div class="input-group-append">
										<button class="btn btn-danger remove_add_secondary" data-type="1" type="button">Remove</button>
									</div>
								</div>
							</div>
							@endforeach
						  @endif
							<div class="form-group">
								<label>Secondary Keywords</label>
								<div class="input-group">
									<input type="text" name="secondary_keyword[]" placeholder="Secondary Keyword" class="form-control">
									<div class="input-group-append">
										<button class="btn btn-info add_more_secondary" data-type="{{ !empty($projectUrlSecondaryKeywordData) ? $projectUrlSecondaryKeywordData->count()+1 : 1}}" type="button">Add More</button>
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
$('body').on('click', '.add_more_brand', function () {
   var dataval = $(this).attr("data-type");
   dataval++;
   //alert(dataval);
   if(dataval < 11){
	   varHtml = "";
	   varHtml = '<div class="form-group"><label>Brand Keyword</label><div class="input-group"><input type="text" name="brand_keyword[]" placeholder="Brand Keyword" class="form-control" ><div class="input-group-append"><button class="btn btn-info add_more_brand" data-type="'+dataval+'" type="button">Add More</button></div></div></div>';
	    $('.display_brandkeyword').append(varHtml);
		$(this).removeClass('btn-primary');
		$(this).addClass('btn-danger');
		$(this).removeClass('add_more_brand');
		$(this).addClass('remove_add_brand');
		$(this).text('Remove');
   }else{
	    alert('Have exceeded their limits');
	   return false;
   }
    
});
$("body").on("click", ".remove_add_brand", function () {
    $(this).parent().parent().parent().remove();
	var dataval = $('.add_more_brand').attr("data-type");
    dataval--;
	$('.add_more_brand').attr("data-type",dataval);
});
$('body').on('click', '.add_more_secondary', function () {
   var dataval = $(this).attr("data-type");
   dataval++;
   //alert(dataval);
   if(dataval < 31){
	   varHtml = "";
	   varHtml = '<div class="form-group"><label>Secondary Keyword</label><div class="input-group"><input type="text" name="secondary_keyword[]" placeholder="Secondary Keyword" class="form-control" ><div class="input-group-append"><button class="btn btn-info add_more_secondary" data-type="'+dataval+'" type="button">Add More</button></div></div></div>';
	    $('.display_secondarykeyword').append(varHtml);
		$(this).removeClass('btn-primary');
		$(this).addClass('btn-danger');
		$(this).removeClass('add_more_secondary');
		$(this).addClass('remove_add_secondary');
		$(this).text('Remove');
   }else{
	   alert('Have exceeded their limits');
	   return false; 
   }
    
});
$("body").on("click", ".remove_add_secondary", function () {
    $(this).parent().parent().parent().remove();
	var dataval = $('.add_more_secondary').attr("data-type");
    dataval--;
	$('.add_more_secondary').attr("data-type",dataval);
});
</script>
@endsection
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
				<h5 class="text-dark font-weight-bold my-1 mr-5">Crawler</h5>
			    <!--end::Page Title-->
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a class="text-muted">Crawler Upload</a>
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
												<h3 class="card-title">Crawler Upload</h3>
												<div class="card-toolbar">
													<a href="{{ route('dashboard') }}" class="btn btn-light-primary font-weight-bolder mr-2">
													<i class="ki ki-long-arrow-back icon-xs"></i>Back</a>
													
												</div>
												
											</div>
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
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
											<!--begin::Form-->
												  <form action="{{ route('api.v1.crawler.post',['id'=>$id]) }}" class="form-horizontal" enctype="multipart/form-data" method="post" id="user-form">
													@csrf
													<div class="card-body">
													
												   <div class="row">
													  <div class="col-md-6">
														<div class="form-group">
														 <label>Crawler Job Upload
														  <span class="text-danger">*</span></label>
														   <input type="file" name="upload_csv" class="form-control" >
														</div>
													  </div>
                                                      
													</div>
                                                    
													
												</div>
												<div class="card-footer">
													<button type="submit" class="btn btn-primary">Submit</button>
													
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
<script>
$('#user-form').parsley();
$("body").on("click",".clickpassword",function(){
		var id = $(this).attr('data-id');
		if(id == 1){
			$("#password").attr("type","text");
			$(".clickpassword").attr("data-id",2);
			$(".clickpassword").html("Hide");
        }else{
			$("#password").attr("type","password");
			$(".clickpassword").attr("data-id",1);
			$(".clickpassword").html("Show");
        }
	 });
</script>
@endsection
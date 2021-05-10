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
				<h5 class="text-dark font-weight-bold my-1 mr-5">Configure</h5>
			    <!--end::Page Title-->
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a>
					</li>
                    <li class="breadcrumb-item text-muted">
						<a href="{{ route('users.index') }}" class="text-muted">Users</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a class="text-muted">Configure Crawler</a>
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
                                            <div class="row w-100 align-items-center">
                                                <div class="col-6">
                                                    <h3 class="card-title m-0">Configure Crawler</h3>
                                                    <small class="text-danger">Username and Password should be of cloudcrawler.io</small>                                            
                                                </div>
                                                <div class="col-6 text-right"> 
                                                        <a href="{{ route('users.index') }}" class="btn btn-light-primary font-weight-bolder">
                                                        <i class="ki ki-long-arrow-back icon-xs"></i>Back</a>												
                                                </div>
                                            </div>
                                              </div>
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
												  <form action="{{ route('users.configure.post',['id'=>$user->id]) }}" class="form-horizontal" enctype="multipart/form-data" method="post" id="user-form-configure">
													@csrf
													<div class="card-body">
													
												   <div class="row">
													  <div class="col-md-6">
														<div class="form-group">
														 <label>Email Id
														  <span class="text-danger">*</span></label>
														   <input required type="email" name="email" placeholder="Please enter email" class="form-control" data-parsley-error-message="Please enter email id" value="{{ !empty($getConfigureCrawler->username) ? $getConfigureCrawler->username : '' }}">
														</div>
													  </div>
                                                      <div class="col-md-6">
                                                           <div class="form-group">
                                                                <label>Password</label>
                                                                <div class="input-group">
                                                                    <input required type="password" name="password" id="password" placeholder="Please enter password" class="form-control" data-parsley-error-message="Please enter password" value="{{ !empty($getConfigureCrawler->password) ? $getConfigureCrawler->password : '' }}">
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-primary clickpassword" data-id="1" type="button">Show</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                       
                                                      
													</div>
                                                    <div class="row {{ !empty($getConfigureCrawler->access_token	) ? ''	 : 'd-none' }}">
													  <div class="col-md-12">
														<div class="form-group">
														 <label>Access Token</label>
														   <input type="text" placeholder="Please enter email" class="form-control"  value="{{ !empty($getConfigureCrawler->access_token	) ? $getConfigureCrawler->access_token	 : '' }}" disabled>
														</div>
													  </div>
                                                      
													</div>
													
												</div>
												<div class="card-footer">
												<input type="hidden" class="d-none" name="hid_config_id" value="{{ !empty($getConfigureCrawler->id	) ? $getConfigureCrawler->id	 : '' }}">
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

$('#user-form-configure').parsley();
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
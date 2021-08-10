@extends('layout.auth')
@section('title')
Leads
@endsection
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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Dashboard</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('combined.search') }}" class="text-muted">Combined Sheet</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            View
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
									<h3 class="card-label">Combined Sheet
								</div>
								<div class="card-toolbar">
										<a href="{{ route('combined.search')}}" class="btn btn-light-primary font-weight-bolder mr-2">
										<i class="ki ki-long-arrow-back icon-xs"></i>Back</a>
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
															<td><h6><span class="">Campaign Id</span></h6></td>
															<td>{{ $arrLead->campaign_id }}</td>
														</tr>
														<tr>
															<td><h6><span class="">Keyword</span></h6></td>
															<td>{{ $arrLead->keyword }}</td>
														</tr>
														<tr>
															<td><h6><span class="">Description</span></h6></td>
															<td>{{ $arrLead->description }}</td>
														</tr>
														<tr>
															<td><h6><span class="">Email</span></h6></td>
															<td>{{ $arrLead->email }}</td>
														</tr>
														
														<tr>
															<td><h6><span class="">Source</span></h6></td>
															<td>{{ $arrLead->source }} </td>
														</tr>
                                                        <tr>
															<td><h6><span class="">Lemlist Inserted</span></h6></td>
															<td>{{ ($arrLead->is_inserted_lemlist==1) ?'Yes':'No' }} </td>
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
															<td><h6><span class="">Company</span></h6></td>
															<td>{{ $arrLead->company }}</td>
														</tr>
														<tr>
															<td><span class=""><h6>Url</h6></span></td>
															<td>{{ $arrLead->url }} </td>
														</tr>
														<tr>
															<td><h6><span class="">Full Name</span></h6></td>
															<td>{{ $arrLead->first_name.' '.$arrLead->last_name }} </td>
														</tr>
														<tr>
															<td><h6><span class="">Area Interest</span></h6></td>
															<td>{{ $arrLead->area_interest }}</td>
														</tr>
														<tr>
															<td><h6><span class="">Sdr</span></h6></td>
															<td>{{ $arrLead->sdr }} </td>
														</tr>
                                                        <tr>
															<td><h6><span class="">Sheet Name</span></h6></td>
															<td>{{ !empty($arrLead->sheet->sheet_short_name) ? $arrLead->sheet->sheet_short_name : '' }} </td>
														</tr>
													</tbody>
												</table>
											</div>
											</div>
									 </div>
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
	 
	 
</script>
@endsection
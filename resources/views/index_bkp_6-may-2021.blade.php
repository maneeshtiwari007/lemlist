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
				<h5 class="text-dark font-weight-bold my-1 mr-5">Dashboard</h5>
				<!--end::Page Title-->
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a href="{{ route('dashboard') }}" class="text-muted">Home</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a>
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
		<!--begin::Dashboard-->
		<!--begin::Row-->
		<div class="row">
			<div class="col-lg-4 col-xxl-4">
				<!--begin::Mixed Widget 1-->
				<div class="card card-custom bg-white-100 card-stretch gutter-b">
					<!--begin::Header-->
					<div class="card-header border-0 bg-danger py-5">
						<h3 class="card-title font-weight-bolder text-white">Total</h3>
						<div class="card-toolbar d-none">
							<div class="dropdown dropdown-inline">
								<a href="#" class="btn btn-transparent-white btn-sm font-weight-bolder dropdown-toggle px-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Export</a>
								<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<!--begin::Navigation-->
									<ul class="navi navi-hover">
										<li class="navi-header pb-1">
											<span class="text-primary text-uppercase font-weight-bold font-size-sm">Add new:</span>
										</li>
										<li class="navi-item">
											<a href="#" class="navi-link">
												<span class="navi-icon">
													<i class="flaticon2-shopping-cart-1"></i>
												</span>
												<span class="navi-text">Order</span>
											</a>
										</li>
										<li class="navi-item">
											<a href="#" class="navi-link">
												<span class="navi-icon">
													<i class="flaticon2-calendar-8"></i>
												</span>
												<span class="navi-text">Event</span>
											</a>
										</li>
										<li class="navi-item">
											<a href="#" class="navi-link">
												<span class="navi-icon">
													<i class="flaticon2-graph-1"></i>
												</span>
												<span class="navi-text">Report</span>
											</a>
										</li>
										<li class="navi-item">
											<a href="#" class="navi-link">
												<span class="navi-icon">
													<i class="flaticon2-rocket-1"></i>
												</span>
												<span class="navi-text">Post</span>
											</a>
										</li>
										<li class="navi-item">
											<a href="#" class="navi-link">
												<span class="navi-icon">
													<i class="flaticon2-writing"></i>
												</span>
												<span class="navi-text">File</span>
											</a>
										</li>
									</ul>
									<!--end::Navigation-->
								</div>
							</div>
						</div>
					</div>
					<!--end::Header-->
					<!--begin::Body-->
					<div class="card-body p-0 position-relative overflow-hidden">
						<!--begin::Chart-->
						<div id="" class="card-rounded-bottom bg-danger" style="height: 200px"></div>
						<!--end::Chart-->
						<!--begin::Stats-->
						<div class="card-spacer mt-n25">
							<!--begin::Row-->
							<div class="row m-0">
							@if(Auth::user()->role_id == 1)
								<div class="col bg-light-warning px-6 py-8 rounded-xl mr-7 mb-7">
									<div class="row d-flex justify-content-center align-items-center">
									<div class="col pr-0">
										<span class="svg-icon svg-icon-3x svg-icon-primary d-block">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24" />
													<path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
													<path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
												</g>											
											</svg>										
											<!--end::Svg Icon-->											
										</span>
										<a href="{{ route('users.index')}}" class="text-primary font-weight-bold font-size-h6 mt-2">Users</a>
									</div>
									<div class="pl-0 col text-right">
										<h6><strong>{{ $userCount }}</strong></h6>
								     </div>
									</div>
									
								</div>
							@endif
								<div class="col bg-light-danger px-6 py-8 rounded-xl mr-7 mb-7">
									<div class="row d-flex justify-content-center align-items-center">
									<div class="col pr-0">
										<span class="svg-icon svg-icon-3x svg-icon-danger d-block">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24" />
													<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
													<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
												</g>
											</svg>									
											<!--end::Svg Icon-->											
										</span>
										<a href="{{ route('projects.index') }}" class="text-danger font-weight-bold font-size-h6 mt-2">Projects</a>
									</div>
									<div class="pl-0 col text-right">
										<h6><strong>{{ $projectCount }}</strong></h6>
								     </div>
									</div>
									
								</div>
								@if(Auth::user()->role_id == 2)
								<div class="col bg-light-success px-6 py-8 rounded-xl mr-7 mb-7">
									<div class="row d-flex justify-content-center align-items-center">
									 <div class="col pr-0">
										<span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M12.7037037,14 L15.6666667,10 L13.4444444,10 L13.4444444,6 L9,12 L11.2222222,12 L11.2222222,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L12.7037037,14 Z" fill="#000000" opacity="0.3" />
													<path d="M9.80428954,10.9142091 L9,12 L11.2222222,12 L11.2222222,16 L15.6666667,10 L15.4615385,10 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9.80428954,10.9142091 Z" fill="#000000" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
										<a href="{{ route('jobs.index') }}" class="text-success font-weight-bold font-size-h6 mt-2">Jobs</a>
									</div>
									<div class="pl-0 col text-right">
										<h6><strong>{{ $jobCount }}</strong></h6>
									 </div>
									</div>
							   </div>
								@endif
							</div>
							<!--end::Row-->
							@if(Auth::user()->role_id == 1)
							<!--begin::Row-->
							<div class="row m-0">
								<div class="col bg-light-success px-6 py-8 rounded-xl mr-7 mb-7">
									<div class="row d-flex justify-content-center align-items-center">
									 <div class="col">
										<span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M12.7037037,14 L15.6666667,10 L13.4444444,10 L13.4444444,6 L9,12 L11.2222222,12 L11.2222222,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L12.7037037,14 Z" fill="#000000" opacity="0.3" />
													<path d="M9.80428954,10.9142091 L9,12 L11.2222222,12 L11.2222222,16 L15.6666667,10 L15.4615385,10 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9.80428954,10.9142091 Z" fill="#000000" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
										<a href="{{ route('jobs.index') }}" class="text-success font-weight-bold font-size-h6 mt-2">Jobs</a>
									</div>
									<div class="col text-right">
										<h6><strong>{{ $jobCount }}</strong></h6>
									 </div>
									</div>
							   </div>
							</div>
							<!--end::Row-->
							@endif
							
						</div>
						<!--end::Stats-->
					</div>
					<!--end::Body-->
				</div>
				<!--end::Mixed Widget 1-->
			</div>
			<div class="col-xl-4 col-xxl-4">
				<!--begin::Tiles Widget 1-->
				<div class="card card-custom bg-white-100 card-stretch gutter-b">
					<!--begin::Header-->
					<div class="card-header border-0 pt-5">
						<div class="card-title">
							<div class="card-label">
								<div class="font-weight-bolder">Recent Projects</div>
								<div class="font-size-sm text-muted mt-2">{{ $getTotalProjects }} Projects</div>
							</div>
						</div>
						<div class="card-toolbar">
							<div class="dropdown dropdown-inline">
								<a href="#" class="btn btn-clean btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="ki ki-bold-more-hor"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
									<!--begin::Navigation-->
									<ul class="navi navi-hover py-5">
										<li class="navi-item">
											<a href="{{ route('projects.add')}}" class="navi-link">
												<span class="navi-icon">
													<i class="flaticon2-plus"></i>
												</span>
												<span class="navi-text">New Project</span>
											</a>
										</li>
										
									</ul>
									<!--end::Navigation-->
								</div>
							</div>
						</div>
					</div>
					<!--end::Header-->
					<!--begin::Body-->
					<div class="card-body d-flex flex-column px-0">
						<!--begin::Items-->
						<div class="flex-grow-1 card-spacer-x">
							@if(!empty($getRecentProjects[0]))
								@foreach($getRecentProjects as $pro)
								<!--begin::Item-->
								<div class="d-flex align-items-center justify-content-between mb-10">
									<div class="d-flex align-items-center mr-2">
										<div>
											<a href="{{ route('projects.view',['id'=>$pro->id])}}" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">{{ $pro->name }}</a>
											<div class="font-size-sm text-muted font-weight-bold mt-1">{{ (!empty($pro['description']) && (strlen($pro['description']) > 20)) ? substr($pro['description'],0,20).'...' : $pro['description'] }}</div>
										</div>
									</div>
									@if($pro->urls->count() != 0)
									<div class="label label-light label-inline font-weight-bold text-dark-50 py-4 px-3 font-size-base">
									   {{ $pro->urls->count() }} Url
									</div>
									@endif
								</div>
								<!--end::Item-->
							@endforeach
							@endif
							
						</div>
						<!--end::Items-->
					</div>
					<!--end::Body-->
				</div>
				<!--end::Tiles Widget 1-->
			</div>
			<div class="col-xl-4 col-xxl-4">
				<!--begin::Tiles Widget 1-->
				<div class="card card-custom bg-white-100 card-stretch gutter-b">
					<!--begin::Header-->
					<div class="card-header border-0 pt-5">
						<div class="card-title">
							<div class="card-label">
								<div class="font-weight-bolder">Recent Jobs</div>
								<div class="font-size-sm text-muted mt-2"> {{ $getTotalJobs }} Jobs</div>
							</div>
						</div>
						<div class="card-toolbar">
							<div class="dropdown dropdown-inline">
								<a href="#" class="btn btn-clean btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="ki ki-bold-more-hor"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
									<!--begin::Navigation-->
									<ul class="navi navi-hover py-5">
										<li class="navi-item">
											<a href="{{ route('jobs.add') }}" class="navi-link">
												<span class="navi-icon">
													<i class="flaticon2-drop"></i>
												</span>
												<span class="navi-text">New Job</span>
											</a>
										</li>
										
									</ul>
									<!--end::Navigation-->
								</div>
							</div>
						</div>
					</div>
					<!--end::Header-->
					<!--begin::Body-->
					<div class="card-body d-flex flex-column px-0">
						<!--begin::Items-->
						<div class="flex-grow-1 card-spacer-x">
							@if(!empty($getRecentJobs[0]))
								@foreach($getRecentJobs as $pro)
							<!--begin::Item-->
							<div class="d-flex align-items-center justify-content-between mb-10">
								<div class="d-flex align-items-center mr-2">
									<div>
										<a href="{{ route('jobs.view',['id'=>$pro->id])}}" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">{{ $pro->job_title }}</a>
										<div class="font-size-sm text-muted font-weight-bold mt-1">
											{{ $pro->projects->name }}</div>
									</div>
								</div>
								<div class="label label-light label-inline font-weight-bold text-dark-50 py-4 px-3 font-size-base">
									{{ $pro->no_of_searches }}</div>
							</div>
							<!--end::Item-->
							@endforeach
							@endif
						</div>
						<!--end::Items-->
					</div>
					<!--end::Body-->
				</div>
				<!--end::Tiles Widget 1-->
			</div>
			
	</div>
		<!--end::Row-->
		
		<!--end::Dashboard-->
	</div>
	<!--end::Container-->
</div>
<!--end::Entry-->
</div>
@endsection
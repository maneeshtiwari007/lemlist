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
						<a class="text-muted">Project Urls</a>
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
		<!--begin::Notice-->
		<div class="alert alert-custom alert-white alert-shadow fade show gutter-b d-none" role="alert">
			<div class="alert-icon">
				<span class="svg-icon svg-icon-primary svg-icon-xl">
					<!--begin::Svg Icon | path:assets/media/svg/icons/Tools/Compass.svg-->
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<rect x="0" y="0" width="24" height="24" />
							<path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3" />
							<path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero" />
						</g>
					</svg>
					<!--end::Svg Icon-->
				</span>
			</div>
			<div class="alert-text">Metronic extends
			<code>Bootstrap Table</code>component with a variety of options to provide unique looking Table components that matches Metronic's design standards.
			<br />For more info on the original Bootstrap utilities please visit the official
			<a class="font-weight-bold" href="https://getbootstrap.com/docs/4.5/content/tables/" target="_blank">Bootstrap Documentation</a>.</div>
		</div>
		<!--end::Notice-->
		<div class="row mb-5">
		    @if(!empty($projectUrl['data'][0]))
					@php $i=1; @endphp
	          @foreach($projectUrl['data'] as $pro)
					<div class="col-xl-4">
						<!--begin::Card-->
						<div class="card card-custom">
							<div class="card-header">
							@if(($user->id == $pro->user_id) || ($user->role_id == 1))
								<a href="{{ route('projects.addkeyword',['id'=>$pro->id])}}" class="mt-5">
									<div class="card-title">
									  <h3 class="card-label">	{{ $pro['url_name'] }}
										</h3>
									</div>
								</a>
								@else
								<div class="card-title mt-5">
									<h3 class="card-label">{{ $pro['url_name'] }}</h3>
								</div>
								@endif
								@if(($user->id == $pro->user_id) || ($user->role_id == 1))
								<div class="card-toolbar">
									<a href="{{ route('projects.addkeyword',['id'=>$pro->id])}}" class="btn btn-sm btn-icon btn-light-primary mr-2">
										<i class="la la-plus mr-1"></i>
									</a>
									
									<a class="btn btn-sm btn-icon btn-light-danger remove-projecturl" data-id="{{ $pro->id }}" data-href="{{ route('projects.keyword.remove',['id'=>$pro->id])}}" data-toggle="modal" data-target="#success-modal" id="projecturl-delete-{{ $pro->id }}"><i class="la la-close mr-1"></i></a>
								</div>
								@endif
							</div>
							<div class="card-body project-url">
								<div class="row">
								  <div class="col-xl-12">
								     <div class="heading">Brand keyword <strong>(+ {{ $pro->brandKeywords->count() }})</strong></div>
									  @if($pro->brandKeywords->count() !=0)
										  @foreach($pro->brandKeywords as $proBrand)
									       <div>
											<span class='badge badge-info mt-3'>{{ $proBrand->brand_keyword }}</span>
											</div>
										  @endforeach 
										  
									  @endif
								  </div>
								</div>
								<hr>
								<div class="row">
								  <div class="col-xl-12">
								     <div class="heading">Secondary keyword <strong>(+ {{ $pro->secondaryKeywords->count() }})</strong></div>
									  @if($pro->secondaryKeywords->count() !=0)
										  @foreach($pro->secondaryKeywords as $proSecondary)
									        <div>
											<span class='badge badge-success mt-3'>{{ $proSecondary->secondary_keyword }}</span>
											</div>
										  @endforeach 
										  
									  @endif
								  </div>
								</div>
							      
							</div>
							
						</div>
				<!--end::Card-->
				</div>
				 @if(($i%3==0) && (count($projectUrl['data']) > $i))
					 </div>
				     <div class="row mb-5">
				  @endif
				   @php $i=$i+1;@endphp
				@endforeach
				@else
					<div class="col-xl-12">
					 <div class="card card-custom">
					  <div class="card-body">
						<h3>No Data Found</h3>
					  </div>
					  </div>
				
					</div>
				@endif
				
				
				
			
			</div>
			<div class="ht-80 bd d-flex align-items-center justify-content-end">
				<ul class="pagination pagination-basic pagination-primary mg-r-10">
					{{ $projectUrl['data']->appends(request()->except('page'))->render() }}
				</ul>
			</div>
	</div>
	<!--end::Container-->
</div>
<!--end::Entry-->
</div>
<!-- Start Remove Modal -->
<div id="success-modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Project Url Removal Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>
                  Are you sure you want remove this Project url with brand & secondary keywords?
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

$("body").on("click",".remove-projecturl",function(){
		var id = $(this).attr('data-id');
		var dataHref = $("#projecturl-delete-"+id).attr('data-href');
		$(".remove-activity").attr('href',dataHref);
	 });
</script>
@endsection
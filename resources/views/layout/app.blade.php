<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
	   <meta charset="utf-8" />
		<title>Login | Statuscrawl </title>
		<meta name="description" content="Login page example" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Custom Styles(used by this page)-->
		<link href="{{ url('public/admin')}}/assets/css/pages/login/login-1.css" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="{{ url('public/admin')}}/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{ url('public/admin')}}/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{ url('public/admin')}}/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		
		<link href="{{ url('public/admin')}}/assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="{{ url('public/admin')}}/assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="{{ url('public/admin')}}/assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
		<link href="{{ url('public/admin')}}/assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="{{ url('public/admin/assets/js/parsleyjs/parsley.css') }}">
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="" />
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			 @yield('content')
		</div>
		<!--end::Main-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="{{ url('public/admin')}}/assets/plugins/global/plugins.bundle.js"></script>
		<script src="{{ url('public/admin')}}/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="{{ url('public/admin')}}/assets/js/scripts.bundle.js"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="{{ url('public/admin')}}/assets/js/pages/custom/login/login-general.js"></script>
		<!--end::Page Scripts-->
		<script src="{{ url('public/admin/assets/js/parsleyjs/parsley.min.js') }}"></script>
		 <script src="{{ url('public/admin/assets/js/custom.js') }}"></script>
		@yield('script')
	</body>
	<!--end::Body-->
</html>
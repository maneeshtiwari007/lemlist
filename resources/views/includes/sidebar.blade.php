<div class="default-sidebar">
    <!-- Begin Side Navbar -->
    <nav class="side-navbar box-scroll sidebar-scroll">
        <!-- Begin Main Navigation -->
        <ul class="list-unstyled">
            
            <li class="{{ (Request::is('admin'))? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}"><i class="la la-columns"></i><span>Dashboard</span></a></li>
             @if(!empty(Auth::user()) && (Auth::user()->role_id !=2))
            <li class="{{Request::is('admin/subadmin*') ? 'active' : ''}}">
                <a href="#dropdown-staff" data-toggle="collapse" class="{{Request::is('admin/subadmin*') ? 'collapsed' : ''}}" aria-expanded="{{Request::is('admin/subadmin*') ? 'true' : 'false'}}"><i class="la la-user"></i><span>Admin Management</span></a>
                <ul class="collapse list-unstyled pt-0 {{Request::is('admin/subadmin*') ? 'show' : ''}}" id="dropdown-staff">
                    <li>
                        <a  class="{{Request::is('admin/subadmin') ? 'active' : ''}}" href="{{ url(route('admin.subadmin.index')) }}">List</a>
                    </li>
                    <li>
                        <a class="{{Request::is('admin/subadmin/add') ? 'active' : ''}}" href="{{ url(route('admin.subadmin.add')) }}">Add</a>
                    </li>
                </ul>
            </li>
			@endif
			 <li class="{{Request::is('admin/project*') ? 'active' : ''}}">
			   <a href="{{ url(route('admin.project.index')) }}"><i class="la la-tasks"></i><span>Projects</span></a>
			</li>
			<li class="{{Request::is('admin/job*') ? 'active' : ''}}">
			   <a href="{{ url(route('admin.job.index')) }}"><i class="la la-institution"></i><span>Jobs</span></a>
			</li>
        </ul>
        
        <!-- End Main Navigation -->
    </nav>
    <!-- End Side Navbar -->
</div>
<!-- End Left Sidebar -->
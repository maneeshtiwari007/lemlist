<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Project;
use App\Role;
use App\Job;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $auth = Auth::user();
		return view('admin.index',[
            'userCount'=>User::where('role_id',2)->count(),
			'projectCount'=>Project::count(),
			'jobCount'=>Job::count()
        ]);
    }

    public function subadmin(){
        return view('admin.subadmin.index');
    }

}

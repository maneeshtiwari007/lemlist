<?php

namespace App\Http\Controllers\subAdmin;

use App\User;
use App\Role;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $auth = Auth::guard('subadmin')->user();
		return view('adminusers.index',[
            'AdminCount'=>User::count()
        ]);
    }

    
}

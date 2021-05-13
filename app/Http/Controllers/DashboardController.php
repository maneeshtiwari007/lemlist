<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

   
class DashboardController extends Controller{
    public function index(){
		$arrContent = array();
        $auth = Auth::user();
		
		return view('index',[
            'userCount'=>User::where('role_id',2)->count()
        ]);
    }

    public function subadmin(){
        return view('admin.subadmin.index');
    }

}

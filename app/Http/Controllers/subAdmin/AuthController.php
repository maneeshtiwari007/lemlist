<?php

namespace App\Http\Controllers\subAdmin;

use App\User;
use App\Role;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
		$user = Auth::guard('subadmin')->user();
		if(empty($user)){
            return view('adminusers.auth.login');
        }else{
			 return redirect()->route('admin-user.dashboard');
		}
       
    
    }

    public function loginPost(Request $request){
        $req = $request->post();
        $user = User::where('email',$req['email'])->where('role_id',2)->get();
		if(!empty($user[0])){
			if(Auth::guard('subadmin')->attempt(array('email' => $req['email'], 'password' => $req['password'])))
            {
                return redirect()->route('admin-user.dashboard');

            }else{
                Session::flash('error', 'Password does not match!'); 
                return redirect()->route('admin-user.login');
            }
        } else {
		    Session::flash('error', 'User does not exists with this email'); 
            return redirect()->route('admin-user.login');
        }
    }

    public function logout(){
        Auth::guard('subadmin')->logout();
        return redirect(route('admin-user.login'));
    }
}

<?php

namespace App\Http\Controllers;

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
        $user = Auth::user();
		//echo "<pre>";var_dump($user);
        if(empty($user)){
            return view('auth.login');
        }else{
			return redirect()->route('dashboard');
		}
    }

    public function loginPost(Request $request){
        $req = $request->post();
		$user = User::where('email',$req['email'])->get();
		$remember_me = (!empty($req['remember']) && ($req['remember'] == 'on')) ? true : false; 
		if(!empty($user[0])){
            if(Auth::attempt(array('email' => $req['email'], 'password' => $req['password'])))
            {
				$user = User::where(["email" => $req['email']])->first();
                Auth::login($user, $remember_me);
                return redirect()->route('dashboard');

            } else{
                Session::flash('error', 'Password does not match!'); 
                return redirect()->route('login');
            }
        } else {
            Session::flash('error', 'User does not exists with this email'); 
            return redirect()->route('login');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect(route('login'));
    }
}

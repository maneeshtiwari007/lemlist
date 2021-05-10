<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

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
    public function forgotPost(Request $request){
        $post = $request->post();
        if(!empty($post['email'])){
            $user = User::where('email',$post['email'])->get();
            if(!empty($user[0])){
                $updateUser = User::find($user[0]->id);
                $updateUser->token = !empty($user[0]->token) ? $user[0]->token : Str::random(40);
                $updateUser->update();
                $getUser =  User::find($user[0]->id);
                $this->sendEmail($getUser, $getUser->token);
                return redirect()->route('login')->with('success', 'We have sent you the forgot password link on your mail.');


            }else{
                Session::flash('error', 'This email id not exists'); 
                return redirect()->route('login');  
            }

        }

    }
    public function forgotPassword(Request $request,$token){
        if(!empty($token)){
            $getObjUser = User::where('token',$token)->first();
            if(!empty($getObjUser)){
                return view('auth.forgot-password',[
                    'user'=>$getObjUser
                ]);
            }else{
                return view('error');
            }
        }

    }
    public function forgotPostPassword(Request $request,$token){
        if(!empty($token)){
           $user = User::where('token',$token)->first();
            if(!empty($user)){
                $data = $request->validate([
                    'password' => 'required'
                ]);
                $getUser = User::find($user->id);
                $getUser->password = Hash::make($data['password']);
                $getUser->update();
                Session::flash('success', 'Reset Password Successfully!Login your new password'); 
                return redirect(route('login'));  
            }else{
                Session::flash('error', 'Something wents wrong!'); 
                return redirect(route('login'));  

            }
        }

    }
    private function sendEmail($user, $code)
    {
        Mail::send('emails.forgot', ['user' => $user, 'code' => $code], function ($message) use ($user)
        {
            $message->to($user->email);
            $message->subject("Forgot Your Password");
        });
    }

}

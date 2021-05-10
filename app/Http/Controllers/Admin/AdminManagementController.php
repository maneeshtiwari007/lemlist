<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\User;
use App\Role;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminManagementController extends Controller
{
    protected $userRepositery;
    public function __construct(UserRepository $userRepositery)
    {
        $this->userRepositery = $userRepositery;
    }
    public function index(Request $resquest) {
        
        $users = $this->userRepositery->getAll();
        return view('admin.subadmin.index',[
                    'users'=>$users,
                    'roles'=>Role::all()
                    
                ]);
    }

    public function add(Request $request){
        $roles = Role::all();
        return view('admin.subadmin.add',[
            
            'roles'=>$roles
            
        ]);
    }

    public function addPost(Request $request) {

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,',
            'phone' => 'required|numeric',
            'password'=>'required',
            'role'    =>'required',
        ]);
        $newUser = new User();
        $newUser->name = $data['name'];
        $newUser->email = $data['email'];
        $newUser->phone = $data['phone'];
        $newUser->password = Hash::make($data['password']);
        $newUser->role_id = $data['role'];
        $newUser->status = 1;
       $newUser->save();
        
        Session::flash('success', 'User added successfully!'); 
        return redirect(route('admin.subadmin.index'));
    }
    

    public function getEdit(Request $request, $id){
        $users = User::with('roles')->where('id',$id)->first();
        $roles = Role::all();
        return view('admin.subadmin.edit',[
                    
                    'users'=>$users,
                    'roles'=>$roles
                ]);
    }

    public function postEdit(Request $request, $id){
        $updateUser = User::where('id',$id)->first();
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$updateUser->id,
            'phone' => 'required|numeric',
            'role'    =>'required',
        ]);
        $newUser= array(
        'name' => $data['name'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'role_id' => $data['role']
        );
        $updateUser->update($newUser);
        
        Session::flash('success', 'User Updated successfully!'); 
        return redirect(route('admin.staff.index'));
    }
    public function changePassword(Request $request, $id){
        $user = User::where('id',$id)->first();
        return view('admin.subadmin.change-password',[
            
            'user'=>$user
        ]);
    }
    public function changePasswordUpdate(Request $request, $id){
        $user = Auth::user()->where('id',$id)->first();

        $data = $request->validate([
            'current_password' => 'required',
            'password' => 'required|required_with:password_confirmation|string|confirmed',
        ]);
        if(Hash::check($data['current_password'],$user->password)){
            $arrUpdatePassword = array(
                'password'=>Hash::make($data['password'])
            );
            $user->update($arrUpdatePassword);
            Session::flash('success', 'Password updated successfully!'); 
            return redirect(route('admin.subadmin.index'));
        } else {
            Session::flash('error', 'Current password does not match!'); 
            return redirect()->back();
        }
    }    

    public function remove($id){
        if(!empty($id)){
            User::where('id',$id)->delete();
            Session::flash('success', 'User removed successfully!'); 
            return redirect(route('admin.subadmin.index'));  
        }
    }
}

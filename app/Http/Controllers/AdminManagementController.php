<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\ConfigureCrawler;
use DataTables;
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
		if((Auth::user()->role_id == 2)){
			   abort(403, 'Unauthorized action.');
        }else{
			$arrContent = array();
			$arrContent['title'] = "Users | Statuscrawl";
			$data = $this->userRepositery->getAll();
			$users = Auth::user();
			if ($resquest->ajax()) {
				$users = Auth::user();
				return Datatables::of($data)
						->addIndexColumn()
						->addColumn('action', function($row){
							$editPath = route('users.edit',['id'=>$row->id]);
							$edit = '<a href="'.$editPath.'" class="btn btn-sm btn-icon btn-light-success mr-2" title="Edit"><i class="la la-edit edit"></i></a>';
							$resetPath = route('users.reset-password',['id'=>$row->id]);
							$resetPassword = '<a href="'.$resetPath.'" class="btn btn-sm btn-icon btn-light-success mr-2" title="Reset Password"><i class="la la-lock reset-password"></i></a>';
							$configurePath = route('users.configure',['id'=>$row->id]);
							//$configure = '<a href="'.$configurePath.'" class="btn btn-sm btn-icon btn-light-success mr-2" title="Configure Crawler"><i class="la la-cog configure Crawler"></i></a>';
							$rPath = route('users.remove',['id'=>$row->id]);
							$remove = '<a href="javascript:;" class="btn btn-sm btn-icon btn-light-danger mr-2 remove-user" data-id="'.$row->id.'" data-href="'.$rPath.'" id="user-delete-'.$row->id.'" data-toggle="modal" data-target="#success-modal" title="Remove"><i class="la la-close delete"></i></a>';
							if($row->role_id !=1){
								$action = $edit.' '.$resetPassword.''.$remove;
							}else{
								$action = $edit.' '.$resetPassword.' ';
							}
							return $action;
						  })
						 ->rawColumns(['action'])
						->make(true);

			}
			return view('users.index',[
						'users'=>$users,
						'roles'=>Role::all(),
						'arrContent'=>$arrContent
						
					]);
			}
    }

    public function add(Request $request){
		if((Auth::user()->role_id ==2)){
			   abort(403, 'Unauthorized action.');
        }else{
			$arrContent = array();
			$arrContent['title'] = "Add New Users | Statuscrawl";
			$roles = Role::all();
			return view('users.add',[
				
				'roles'=>$roles,
				'arrContent'=>$arrContent
				
			]);
		}
    }

    public function addPost(Request $request) {
		if((Auth::user()->role_id ==2)){
			   abort(403, 'Unauthorized action.');
        }else{
			$post = $request->post();
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
			return redirect(route('users.index'));
		}
    }
    

    public function getEdit(Request $request, $id){
		if((Auth::user()->role_id ==2)){
			   abort(403, 'Unauthorized action.');
        }else{
			$arrContent = array();
			$arrContent['title'] = "Edit Users | Statuscrawl";
			$users = User::with('roles')->where('id',$id)->first();
			$roles = Role::all();
			return view('users.edit',[
						
						'users'=>$users,
						'roles'=>$roles,
						'arrContent'=>$arrContent
					]);
		}
    }

    public function postEdit(Request $request, $id){
		if((Auth::user()->role_id ==2)){
			   abort(403, 'Unauthorized action.');
        }else{
			$updateUser = User::where('id',$id)->first();
			$data = $request->validate([
				'name' => 'required',
				'phone' => 'required|numeric',
				'role'    =>'required',
			]);
			$newUser= array(
			'name' => $data['name'],
			'phone' => $data['phone'],
			'role_id' => $data['role']
			);
			$updateUser->update($newUser);
			
			Session::flash('success', 'User Updated successfully!'); 
			return redirect(route('users.index'));
		}
    }
    public function changePassword(Request $request, $id){
        $user = User::where('id',$id)->first();
        return view('users.change-password',[
            
            'user'=>$user
        ]);
    }
    public function changePasswordUpdate(Request $request, $id){
        $user = Auth::user()->where('id',$id)->first();
		if(!empty($user)){
			$data = $request->validate([
				'password' => 'required'
			]);
			$getUser = User::find($id);
			$getUser->password = Hash::make($data['password']);
			$getUser->update();
			Session::flash('success', 'Password changed successfully! Please login with new password'); 
			Auth::logout();
            return redirect(route('login'));
		}
        
    }    

    public function remove($id){
		if((Auth::user()->role_id ==2)){
			   abort(403, 'Unauthorized action.');
        }else{
        if(!empty($id)){
            User::where('id',$id)->delete();
            Session::flash('success', 'User removed successfully!'); 
            return redirect(route('users.index'));  
        }
		}
    }
	public function changeProfile(Request $request, $id){
		$users = User::where('id',$id)->first();
        return view('users.change-profile',[
            
            'users'=>$users
        ]);
	}
	public function changeProfileUpdate(Request $request, $id){
		 $user = Auth::user()->where('id',$id)->first();
		if(!empty($user)){
			$data = $request->validate([
				'name' => 'required',
				'phone' => 'required|numeric',
			]);
			$getUser = User::find($id);
			if (!empty($request->hasFile('profile_avatar')))
            {
                $request->validate(['profile_avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480', ]);
                $image = $request->file('profile_avatar');
                $timestamp = time();
                $name = $timestamp . '-' . $image->getClientOriginalName();
                $destinationPath = public_path('/uploads/user/image');
                $imagePath = $destinationPath . "/" . $name;
                $image->move($destinationPath, $name);
                $profile_image = url('public/uploads/user/image') . '/' . $name;
                $getUser->update(['image' => $profile_image]);
            }
			$getUser->name = $data['name'];
			$getUser->phone = $data['phone'];
			$getUser->update();
			Session::flash('success', 'Profile updated successfully!'); 
			return redirect(route('dashboard'));
		}
	}
	public function resetPassword(Request $request, $id){
        $user = User::where('id',$id)->first();
        return view('users.reset-password',[
            'user'=>$user
        ]);
    }
    public function resetPasswordUpdate(Request $request, $id){
        $user = Auth::user()->where('id',$id)->first();
		if(!empty($user)){
			$data = $request->validate([
				'password' => 'required'
			]);
			$getUser = User::find($id);
			$getUser->password = Hash::make($data['password']);
			$getUser->update();
			Session::flash('success', 'Reset Password Successfully!'); 
			return redirect(route('users.index'));  
		}else{
			Session::flash('erroe', 'Something wents wrong!'); 
			return redirect(route('users.index'));

		}
        
    }
	public function configureUser(Request $request, $id){
		$user = User::where('id',$id)->first();
		$getConfigureCrawler = ConfigureCrawler::where('id',$id)->first();
        return view('users.configure',[
            'user'=>$user,
			'getConfigureCrawler'=>$getConfigureCrawler
        ]);
	}
	public function configureUserUpdate(Request $request, $id){
		$user = Auth::user();
        $post = $request->post();
		//echo "<pre>";var_dump($post);exit;
		$arrDataPost = array();
        $arrDataPost = array('grant_type'=>'password','username'=> $post['email'],'password'=>$post['password']);
        $varUrl = "https://www.cloudcrawler.io/api/v1/oauth/token";
		$command = 'curl -X POST -F grant_type=password -F username='.$post['email'].' -F password='.$post['password'].' '.$varUrl.'';
		$output = exec($command);
		$jsonData = json_decode($output);
		 if(!empty($jsonData)){
			if(!empty($jsonData->access_token)){
				if(empty($post['hid_config_id'])){
					$arrData = array();
					$arrData['username']=$post['email'];
					$arrData['password']=$post['password'];
					$arrData['user_id']=$id;
					$arrData['access_token']=$jsonData->access_token;
					$arrData['expires_in']==$jsonData->expires_in;
					$arrData['token_type']==$jsonData->token_type;
					$arrData['created_at_token']==$jsonData->created_at;
					$newConfigureCrawler = new ConfigureCrawler($arrData);
					$newConfigureCrawler->save();
					session::flash('success', 'Successfully Submitted!'); 
				    return redirect(route('users.index'));  
				}else{
					$arrUpdateData = array();
					$arrUpdateData['username']=$post['email'];
					$arrUpdateData['password']=$post['password'];
					
					$updateConfigureCrawler = ConfigureCrawler::find($post['hid_config_id']);
					$updateConfigureCrawler->user_id=$id;
					$updateConfigureCrawler->access_token=$jsonData->access_token;
					$updateConfigureCrawler->expires_in=$jsonData->expires_in;
					$updateConfigureCrawler->token_type=$jsonData->token_type;
					$updateConfigureCrawler->created_at_token=$jsonData->created_at;
					$updateConfigureCrawler->update();
					session::flash('success', 'Update Successfully!'); 
				    return redirect(route('users.index')); 
				}

			}else{
				session::flash('error', 'Username and Password should be of cloudcrawler.io'); 
				return redirect(route('users.configure',['id'=>$id])); 
			}
		 }else{
			 session::flash('error', 'Username and Password should be of cloudcrawler.io'); 
			 return redirect(route('users.configure',['id'=>$id])); 
		 }
	}
}

<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;
use App\Role;
use App\Job;
use App\Repositories\JobRepository;
use App\Repositories\ProjectRepository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

   
class DashboardController extends Controller
 
{
	protected $projectRepositery;
	protected $jobRepositery;
    public function __construct(JobRepository $jobRepositery,ProjectRepository $projectRepositery)
    {
		$this->projectRepositery = $projectRepositery;
        $this->jobRepositery = $jobRepositery;
    }
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

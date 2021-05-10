<?php

namespace App\Http\Controllers\subAdmin;

use App\Repositories\JobRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class JobController extends Controller
{
	protected $projectRepositery;
	protected $jobRepositery;
    public function __construct(JobRepository $jobRepositery,ProjectRepository $projectRepositery)
    {
		$this->projectRepositery = $projectRepositery;
        $this->jobRepositery = $jobRepositery;
    }
    public function index(Request $req){
		$projects = $this->projectRepositery->getAllProject();
		return view('adminusers.jobs.index',[
                    'projects'=>$projects,
                    ]);
    }
	public function add(Request $request){
		$arrData = array();
		$projects = $this->projectRepositery->getAllProject();
		$arrData['projects'] = $projects;
		echo "<pre>";var_dump($projects);exit;
        return view('adminusers.jobs.add',$arrData);
    }
	 
	
}

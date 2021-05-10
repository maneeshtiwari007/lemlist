<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\JobRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use App\Job;
use DataTables;


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
		$user = Auth::user();
		if ($req->ajax()) {
			$user = Auth::user();
			$data = $this->jobRepositery->getAll();
			return Datatables::of($data)
                    ->addIndexColumn()
					->addColumn('action', function($row){
						$editPath = route('admin.job.edit',['id'=>$row->id]);
						$viewPath = route('admin.job.view',['id'=>$row->id]);
						$edit = '<a href="'.$editPath.'"><i class="la la-edit edit"></i></a>';
						$view = '<a href="'.$viewPath.'"><i class="la la-eye view"></i></a>';
						$rPath = route('admin.job.remove',['id'=>$row->id]);
						$remove = '<a class="remove-job" data-id="'.$row->id.'" data-href="'.$rPath.'" data-toggle="modal" data-target="#success-modal" id="job-delete-'.$row->id.'"><i class="la la-close delete"></i></a>';
						$action = $edit.' '.$view.' '.$remove;
						return $action;
                      })
					  ->addColumn('count', function($row){
						   return $row->jobDetails->count();
                      })
					  ->rawColumns(['action'])
                    ->make(true);

        }
		return view('admin.jobs.index');
    }
	public function add(Request $request){
		$arrData = array();
		$user = Auth::user();
		$projects = $this->projectRepositery->getAllProject();
		$arrData['projects'] = $projects;
		//echo "<pre>";var_dump($arrData['projects']['data']);exit;
        return view('admin.jobs.add',$arrData);
    }
	public function addPost(Request $request){
		$user = Auth::user();
		$userId = $user->id;
		$arrData = array();
		$post = $request->post();
		//echo "<pre>";var_dump($post);exit;
		$addJob = $this->jobRepositery->addJob($post,$userId);
		session::flash('success', 'Job Added Successfuly!'); 
		return redirect(route('admin.job.index'));
		
	}
	public function getProjectUrlList(Request $request){
		$user = Auth::user();
		$arrData = array();
        if ($request->ajax() && $request->method() == "POST")
        {
            $input = $request->input();
            $input = json_decode($input['data']);
			$projectId = $input->dataval;
			$jobId = $input->hid_job_id;
			if(!empty($jobId)){
				$getJobProjectUrl = $this->jobRepositery->getJobProjectUrlData($jobId);
				$projectUrl = array();
				$jobIdDetails = array();
				if(!empty($getJobProjectUrl[0])){
					foreach($getJobProjectUrl as $projectUrlData){
						$projectUrl[] = $projectUrlData->project_url_id;
						$jobIdDetails[] = $projectUrlData->job_id;
					}
				}
				$arrData['jobId'] = $jobId;
				
			}
			$getProjectUrl = $this->projectRepositery->getProjectUrlAllData($projectId);
			$arrData['projectUrlId'] = !empty($projectUrl) ? $projectUrl : [];
			$arrData['jobIdDetails'] = !empty($jobIdDetails) ? $jobIdDetails : [];
			//echo "<pre>";var_dump($arrData['projectUrlId']);exit;
			$arrData['getProjectUrl'] = $getProjectUrl;
			$arrResponseData = View::make('admin.jobs.view-projecturl', $arrData);
            return response()->json(array(
                'status' => 200,
                'result' => $arrResponseData->render()
            ));
        }
	}
	public function getEdit(Request $request,$id){
		$arrData = array();
		$editJobs = $this->jobRepositery->getEditJob($id);
		$projects = $this->projectRepositery->getAllProject();
		$arrData['projects'] = $projects;
		$arrData['editJobs'] = $editJobs;
		return view('admin.jobs.edit',$arrData);
	}
	public function postEdit(Request $request,$id){
	 $user = Auth::user();
	 $userId = $user->id;
	 $post = $request->post();
	 $editJobPostData = $this->jobRepositery->editJob($post,$userId,$id);
	 session::flash('success', 'Job Updated Successfuly!'); 
	 return redirect(route('admin.job.index'));
	}
	public function getProjectUrlListData(Request $request){
		$user = Auth::user();
		$arrData = array();
        if ($request->ajax() && $request->method() == "POST")
        {
            $input = $request->input();
            $input = json_decode($input['data']);
			$inputValue = $input->inputValue;
			$arrData['inputValue'] = $inputValue;
			$arrResponseData = View::make('admin.jobs.view-projecturldata', $arrData);
            return response()->json(array(
                'status' => 200,
                'result' => $arrResponseData->render()
            ));
        }
	}
	public function remove($id){
		if(!empty($id)){
			$user = Auth::user();
			$this->jobRepositery->removeJob($id);
			session::flash('success', 'Job Deleted successfully!'); 
	        return redirect(route('admin.job.index'));
		}
	}
	public function getView(Request $request,$id){
		if(!empty($id)){
			$arrData = array();
			$getJobs = $this->jobRepositery->getEditJob($id);
			$projects = $this->projectRepositery->getAllProject();
			$arrData['projects'] = $projects;
			$arrData['getJobs'] = $getJobs;
			return view('admin.jobs.view',$arrData);
		}
	}
	 
	
}

<?php

namespace App\Http\Controllers;

use App\Repositories\JobRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use App\Job;
use DataTables;
use Rap2hpoutre\FastExcel\FastExcel;



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
		$arrData = array();
		$arrData['arrContent']['title'] = "Jobs | Statuscrawl";
		$get = $req->input();
        $arrData['get'] = $get;
		$arrData['getProjects'] = $this->projectRepositery->getAllProject();
		if ($req->ajax()) {
			$data = $this->jobRepositery->getAll();
			return Datatables::of($data)
                    ->addIndexColumn()
					->addColumn('action', function($row){
						$editPath = route('jobs.edit',['id'=>$row->id]);
						$viewPath = route('jobs.view',['id'=>$row->id]);
						$downloadPath = route('jobs.csv.download',['id'=>$row->id]);
						$submitCrawlerPath = route('api.v1.get-crawler',['id'=>$row->id]);
						$edit = '<a href="'.$editPath.'" class="btn btn-sm btn-icon btn-light-success mr-2" title="Edit"><i class="la la-edit edit"></i></a>';
						$view = '<a href="'.$viewPath.'" class="btn btn-sm btn-icon btn-light-success mr-2" title="View"><i class="la la-eye view"></i></a>';
						$csvDownload = '<a href="'.$downloadPath.'" class="btn btn-sm btn-icon btn-light-success mr-2" title="Download CSV"><i class="la la-download  download"></i></a>';
						$rPath = route('jobs.remove',['id'=>$row->id]);
						$remove = '<a href="javascript:;" class="btn btn-sm btn-icon btn-light-danger mr-2 remove-job" data-id="'.$row->id.'" data-href="'.$rPath.'" data-toggle="modal" data-target="#success-modal" id="job-delete-'.$row->id.'" title="Remove"><i class="la la-close delete"></i></a>';
						$submitCrawler= '<a href="'.$submitCrawlerPath.'" class="btn btn-sm btn-icon btn-light-success mr-2" title="Submit crawler"><i class="la la-download  submit"></i></a>';
						$checkUserRole = $this->checkUserRole($row->created_by_user);
						if(!empty($checkUserRole) && ($checkUserRole == 'success')){
						    $action = $edit.' '.$view.' '.' '.$csvDownload.' '.$remove;
						}else{
							$action = $view;
						}
						return $action;
                      })
					  ->addColumn('count', function($row){
						   return $row->jobDetails->count();
                      })
					  ->rawColumns(['action'])
                    ->make(true);

        }
		//echo "<pre>";var_dump($arrData['getProjects']);exit;
		return view('jobs.index',$arrData);
    }
	
	public function add(Request $request){
		$arrData = array();
		$arrData['arrContent']['title'] = "Add Job | Statuscrawl";
		$user = Auth::user();
		$projects = $this->projectRepositery->getAllProject();
		$arrData['projects'] = $projects;
		//echo "<pre>";var_dump($arrData['projects']['data']);exit;
        return view('jobs.add',$arrData);
    }
	public function addPost(Request $request){
		$user = Auth::user();
		$userId = $user->id;
		$arrData = array();
		$post = $request->post();
		//echo "<pre>";var_dump($post);exit;
		$addJob = $this->jobRepositery->addJob($post,$userId);
		session::flash('success', 'Job Added Successfuly!'); 
		return redirect(route('jobs.index'));
		
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
			$arrResponseData = View::make('jobs.view-projecturl', $arrData);
            return response()->json(array(
                'status' => 200,
                'result' => $arrResponseData->render()
            ));
        }
	}
	public function getEdit(Request $request,$id){
		$arrData = array();
		$arrData['arrContent']['title'] = "Edit Job | Statuscrawl";
		$editJobs = $this->jobRepositery->getEditJob($id);
		$projects = $this->projectRepositery->getAllProject();
		$arrData['projects'] = $projects;
		$arrData['editJobs'] = $editJobs;
		return view('jobs.edit',$arrData);
	}
	public function postEdit(Request $request,$id){
	 $user = Auth::user();
	 $userId = $user->id;
	 $post = $request->post();
	 $editJobPostData = $this->jobRepositery->editJob($post,$userId,$id);
	 session::flash('success', 'Job Updated Successfuly!'); 
	 return redirect(route('jobs.index'));
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
			$arrResponseData = View::make('jobs.view-projecturldata', $arrData);
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
	        return redirect(route('jobs.index'));
		}
	}
	public function getView(Request $request,$id){
		if(!empty($id)){
			$arrData = array();
			$user = Auth::user();
			$arrData['user'] = $user;
			$arrData['arrContent']['title'] = "View Job | Statuscrawl";
			$getJobs = $this->jobRepositery->getEditJob($id);
			$projects = $this->projectRepositery->getAllProject();
			$arrData['projects'] = $projects;
			$arrData['getJobs'] = $getJobs;
			return view('jobs.view',$arrData);
		}
	}
	public function getCsvDownload(Request $request,$id){
		if(!empty($id)){
			$arrData = array();
			$user = Auth::user();
			$arrData['user'] = $user;
			$data = $this->jobRepositery->exportJobs($id);
            return response()->download($data);
			
		}
		
	}
	
	public function checkUserRole($userId){
		$user = Auth::user();
		if(($userId == $user->id) || ($user->role_id ==1)){
			$message = "success";
	    }else{
			$message = "error";
		}
		return $message;
		
	}
	 
	
}

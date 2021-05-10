<?php

namespace App\Http\Controllers;

use App\Repositories\ProjectRepository;
use App\Repositories\JobRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use App\ProjectUrl;
use View;

class ProjectController extends Controller
{
	protected $projectRepositery;
	protected $jobRepositery;
    public function __construct(ProjectRepository $projectRepositery, JobRepository $jobRepositery)
    {
        $this->projectRepositery = $projectRepositery;
		 $this->jobRepositery = $jobRepositery;
    }
    public function index(Request $req){
		$arrContent = array();
		$arrContent['title'] = "Projects | Cloud Crawler";
		$user = Auth::user();
		$projects = $this->projectRepositery->getAll();
		//echo "<pre>";var_dump($projects);exit;
		return view('projects.index',[
                    'projects'=>$projects,
					'user'=>$user,
					'arrContent'=>$arrContent
                    ]);
    }
	 
	public function add(Request $request){
		$arrData = array();
		$arrData['arrContent'] = array();
		$arrData['arrContent']['title'] = "Add New Project | Cloud Crawler";
        return view('projects.add',$arrData);
    }
	public function addPost(Request $request) {
     $user = Auth::user();
	 $userId = $user->id;
	 $post = $request->post();
	 $data = $request->validate([
            'project_name' => 'required',
			'description' => 'required'
        ]);
		$this->projectRepositery->addProject($post,$userId);
         session::flash('success', 'Project added successfully!'); 
        return redirect(route('projects.index'));
    }
	public function getEdit(Request $request, $id){
		$arrData = array();
		$arrData['arrContent'] = array();
		$arrData['arrContent']['title'] = "Edit Project | Cloud Crawler";
		$editProjects = $this->projectRepositery->getEditProject($id);
		$arrData['editProjects'] = $editProjects;
	    //echo "<pre>";var_dump($url);exit;
        return view('projects.edit',$arrData);
    }
	public function postEdit(Request $request, $id){
	 $user = Auth::user();
	 $userId = $user->id;
	 $post = $request->post();
	 $data = $request->validate([
            'project_name' => 'required',
			'description' => 'required'
        ]);
	 $this->projectRepositery->editProject($post,$userId,$id);
	 session::flash('success', 'Project Updated successfully!'); 
	 return redirect(route('projects.index'));
	}
	public function getProjectView(Request $request, $id){
		$arrData = array();
		$arrData['arrContent'] = array();
		$arrData['arrContent']['title'] = "Project Url | Cloud Crawler";
		$user = Auth::user();
		$getProjects = $this->projectRepositery->getEditProject($id);
		$arrData['getProjects'] = $getProjects;
		$arrData['user'] = $user;
	    //echo "<pre>";var_dump($arrData['getProjects']);exit;
        return view('projects.view',$arrData);
	}
	public function remove($id){
		if(!empty($id)){
			$user = Auth::user();
			$this->projectRepositery->removeProject($id);
			session::flash('success', 'Project Deleted successfully!'); 
	        return redirect(route('projects.index'));
		}
	}
	public function getProjectUrl($id){
		if(!empty($id)){
			$arrContent = array();
		    $arrContent['title'] = "Projects Url | Cloud Crawler";
			$user = Auth::user();
			$projectUrl = $this->projectRepositery->getProjectUrl($id);
			return view('projects.projecturl.index',[
                    'projectUrl'=>$projectUrl,
					'id'=>$id,
					'user'=>$user,
					'arrContent'=>$arrContent
                    ]);
			
		}
	}
	public function addkeyword(Request $request,$id){
		if(!empty($id)){
			$arrContent = array();
		    $arrContent['title'] = "Projects Url Keyword | Cloud Crawler";
			$projectUrlData = $this->projectRepositery->getProjectUrlById($id);
			$projectUrlBrandKeywordData = $this->projectRepositery->getProjectUrlBrandKeyword($id);
			$projectUrlSecondaryKeywordData = $this->projectRepositery->getProjectUrlSecondaryKeyword($id);
			//echo "<pre>";var_dump($projectUrlBrandKeywordData);exit;
			return view('projects.projecturl.keyword.add',[
                    'projectUrlData'=>$projectUrlData,
					'projectUrlBrandKeywordData'=>$projectUrlBrandKeywordData,
					'projectUrlSecondaryKeywordData'=>$projectUrlSecondaryKeywordData,
					'id'=>$id,
					'arrContent'=>$arrContent
                    ]);
		}
	}
	public function addKeywordPost(Request $request){
		$post = $request->post();
		$user = Auth::user();
		$userId = $user->id;
		//echo "<pre>";var_dump($post);exit;
		$getProjectUrlData = $this->projectRepositery->getProjectUrlById($post['hid_url_id']);
		$this->projectRepositery->addProjectUrlBrandSecondaryKeyword($post,$userId,$getProjectUrlData->project_id);
        session::flash('success', 'Project Url Brand & Secondary Keyword added successfully!'); 
        return redirect(route('projects.viewurl',['id'=>$getProjectUrlData->project_id]));
	}
	public function removeUrlKeyword(Request $request,$id){
		if(!empty($id)){
			$user = Auth::user();
			$getProjectUrlData = $this->projectRepositery->getProjectUrlById($id);
			$this->projectRepositery->removeProjectUrl($id);
			session::flash('success', 'Project Url Deleted successfully!'); 
	        return redirect(route('projects.viewurl',['id'=>$getProjectUrlData->project_id]));
		}
	}
	public function managekeyword(Request $request,$id){
		if(!empty($id)){
			$arrContent = array();
		    $arrContent['title'] = "Projects Url Keyword | Cloud Crawler";
			$projectUrlData = $this->projectRepositery->getProjectUrlById($id);
			$projectUrlBrandKeywordData = $this->projectRepositery->getProjectUrlBrandKeyword($id);
			$projectUrlSecondaryKeywordData = $this->projectRepositery->getProjectUrlSecondaryKeyword($id);
			//echo "<pre>";var_dump($projectUrlBrandKeywordData);exit;
			return view('projects.projecturl.keyword.manage',[
                    'projectUrlData'=>$projectUrlData,
					'projectUrlBrandKeywordData'=>$projectUrlBrandKeywordData,
					'projectUrlSecondaryKeywordData'=>$projectUrlSecondaryKeywordData,
					'id'=>$id,
					'arrContent'=>$arrContent
                    ]);
		}
	}
	public function manageKeywordPost(Request $request){
		$post = $request->post();
		$user = Auth::user();
		$userId = $user->id;
		//echo "<pre>";var_dump($post);exit;
		$getProjectUrlData = $this->projectRepositery->getProjectUrlById($post['hid_url_id']);
		$this->projectRepositery->addProjectUrlBrandSecondaryKeyword($post,$userId,$getProjectUrlData->project_id);
        session::flash('success', 'Project Url Brand & Secondary Keyword added successfully!'); 
        return redirect(route('projects.view',['id'=>$getProjectUrlData->project_id]));
	}
	public function getJobEdit(Request $request,$id){
		$arrData = array();
		$arrData['arrContent']['title'] = "Edit Job | Cloud Crawler";
		$editJobs = $this->jobRepositery->getEditJob($id);
		$projects = $this->projectRepositery->getAllProject();
		$arrData['projects'] = $projects;
		$arrData['editJobs'] = $editJobs;
		return view('projects.jobs.edit',$arrData);
	}
	public function jobPostEdit(Request $request,$id){
	 $user = Auth::user();
	 $userId = $user->id;
	 $post = $request->post();
	 $getJob = $this->jobRepositery->getEditJob($id);
	 $editJobPostData = $this->jobRepositery->editJob($post,$userId,$id);
	 session::flash('success', 'Job Updated Successfuly!'); 
	 return redirect(route('projects.view',['id'=>$getJob->project_id]));
	}
	public function getJobView(Request $request,$id){
		if(!empty($id)){
			$arrData = array();
			$user = Auth::user();
			$arrData['user'] = $user;
			$arrData['arrContent']['title'] = "View Job | Cloud Crawler";
			$getJobs = $this->jobRepositery->getEditJob($id);
			$projects = $this->projectRepositery->getAllProject();
			$getPostJobCrawler = $this->jobRepositery->getPostJobCrawler($id);
			$arrData['getPostJobCrawler'] = $getPostJobCrawler;
			$arrData['projects'] = $projects;
			$arrData['getJobs'] = $getJobs;
			return view('projects.jobs.view',$arrData);
		}
	}
	public function getJobCsvDownload(Request $request,$id){
		if(!empty($id)){
			$arrData = array();
			$user = Auth::user();
			$arrData['user'] = $user;
			$data = $this->jobRepositery->exportJobs($id);
            return response()->download($data);
			
		}
		
	}
	public function getProjectUrlBrandKeywordList(Request $request){
		$user = Auth::user();
		$arrData = array();
        if ($request->ajax() && $request->method() == "POST")
        {
            $input = $request->input();
            $input = json_decode($input['data']);
			$inputProjectUrlId = $input->projectUrlId;
			$arrData['proUrl'] = $inputProjectUrlId;
			$projectUrlBrandKeywordData = $this->projectRepositery->getProjectUrlBrandKeyword($inputProjectUrlId);
			$arrData['projectUrlBrandKeywordData'] = $projectUrlBrandKeywordData;
			$arrResponseData = View::make('projects.view-projecturl-brand-keyword', $arrData);
            return response()->json(array(
                'status' => 200,
                'result' => $arrResponseData->render()
            ));
        }
	}
	public function getProjectUrlSecondaryKeywordList(Request $request){
		$user = Auth::user();
		$arrData = array();
        if ($request->ajax() && $request->method() == "POST")
        {
            $input = $request->input();
            $input = json_decode($input['data']);
			$inputProjectUrlId = $input->projectUrlId;
			$arrData['proUrl'] = $inputProjectUrlId;
			$projectUrlSecondaryKeywordData = $this->projectRepositery->getProjectUrlSecondaryKeyword($inputProjectUrlId);
			$arrData['projectUrlSecondaryKeywordData'] = $projectUrlSecondaryKeywordData;
			$arrResponseData = View::make('projects.view-projecturl-secondary-keyword', $arrData);
            return response()->json(array(
                'status' => 200,
                'result' => $arrResponseData->render()
            ));
        }
	}
}

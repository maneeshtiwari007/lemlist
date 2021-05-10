<?php

namespace App\Http\Controllers\subAdmin;

use App\Repositories\ProjectRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use App\ProjectUrl;

class ProjectController extends Controller
{
	protected $projectRepositery;
    public function __construct(ProjectRepository $projectRepositery)
    {
        $this->projectRepositery = $projectRepositery;
    }
    public function index(Request $req){
		$user = Auth::user();
		$projects = $this->projectRepositery->getAll();
		//echo "<pre>";var_dump($projects);exit;
		return view('admin.project.index',[
                    'projects'=>$projects,
					'user'=>$user
                    ]);
    }
	 
	public function add(Request $request){
		$arrData = array();
        return view('admin.project.add',$arrData);
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
        return redirect(route('admin.project.index'));
    }
	public function getEdit(Request $request, $id){
		$arrData = array();
		$editProjects = $this->projectRepositery->getEditProject($id);
		$arrData['editProjects'] = $editProjects;
	    //echo "<pre>";var_dump($url);exit;
        return view('admin.project.edit',$arrData);
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
	 return redirect(route('admin.project.index'));
	}
	public function getProjectView(Request $request, $id){
		$user = Auth::user();
		$getProjects = $this->projectRepositery->getEditProject($id);
		$arrData['getProjects'] = $getProjects;
	    //echo "<pre>";var_dump($arrData['getProjects']);exit;
        return view('admin.project.view',$arrData);
	}
	public function remove($id){
		if(!empty($id)){
			$user = Auth::user();
			$this->projectRepositery->removeProject($id);
			session::flash('success', 'Project Deleted successfully!'); 
	        return redirect(route('admin-user.project.index'));
		}
	}
	public function getProjectUrl($id){
		if(!empty($id)){
			$projectUrl = $this->projectRepositery->getProjectUrl($id);
			return view('admin.project.projecturl.index',[
                    'projectUrl'=>$projectUrl,
					'id'=>$id
                    ]);
			
		}
	}
	public function addkeyword(Request $request,$id){
		if(!empty($id)){
			$projectUrlData = $this->projectRepositery->getProjectUrlById($id);
			$projectUrlBrandKeywordData = $this->projectRepositery->getProjectUrlBrandKeyword($id);
			$projectUrlSecondaryKeywordData = $this->projectRepositery->getProjectUrlSecondaryKeyword($id);
			//echo "<pre>";var_dump($projectUrlBrandKeywordData);exit;
			return view('admin.project.projecturl.keyword.add',[
                    'projectUrlData'=>$projectUrlData,
					'projectUrlBrandKeywordData'=>$projectUrlBrandKeywordData,
					'projectUrlSecondaryKeywordData'=>$projectUrlSecondaryKeywordData,
					'id'=>$id
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
        return redirect(route('admin.project.viewurl',['id'=>$getProjectUrlData->project_id]));
	}
	public function removeUrlKeyword(Request $request,$id){
		if(!empty($id)){
			$user = Auth::user();
			$getProjectUrlData = $this->projectRepositery->getProjectUrlById($id);
			$this->projectRepositery->removeProjectUrl($id);
			session::flash('success', 'Project Url Deleted successfully!'); 
	        return redirect(route('admin.project.viewurl',['id'=>$getProjectUrlData->project_id]));
		}
	}
}

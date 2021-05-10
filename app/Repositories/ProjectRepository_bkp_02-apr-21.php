<?php

namespace App\Repositories;

use App\Project;
use App\ProjectUrl;
use App\ProjectExactKeyword;
use App\ProjectPartialKeyword;
use App\ProjectUrlBrandKeyword;
use App\ProjectUrlSecondaryKeyword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class ProjectRepository extends BaseRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Project::class;
    }

    public function getAll($extraParams = array()){
        $projects = $this->_model->with('projecturls');
		return array('total'=>$projects->count(),'data'=>$projects->orderBy('id','desc')->paginate(12));
    }
    public function genrateProjectResponseCollection($project){
        $inc = 1;
        $data = array();
		if(!empty($project)){
            foreach($project as $pro){
                $editPath = route('admin.subadmin.edit',['id'=>$pro->id]);
                $edit = '<a href="'.$editPath.'"><i class="la la-edit edit"></i></a>';
                $rPath = route('admin.subadmin.remove',['id'=>$pro->id]);
                $remove = '<a href="'.$rPath.'"><i class="la la-close delete"></i></a>';
                //$status =<span style="width:100px;"><span class="badge-text badge-text-small info">Paid</span></span>
                $data[]= array(
                    'inc'=>$inc++,
                    'name'=>$pro->name,
                    'description'=>$pro->name,
                    'action'=>$edit.' '.$remove
                );
               
            }
        }
        return $data;
    }
	 public function getAllProject($extraParams = array()){
         $projects = $this->_model->with('projecturls');
		 return array('total'=>$projects->count(),'data'=>$projects->orderBy('id','desc')->get());
		
    }
	public function addProject($data = array(),$userId){
		    //echo "<pre>";;var_dump($data);exit;
			$projectSlug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($data['project_name']));
		    $newProject = new Project();
			$newProject->user_id = $userId;
			$newProject->name = $data['project_name'];
			$newProject->description = $data['description'];
			$newProject->project_slug = $projectSlug;
			$newProject->status = 1;
		    $newProject->save();
			if(!empty($data['url_name'])){
				for($i=0;$i<count($data['url_name']);$i++){
					if(!empty($data['url_name'][$i])){
						$newprojectUrl = new ProjectUrl();
						$newprojectUrl->project_id = $newProject->id;
						$newprojectUrl->user_id = $userId;
						$newprojectUrl->url_name = $data['url_name'][$i];
						$newprojectUrl->save();
						if(!empty($data['brand_keyword'][$i])){
								for($l=0;$l<count($data['brand_keyword'][$i]);$l++){
									if(!empty($data['brand_keyword'][$i][$l])){
										$newprojectBrandKeyword = new ProjectUrlBrandKeyword();
										$newprojectBrandKeyword->project_id = $newProject->id;
										$newprojectBrandKeyword->user_id = $userId;
										$newprojectBrandKeyword->project_url_id = $newprojectUrl->id;
										$newprojectBrandKeyword->brand_keyword = $data['brand_keyword'][$i][$l];
										$newprojectBrandKeyword->save();
									}
									
								}
							}
							if(!empty($data['secondary_keyword'][$i])){
								for($m=0;$m<count($data['secondary_keyword'][$i]);$m++){
									if(!empty($data['secondary_keyword'][$i][$m])){
										$newprojectSecondaryKeyword = new ProjectUrlSecondaryKeyword();
										$newprojectSecondaryKeyword->project_id = $newProject->id;
										$newprojectSecondaryKeyword->user_id = $userId;
										$newprojectSecondaryKeyword->project_url_id = $newprojectUrl->id;
										$newprojectSecondaryKeyword->secondary_keyword = $data['secondary_keyword'][$i][$m];
										$newprojectSecondaryKeyword->save();
									}
									
								}
							}
						
					}
					
				}
			}
			if(!empty($data['exact_keyword'])){
				for($j=0;$j<count($data['exact_keyword']);$j++){
					if(!empty($data['exact_keyword'][$j])){
						$newprojectExactKeyword = new ProjectExactKeyword();
						$newprojectExactKeyword->project_id = $newProject->id;
						$newprojectExactKeyword->user_id = $userId;
						$newprojectExactKeyword->exact_keywords = $data['exact_keyword'][$j];
						$newprojectExactKeyword->save();
					}
					
				}
			}
			if(!empty($data['partial_keyword'])){
				for($k=0;$k<count($data['partial_keyword']);$k++){
					if(!empty($data['partial_keyword'][$k])){
						$newprojectPartialKeyword = new ProjectPartialKeyword();
						$newprojectPartialKeyword->project_id = $newProject->id;
						$newprojectPartialKeyword->user_id = $userId;
						$newprojectPartialKeyword->partial_keywords = $data['partial_keyword'][$k];
						$newprojectPartialKeyword->save();
					}
					
				}
			}
			
	}
	public function getEditProject($id){
		$editProjectData = Project::where('id',$id)->first();
		return $editProjectData;
	}
	public function editProject($data = array(),$userId,$projectId){
		    $user = Auth::user();
		    $projectSlug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($data['project_name']));
		    $newProject = Project::find($projectId);
			$newProject->user_id = $userId;
			$newProject->name = $data['project_name'];
			$newProject->description = $data['description'];
			$newProject->project_slug = $projectSlug;
			if(!empty($user) && ($user->role_id ==1)){
				$newProject->updated_by = $user->id;
			}else{
				$newProject->updated_by = 0;
			}
			$newProject->status = 1;
		    $newProject->update();
			if(!empty($data['old_url_name'])){
				//$removeUrl = ProjectUrl::where('project_id', $projectId);
				//$removeUrl->delete();
				for($k=0;$k<count($data['old_url_name']);$k++){
					if(!empty($data['old_url_name'][$k])){
						$newprojectUrlUpdate =ProjectUrl::find($data['old_url_id'][$k]);
						$newprojectUrlUpdate->url_name = $data['old_url_name'][$k];
						$newprojectUrlUpdate->save();
						if(!empty($data['brand_keyword'][$data['old_url_id'][$k]])){
							    $removeBrandKeyword = ProjectUrlBrandKeyword::where('project_url_id', $data['old_url_id'][$k]);
				                $removeBrandKeyword->delete();
								for($l=0;$l<count($data['brand_keyword'][$data['old_url_id'][$k]]);$l++){
									if(!empty($data['brand_keyword'][$data['old_url_id'][$k]][$l])){
										$newprojectBrandKeyword = new ProjectUrlBrandKeyword();
										$newprojectBrandKeyword->project_id = $projectId;
										$newprojectBrandKeyword->user_id = $userId;
										$newprojectBrandKeyword->project_url_id = $data['old_url_id'][$k];
										$newprojectBrandKeyword->brand_keyword = $data['brand_keyword'][$data['old_url_id'][$k]][$l];
										$newprojectBrandKeyword->save();
									}
									
								}
							}
							if(!empty($data['secondary_keyword'][$data['old_url_id'][$k]])){
								$removeSecondaryKeyword = ProjectUrlSecondaryKeyword::where('project_url_id', $data['old_url_id'][$k]);
				                $removeSecondaryKeyword->delete();
								for($m=0;$m<count($data['secondary_keyword'][$data['old_url_id'][$k]]);$m++){
									if(!empty($data['secondary_keyword'][$data['old_url_id'][$k]][$m])){
										$newprojectSecondaryKeyword = new ProjectUrlSecondaryKeyword();
										$newprojectSecondaryKeyword->project_id = $projectId;
										$newprojectSecondaryKeyword->user_id = $userId;
										$newprojectSecondaryKeyword->project_url_id = $data['old_url_id'][$k];
										$newprojectSecondaryKeyword->secondary_keyword = $data['secondary_keyword'][$data['old_url_id'][$k]][$m];
										$newprojectSecondaryKeyword->save();
									}
									
								}
							}
					}
					
				}
			}
			if(!empty($data['url_name'])){
				//$removeUrl = ProjectUrl::where('project_id', $projectId);
				//$removeUrl->delete();
				for($i=0;$i<count($data['url_name']);$i++){
					if(!empty($data['url_name'][$i])){
						$newprojectUrl = new ProjectUrl();
						$newprojectUrl->project_id = $newProject->id;
						$newprojectUrl->user_id = $userId;
						$newprojectUrl->url_name = $data['url_name'][$i];
						$newprojectUrl->save();
						if(!empty($data['brand_keyword'][$i])){
								for($l=0;$l<count($data['brand_keyword'][$i]);$l++){
									if(!empty($data['brand_keyword'][$i][$l])){
										$newprojectBrandKeyword = new ProjectUrlBrandKeyword();
										$newprojectBrandKeyword->project_id = $projectId;
										$newprojectBrandKeyword->user_id = $userId;
										$newprojectBrandKeyword->project_url_id = $newprojectUrl->id;
										$newprojectBrandKeyword->brand_keyword = $data['brand_keyword'][$i][$l];
										$newprojectBrandKeyword->save();
									}
									
								}
							}
							if(!empty($data['secondary_keyword'][$i])){
								for($m=0;$m<count($data['secondary_keyword'][$i]);$m++){
									if(!empty($data['secondary_keyword'][$i][$m])){
										$newprojectSecondaryKeyword = new ProjectUrlSecondaryKeyword();
										$newprojectSecondaryKeyword->project_id = $projectId;
										$newprojectSecondaryKeyword->user_id = $userId;
										$newprojectSecondaryKeyword->project_url_id = $newprojectUrl->id;
										$newprojectSecondaryKeyword->secondary_keyword = $data['secondary_keyword'][$i][$m];
										$newprojectSecondaryKeyword->save();
									}
									
								}
							}
						
					}
					
				}
			}
			if(!empty($data['exact_keyword'])){
				$removeExactKeyword = ProjectExactKeyword::where('project_id', $projectId);
				$removeExactKeyword->delete();
				for($j=0;$j<count($data['exact_keyword']);$j++){
					if(!empty($data['exact_keyword'][$j])){
						$newprojectExactKeyword = new ProjectExactKeyword();
						$newprojectExactKeyword->project_id = $newProject->id;
						$newprojectExactKeyword->user_id = $userId;
						$newprojectExactKeyword->exact_keywords = $data['exact_keyword'][$j];
						$newprojectExactKeyword->save();
					}
					
				}
			}
			if(!empty($data['partial_keyword'])){
				$removePartialKeyword = ProjectPartialKeyword::where('project_id', $projectId);
				$removePartialKeyword->delete();
				for($k=0;$k<count($data['partial_keyword']);$k++){
					if(!empty($data['partial_keyword'][$k])){
						$newprojectPartialKeyword = new ProjectPartialKeyword();
						$newprojectPartialKeyword->project_id = $newProject->id;
						$newprojectPartialKeyword->user_id = $userId;
						$newprojectPartialKeyword->partial_keywords = $data['partial_keyword'][$k];
						$newprojectPartialKeyword->save();
					}
					
				}
			}
	}
	public function removeProject($id){
		$removeProject = Project::where('id', $id);
		$removeProject->delete();
		$removeUrl = ProjectUrl::where('project_id', $id);
		$removeUrl->delete();
		$removeExactKeyword = ProjectExactKeyword::where('project_id', $id);
		$removeExactKeyword->delete();
		$removePartialKeyword = ProjectPartialKeyword::where('project_id', $id);
		$removePartialKeyword->delete();
		$removeBrandKeyword = ProjectUrlBrandKeyword::where('project_id', $id);
		$removeBrandKeyword->delete();
		$removeSecondaryKeyword = ProjectUrlSecondaryKeyword::where('project_id', $id);
		$removeSecondaryKeyword->delete();
	}
	public function getProjectUrl($id){
		$getProjectData = ProjectUrl::where('project_id',$id)->orderBy('id','desc')->paginate(12);
		return array('data'=>$getProjectData);
	}
	public function getProjectUrlData($extraParams = array(),$id){
		$projectUrls = ProjectUrl::where('project_id',$id);
		return array('total'=>$projectUrls->count(),'data'=>$projectUrls->orderBy('id','desc')->paginate(10));
	}
	public function getProjectUrlAllData($id){
		$projectUrls = ProjectUrl::where('project_id',$id);
		return array('total'=>$projectUrls->count(),'data'=>$projectUrls->orderBy('id','desc')->get());
	}
	public function genrateProjectUrlResponseCollection($projectUrl){
		$inc = 1;
        $data = array();
		if(!empty($projectUrl)){
            foreach($projectUrl as $pro){
				$project = Project::where('id',$pro->project_id)->first();
                $addPath = route('admin-user.project.addkeyword',['id'=>$pro->id]);
                $add = '<a href="'.$addPath.'"><i class="la la-plus add" title="Add Brand & Secondary Keywords"></i></a>';
                $rPath = route('admin.subadmin.remove',['id'=>$pro->id]);
                $remove = '<a href="'.$rPath.'"><i class="la la-close delete"></i></a>';
                //$status =<span style="width:100px;"><span class="badge-text badge-text-small info">Paid</span></span>
                $data[]= array(
                    'inc'=>$inc++,
                    'projectname'=>$project->name,
                    'urlname'=>$pro->url_name,
                    'action'=>$add.' '.$remove
                );
               
            }
        }
        return $data;
	}
	public function getProjectUrlById($id){
		$projectUrlData = ProjectUrl::where('id',$id)->first();
		return $projectUrlData;
	}
	public function addProjectUrlBrandSecondaryKeyword($data = array(),$userId,$projectId){
		$user = Auth::user();
		if(!empty($data['hid_url_id'])){
			$updateProjectUrl = ProjectUrl::find($data['hid_url_id']);
			if(!empty($user) && ($user->role_id ==1)){
				$updateProjectUrl->updated_by = $user->id;
			}else{
				$updateProjectUrl->updated_by = 0;
			}
			$updateProjectUrl->update();
		}
		if(!empty($data['brand_keyword'])){
				$removeBrandKeyword = ProjectUrlBrandKeyword::where('project_url_id', $data['hid_url_id']);
				$removeBrandKeyword->delete();
				for($j=0;$j<count($data['brand_keyword']);$j++){
					if(!empty($data['brand_keyword'][$j])){
						$newprojectBrandKeyword = new ProjectUrlBrandKeyword();
						$newprojectBrandKeyword->project_id = $projectId;
						$newprojectBrandKeyword->user_id = $userId;
						$newprojectBrandKeyword->project_url_id = $data['hid_url_id'];
						$newprojectBrandKeyword->brand_keyword = $data['brand_keyword'][$j];
						$newprojectBrandKeyword->save();
					}
					
				}
			}
			if(!empty($data['secondary_keyword'])){
				$removeSecondaryKeyword = ProjectUrlSecondaryKeyword::where('project_url_id', $data['hid_url_id']);
				$removeSecondaryKeyword->delete();
				for($k=0;$k<count($data['secondary_keyword']);$k++){
					if(!empty($data['secondary_keyword'][$k])){
						$newprojectSecondaryKeyword = new ProjectUrlSecondaryKeyword();
						$newprojectSecondaryKeyword->project_id = $projectId;
						$newprojectSecondaryKeyword->user_id = $userId;
						$newprojectSecondaryKeyword->project_url_id = $data['hid_url_id'];
						$newprojectSecondaryKeyword->secondary_keyword = $data['secondary_keyword'][$k];
						$newprojectSecondaryKeyword->save();
					}
					
				}
			}
	}
	public function getProjectUrlBrandKeyword($projectUrlId){
		$objProjectUrlBrandKeywords = ProjectUrlBrandKeyword::where('project_url_id',$projectUrlId)->get();
		return $objProjectUrlBrandKeywords;
	}
	public function getProjectUrlSecondaryKeyword($projectUrlId){
		$objProjectUrlSecondaryKeywords = ProjectUrlSecondaryKeyword::where('project_url_id',$projectUrlId)->get();
		return $objProjectUrlSecondaryKeywords;
	}
	public function removeProjectUrl($projectUrlId){
	    $removeUrl = ProjectUrl::where('id', $projectUrlId);
		$removeUrl->delete();
		$removeBrandKeyword = ProjectUrlBrandKeyword::where('project_url_id', $projectUrlId);
		$removeBrandKeyword->delete();
		$removeSecondaryKeyword = ProjectUrlSecondaryKeyword::where('project_url_id', $projectUrlId);
		$removeSecondaryKeyword->delete();	
	}
	public function getRecentProjects(){
		$projects = Project::orderBy('id', 'desc')->limit(5)->get();
		return $projects;
	}
	public function getTotalProjectsCount(){
		$projects = Project::orderBy('id', 'desc')->get()->count();
		return $projects;
	}

}
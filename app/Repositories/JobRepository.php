<?php

namespace App\Repositories;

use App\Project;
use App\ProjectUrl;
use App\Job;
use App\PostJob;
use App\JobDetail;
use App\CountryPercentage;
use App\ProjectExactKeyword;
use App\ProjectPartialKeyword;
use App\ProjectUrlBrandKeyword;
use App\ProjectUrlSecondaryKeyword;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;

class JobRepository extends BaseRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Job::class;
    }

    public function getAll($extraParams = array()){
		$jobs = $this->_model->with('jobdetails','projects');
		if(!empty($extraParams['user'])){
			 $jobs->where('jobs.created_by_user', $extraParams['user']);
		 }
		 if(!empty($extraParams['project'])){
			 $jobs->where('jobs.project_id', $extraParams['project']);
		 }
		$jobs->orderBy('id','desc')->get();
		return $jobs;
    }
	public function genrateJobResponseCollection($job){
		$user = Auth::user();
		$inc = 1;
        $data = array();
		if(!empty($job)){
            foreach($job as $pro){
                $editPath = route('admin.job.edit',['id'=>$pro->id]);
				$viewPath = route('admin.job.view',['id'=>$pro->id]);
                $edit = '<a href="'.$editPath.'"><i class="la la-edit edit"></i></a>';
				$view = '<a href="'.$viewPath.'"><i class="la la-eye view"></i></a>';
                $rPath = route('admin.job.remove',['id'=>$pro->id]);
                $remove = '<a class="remove-job" data-id="'.$pro->id.'" data-href="'.$rPath.'" data-toggle="modal" data-target="#success-modal" id="job-delete-'.$pro->id.'"><i class="la la-close delete"></i></a>';
				if(($user->id == $pro->created_by_user) || ($user->role_id == 1)){
					$action = $edit.' '.$view.' '.$remove;
				}else{
					$action = $view;
				}
                //$status =<span style="width:100px;"><span class="badge-text badge-text-small info">Paid</span></span>
                $data[]= array(
                    'inc'=>$inc++,
                    'job_title'=>$pro->job_title,
                    'project_name'=>$pro->projects->name,
					'no_of_searches'=>$pro->no_of_searches,
					'urlCount'=>$pro->jobdetails->count(),
                    'action'=>$edit.' '.$view.' '.$remove
                );
               
            }
        }
        return $data;
    }
	public function addJob($data = array(),$userId){
		        //echo "<pre>";var_dump($data);exit;
		        $newJob = new Job();
				$newJob->job_title = $data['job_title'];
				$newJob->no_of_searches = $data['no_of_searches'];
				$newJob->project_id = $data['project_id'];
				$newJob->project_url_capitalize_percentage = $data['capitalize_first_letter_percentage'];
				$newJob->project_url_yes_percentage = $data['yes_percentage'];
				$newJob->project_url_no_percentage = (100 - $data['yes_percentage']);
				$newJob->project_url_length_of_job = $data['select_length_of_job'];
				$newJob->project_url_random_job = ($data['select_length_of_job'] == 'random') ? $data['random_job_value'] :0;
				$newJob->project_url_minimum_range = $data['minimum_range'];
				$newJob->project_url_maximum_range = $data['maximum_range'];
				$newJob->created_by_user = $userId;
				$newJob->save();
				if(!empty($data['country_code'])){
					for($j=0;$j<count($data['country_code']);$j++){
						if(!empty($data['country_code'][$j])){
							$newCountryPercentage = new CountryPercentage();
							$newCountryPercentage->project_url_id = 0;
							$newCountryPercentage->job_detail_id = 0;
							$newCountryPercentage->job_id = $newJob->id;
							$newCountryPercentage->country_code = $data['country_code'][$j];
							$newCountryPercentage->country_weight = $data['country_weight'][$j];
							$newCountryPercentage->save();
						}
					}
				}
				if(!empty($data['project_url'])){
					for($i=0;$i<count($data['project_url']);$i++){
						if(!empty($data['project_url'][$i])){
							$newjobDetails = new JobDetail();
							$newjobDetails->job_id = $newJob->id;
							$newjobDetails->project_url_id = $data['project_url'][$i];
							$newjobDetails->project_url_weight = !empty($data['project_url_weight'][$i]) ? $data['project_url_weight'][$i] : 0;
							$newjobDetails->project_url_exact = !empty($data['project_exact'][$i]) ? $data['project_exact'][$i] : 0;
							$newjobDetails->project_url_brand_plus_exact = !empty($data['project_brand_plus_exact'][$i]) ? $data['project_brand_plus_exact'][$i] : 0;
							$newjobDetails->project_url_secondary_plus_exact = !empty($data['project_secondary_plus_exact'][$i]) ? $data['project_secondary_plus_exact'][$i] : 0;
							$newjobDetails->project_url_partial_plus_exact = !empty($data['project_partial_plus_exact'][$i]) ? $data['project_partial_plus_exact'][$i] : 0;
							$newjobDetails->project_url_partial_plus_brand = !empty($data['project_partial_plus_brand'][$i]) ? $data['project_partial_plus_brand'][$i] : 0;
							$newjobDetails->project_url_capitalize_percentage = 0;
							$newjobDetails->project_url_country_percentage = 0;
							$newjobDetails->project_url_yes_percentage = 0;
							$newjobDetails->project_url_no_percentage = 0;
							$newjobDetails->project_url_length_of_job = 'random';
							$newjobDetails->project_url_random_job = 0;
							$newjobDetails->project_url_minimum_range = 0;
							$newjobDetails->project_url_maximum_range = 0;
							$newjobDetails->created_by_user = $userId;
							$newjobDetails->save();
							
						}
						
						
					}
				}
				
	}
	public function getEditJob($id){
		$editJobData = Job::where('id',$id)->first();
		return $editJobData;
	}
	public function getJobProjectUrlData($jobId){
		$getJobDetailData = JobDetail::where('job_id',$jobId)->get();
		return $getJobDetailData;
	}
	public function editJob($data = array(),$userId,$jobId){
		        $user = Auth::user();
		        $updateJob = Job::find($jobId);
				$updateJob->job_title = $data['job_title'];
				$updateJob->no_of_searches = $data['no_of_searches'];
				$updateJob->project_id = $data['project_id'];
				$updateJob->project_url_capitalize_percentage = $data['capitalize_first_letter_percentage'];
				$updateJob->project_url_yes_percentage = $data['yes_percentage'];
				$updateJob->project_url_no_percentage = (100 - $data['yes_percentage']);
				$updateJob->project_url_length_of_job = $data['select_length_of_job'];
				$updateJob->project_url_random_job = ($data['select_length_of_job'] == 'random') ? $data['random_job_value'] :0;
				$updateJob->project_url_minimum_range = $data['minimum_range'];
				$updateJob->project_url_maximum_range = $data['maximum_range'];
				
				if(!empty($user) && ($user->role_id ==1)){
					$updateJob->updated_by_user = $user->id;
				}else{
					$updateJob->updated_by_user = 0;
				}
			    $updateJob->update();
				if(!empty($data['country_code'])){
					$deleteCountryPercentage = CountryPercentage::where('job_id',$jobId)->delete();
					for($j=0;$j<count($data['country_code']);$j++){
						if(!empty($data['country_code'][$j])){
							$newCountryPercentage = new CountryPercentage();
							$newCountryPercentage->project_url_id = 0;
							$newCountryPercentage->job_detail_id = 0;
							$newCountryPercentage->job_id = $jobId;
							$newCountryPercentage->country_code = $data['country_code'][$j];
							$newCountryPercentage->country_weight = $data['country_weight'][$j];
							$newCountryPercentage->save();
						}
					}
				}
				if(!empty($data['project_url'])){
					for($i=0;$i<count($data['project_url']);$i++){
						if(!empty($data['project_url'][$i])){
							$getJobDetails = JobDetail::where('job_id',$jobId)->where('project_url_id',$data['project_url'][$i])->get();
							if(!empty($getJobDetails[0])){
								foreach($getJobDetails as $jobDetails){
									$updatejobDetails = JobDetail::find($jobDetails->id);
									$updatejobDetails->job_id = $jobId;
									$updatejobDetails->project_url_id = $data['project_url'][$i];
									$updatejobDetails->project_url_weight = !empty($data['project_url_weight'][$i]) ? $data['project_url_weight'][$i] : 0;
									$updatejobDetails->project_url_exact = !empty($data['project_exact'][$i]) ? $data['project_exact'][$i] : 0;
									$updatejobDetails->project_url_brand_plus_exact = !empty($data['project_brand_plus_exact'][$i]) ? $data['project_brand_plus_exact'][$i] : 0;
									$updatejobDetails->project_url_secondary_plus_exact = !empty($data['project_secondary_plus_exact'][$i]) ? $data['project_secondary_plus_exact'][$i] : 0;
									$updatejobDetails->project_url_partial_plus_exact = !empty($data['project_partial_plus_exact'][$i]) ? $data['project_partial_plus_exact'][$i] : 0;
									$updatejobDetails->project_url_partial_plus_brand = !empty($data['project_partial_plus_brand'][$i]) ? $data['project_partial_plus_brand'][$i] : 0;
									$updatejobDetails->project_url_capitalize_percentage = 0;
									$updatejobDetails->project_url_country_percentage = 0;
									$updatejobDetails->project_url_yes_percentage = 0;
									$updatejobDetails->project_url_no_percentage = 0;
									$updatejobDetails->project_url_length_of_job = 'random';
									$updatejobDetails->project_url_random_job = 0;
									$updatejobDetails->project_url_minimum_range = 0;
									$updatejobDetails->project_url_maximum_range = 0;
									$updatejobDetails->update();
								}
							}else{
								$newjobDetails = new JobDetail();
								$newjobDetails->job_id = $jobId;
								$newjobDetails->project_url_id = $data['project_url'][$i];
								$newjobDetails->project_url_weight = !empty($data['project_url_weight'][$i]) ? $data['project_url_weight'][$i] : 0;
								$newjobDetails->project_url_exact = !empty($data['project_exact'][$i]) ? $data['project_exact'][$i] : 0;
								$newjobDetails->project_url_brand_plus_exact = !empty($data['project_brand_plus_exact'][$i]) ? $data['project_brand_plus_exact'][$i] : 0;
								$newjobDetails->project_url_secondary_plus_exact = !empty($data['project_secondary_plus_exact'][$i]) ? $data['project_secondary_plus_exact'][$i] : 0;
								$newjobDetails->project_url_partial_plus_exact = !empty($data['project_partial_plus_exact'][$i]) ? $data['project_partial_plus_exact'][$i] : 0;
								$newjobDetails->project_url_partial_plus_brand = !empty($data['project_partial_plus_brand'][$i]) ? $data['project_partial_plus_brand'][$i] : 0;
								$newjobDetails->project_url_capitalize_percentage = 0;
								$newjobDetails->project_url_country_percentage = 0;
								$newjobDetails->project_url_yes_percentage = 0;
								$newjobDetails->project_url_no_percentage = 0;
								$newjobDetails->project_url_length_of_job = 'random';
								$newjobDetails->project_url_random_job = 0;
								$newjobDetails->project_url_minimum_range = 0;
								$newjobDetails->project_url_maximum_range = 0;
								$newjobDetails->created_by_user = $userId;
								$newjobDetails->save();
							}
						}
						
					}
				}
				
	}
	public function removeJob($id){
		$removeJob = Job::where('id', $id);
		$removeJob->delete();
		$removeJobDetails = JobDetail::where('job_id', $id);
		$removeJobDetails->delete();
	}
	
	public function getRecentJobs(){
		$jobs = Job::orderBy('id', 'desc')->limit(5)->get();
		return $jobs;
	}
	public function getTotalJobsCount(){
		$jobs = Job::orderBy('id', 'desc')->get()->count();
		return $jobs;
	}
	public function exportJobs($id)
    {
		$arrData = array();
		$getCountryRandomPercentageWeightData = array();
		$getCountryRandomPercentageCodeData = array();
										     
        $jobs = $this->_model->with('jobdetails','projects')->where('id',$id)->first();
        $list = array();
		$mytime = Carbon::now();
		$dateTimeData = $mytime->format('d-M-Y');
        $fileName = 'download-jobs-'.$dateTimeData.'-'.$this->getFileName(6,rand(0,100));
		if(!empty($jobs)){
            if(!empty($jobs->no_of_searches)){
				                $arrData['percentageYesVal'] = round($jobs->no_of_searches*$jobs->project_url_yes_percentage/100);
								$arrData['percentageNoVal'] = round($jobs->no_of_searches*$jobs->project_url_no_percentage/100);
								$arrData['secondMinimumVal'] = round($jobs->project_url_minimum_range);
								$arrData['secondMaximumVal'] = round($jobs->project_url_maximum_range);
								$arrData['percentageCapitalizeVal'] = round($jobs->no_of_searches*$jobs->project_url_capitalize_percentage/100);
								$getCountryRandomPercentageData = CountryPercentage::where('job_id',$jobs->id)->get();
								if(!empty($getCountryRandomPercentageData[0])){
											 foreach($getCountryRandomPercentageData as $countryPercentage){
												 $getCountryRandomPercentageWeightData[] = $countryPercentage->country_weight;
												 $getCountryRandomPercentageCodeData[] = $countryPercentage->country_code;
											 
											}
										 }
										// var_dump($getCountryRandomPercentageWeightData);exit;
					//for($i=0;$i<$jobs->no_of_searches;$i++){
						$totalKeywordVal = 0;
						if(!empty($jobs->jobdetails)){
							$totalPercentageWeightVal = 0;
							foreach($jobs->jobdetails as $jobDetails){
								$arrData['percentageWeightVal'] = round($jobs->no_of_searches*$jobDetails->project_url_weight/100);
								$arrData['percentageExactKeywordVal'] = ($arrData['percentageWeightVal']*$jobDetails->project_url_exact/100);
								$arrData['percentageBrandPlusExactVal'] = ($arrData['percentageWeightVal']*$jobDetails->project_url_brand_plus_exact/100);
								$arrData['percentageSecondaryPlusExact'] = ($arrData['percentageWeightVal']*$jobDetails->project_url_secondary_plus_exact/100);
								$arrData['percentagePartialPlusExactVal'] = ($arrData['percentageWeightVal']*$jobDetails->project_url_partial_plus_exact/100);
								$arrData['percentagePartialPlusbrandVal'] = ($arrData['percentageWeightVal']*$jobDetails->project_url_partial_plus_brand/100);
								
								//var_dump($arrData['percentageWeightVal']);exit;
								$arrData['project_url_name'] = $jobDetails->projectUrls->url_name;
								$totalKeywordVal = round($arrData['percentageExactKeywordVal']+$arrData['percentageBrandPlusExactVal']+$arrData['percentageSecondaryPlusExact']+$arrData['percentagePartialPlusExactVal']+$arrData['percentagePartialPlusbrandVal']);
								$totalWithRoundTotalKeywordVal = (round($arrData['percentageExactKeywordVal'])+round($arrData['percentageBrandPlusExactVal'])+round($arrData['percentageSecondaryPlusExact'])+round($arrData['percentagePartialPlusExactVal'])+round($arrData['percentagePartialPlusbrandVal']));
								$totalPercentageWeightVal = $totalPercentageWeightVal+$arrData['percentageWeightVal'];
								$jobExactkeywords = $jobs->projects->exactKeywords;
								$jobBrandkeywords = $jobs->projects->brandKeywords;
								//echo "<pre>";
								//var_dump($totalWithRoundTotalKeywordVal);
								//exit;
								//var_dump($arrData['percentageExactKeywordVal']);
								//var_dump($arrData['secondMaximumVal']);
								//exit;
								//var_dump($arrData['percentageWeightVal']);
								//var_dump($arrData['percentageExactKeywordVal']);
								//var_dump($arrData['percentageBrandPlusExactVal']);
								//var_dump($arrData['percentageSecondaryPlusExact']);
								//var_dump($arrData['percentagePartialPlusExactVal']);
								//var_dump($arrData['percentagePartialPlusbrandVal']);
								//var_dump($totalKeywordVal);exit;
								//var_dump($jobDetails->projectUrls->url_name);
								//exit;
								//var_dump($jobs->projects->exactKeywords->take($arrData['percentageExactKeywordVal'])->toArray());
								//var_dump($jobs->projects->partialKeywords->take($arrData['percentageExactKeywordVal'])->toArray());
								
								
								 for($i=0;$i<round($arrData['percentageExactKeywordVal']);$i++){
									 $jobExactkeywords = ProjectExactKeyword::where('project_id',$jobs->project_id)->inRandomOrder()->limit(3)->get();
									 if(!empty($jobExactkeywords[0])){
										 $jobExactkeywordsVal = $jobExactkeywords[0]->exact_keywords;
									 }else{
										 $jobExactkeywordsVal = '';
									 }
									 //echo "<pre>";var_dump($jobExactkeywords);exit;
									  $list['data'][] = array(
															 'page_type' => 'GoogleSearchResult',
															 'url' => 'https://www.google.com/',
															 'options.result_url'=> $jobDetails->projectUrls->url_name,
															 'options.resultQuery'=>$jobExactkeywordsVal,
															 'job_title'=> $jobs->job_title,
															 'weight' => $arrData['percentageWeightVal'],
															 'options.landing_min_time'=>1,
															 'options.landing_click'=>''
															 );
								 }
								 for($i=0;$i<round($arrData['percentageBrandPlusExactVal']);$i++){
									  $jobExactkeywords = ProjectExactKeyword::where('project_id',$jobs->project_id)->inRandomOrder()->limit(3)->get();
									  $jobBrandkeywords = ProjectUrlBrandKeyword::where('project_id',$jobs->project_id)->where('project_url_id',$jobDetails->project_url_id)->inRandomOrder()->limit(3)->get();
									  if(!empty($jobExactkeywords[0])){
										 $jobExactkeywordsVal = $jobExactkeywords[0]->exact_keywords;
										 }else{
											 $jobExactkeywordsVal = '';
										 }
									  if(!empty($jobBrandkeywords[0])){
											 $jobBrandkeywordsVal = $jobBrandkeywords[0]->brand_keyword;
										 }else{
											 $jobBrandkeywordsVal = '';
										 }
										 $jobBrandPlusExactVal = $jobBrandkeywordsVal.' '.$jobExactkeywordsVal;
									  
									  $list['data'][] = array(
															 'page_type' => 'GoogleSearchResult',
															 'url' => 'https://www.google.com/',
															 'options.result_url'=> $jobDetails->projectUrls->url_name,
															 'options.resultQuery'=>$jobBrandPlusExactVal,
															 'job_title'=> $jobs->job_title,
															 'weight' => $arrData['percentageWeightVal'],
															 'options.landing_min_time'=>1,
															 'options.landing_click'=>1
															 );
								 }
								 for($i=0;$i<round($arrData['percentageSecondaryPlusExact']);$i++){
									 $jobExactkeywords = ProjectExactKeyword::where('project_id',$jobs->project_id)->inRandomOrder()->limit(3)->get();
									 $jobSecondarykeywords = ProjectUrlSecondaryKeyword::where('project_id',$jobs->project_id)->where('project_url_id',$jobDetails->project_url_id)->inRandomOrder()->limit(3)->get();
									 if(!empty($jobExactkeywords[0])){
										 $jobExactkeywordsVal = $jobExactkeywords[0]->exact_keywords;
										 }else{
										 $jobExactkeywordsVal = '';
										 }
									 if(!empty($jobSecondarykeywords[0])){
										 $jobSecondarykeywordsVal = $jobSecondarykeywords[0]->secondary_keyword;
										 }else{
										 $jobSecondarykeywordsVal = '';
										 }
										 $jobSecondaryPlusExactVal = $jobSecondarykeywordsVal.' '.$jobExactkeywordsVal;
									 $list['data'][] = array(
															 'page_type' => 'GoogleSearchResult',
															 'url' => 'https://www.google.com/',
															 'options.result_url'=> $jobDetails->projectUrls->url_name,
															 'options.resultQuery'=>$jobSecondaryPlusExactVal,
															 'job_title'=> $jobs->job_title,
															 'weight' => $arrData['percentageWeightVal'],
															 'options.landing_min_time'=>1,
															 'options.landing_click'=>1
															 );
								 }
								  for($i=0;$i<round($arrData['percentagePartialPlusExactVal']);$i++){
									  $jobPartialkeywords = ProjectPartialKeyword::where('project_id',$jobs->project_id)->inRandomOrder()->limit(3)->get();
									  $jobSecondarykeywords = ProjectUrlSecondaryKeyword::where('project_id',$jobs->project_id)->where('project_url_id',$jobDetails->project_url_id)->inRandomOrder()->limit(3)->get();
									   if(!empty($jobPartialkeywords[0])){
										 $jobPartialkeywordsVal = $jobPartialkeywords[0]->partial_keywords;
										 }else{
										 $jobPartialkeywordsVal = '';
										 }
										 
									  if(!empty($jobSecondarykeywords[0])){
										 $jobSecondarykeywordsVal = $jobSecondarykeywords[0]->secondary_keyword;
										 }else{
										 $jobSecondarykeywordsVal = '';
										 }
										 $jobPartialPlusSecondaryVal = $jobPartialkeywordsVal.' '.$jobSecondarykeywordsVal;
									 
									  $list['data'][] = array(
															 'page_type' => 'GoogleSearchResult',
															 'url' => 'https://www.google.com/',
															 'options.result_url'=> $jobDetails->projectUrls->url_name,
															 'options.resultQuery'=>$jobPartialPlusSecondaryVal,
															 'job_title'=> $jobs->job_title,
															 'weight' => $arrData['percentageWeightVal'],
															 'options.landing_min_time'=>1,
															 'options.landing_click'=>1
															 );
								 }
								  $varWithRoundPercentagePartialPlusbrandVal = round($arrData['percentagePartialPlusbrandVal']);
								  $varTotalListData = $totalWithRoundTotalKeywordVal;
								 // echo "<pre>";var_dump($varTotalListData);exit;
								 if($varTotalListData > $arrData['percentageWeightVal']){
										 $varRoundPercentagePartialPlusbrandVal =  $varWithRoundPercentagePartialPlusbrandVal-($varTotalListData - $arrData['percentageWeightVal']);
									 }else{
										 $varRoundPercentagePartialPlusbrandVal = round($arrData['percentagePartialPlusbrandVal']);
									 }
								 //echo "<pre>";var_dump($varRoundPercentagePartialPlusbrandVal);
								 
								 for($i=0;$i<$varRoundPercentagePartialPlusbrandVal;$i++){
									  $jobPartialkeywords = ProjectPartialKeyword::where('project_id',$jobs->project_id)->inRandomOrder()->limit(3)->get();
									  $jobBrandkeywords = ProjectUrlBrandKeyword::where('project_id',$jobs->project_id)->where('project_url_id',$jobDetails->project_url_id)->inRandomOrder()->limit(3)->get();
									   if(!empty($jobPartialkeywords[0])){
										 $jobPartialkeywordsVal = $jobPartialkeywords[0]->partial_keywords;
										 }else{
										 $jobPartialkeywordsVal = '';
										 }
									   if(!empty($jobBrandkeywords[0])){
											 $jobBrandkeywordsVal = $jobBrandkeywords[0]->brand_keyword;
										 }else{
											 $jobBrandkeywordsVal = '';
										 }
										 $jobPartialPlusBrandVal = $jobPartialkeywordsVal.' '.$jobBrandkeywordsVal;
									  
									  $list['data'][] = array(
															 'page_type' => 'GoogleSearchResult',
															 'url' => 'https://www.google.com/',
															 'options.result_url'=> $jobDetails->projectUrls->url_name,
															 'options.resultQuery'=>$jobPartialPlusBrandVal,
															 'job_title'=> $jobs->job_title,
															 'weight' => $arrData['percentageWeightVal'],
															 'options.landing_min_time'=>1,
															 'options.landing_click'=>1
															 );
								 }
								// echo "<pre>";var_dump(count($list['data']));
								  for($i=$totalWithRoundTotalKeywordVal;$i<$arrData['percentageWeightVal'];$i++){
									  $list['data'][] = array(
															 'page_type' => 'GoogleSearchResult',
															 'url' => 'https://www.google.com/',
															 'options.result_url'=> $jobDetails->projectUrls->url_name,
															 'options.resultQuery'=>'',
															 'job_title'=> $jobs->job_title,
															 'weight' => $arrData['percentageWeightVal'],
															 'options.landing_min_time'=>1,
															 'options.landing_click'=>1
															 );
								 }
								
								//echo "<pre>";var_dump($totalWithRoundTotalKeywordVal);exit;
								unset($arrData['percentageWeightVal']);
								 unset($arrData['percentageExactKeywordVal']);
                                 unset($arrData['percentageBrandPlusExactVal']);
                                 unset($arrData['percentageSecondaryPlusExact']);
                                 unset($arrData['percentagePartialPlusExactVal']);
                                 unset($arrData['percentagePartialPlusbrandVal']);
                                 unset($totalWithRoundTotalKeywordVal);	
								 unset($varRoundPercentagePartialPlusbrandVal);	
                                 unset($varWithRoundPercentagePartialPlusbrandVal);	
                                 								 
								}
								
						}
						 //All Original data according to jobs 
						// echo "<pre>";var_dump(count($list['data']));var_dump($arrData['percentageYesVal']);exit;
						 if(!empty($list['data'])){
							         $k=1;
									 foreach($list['data'] as $listData){
										// if($k<=$totalPercentageWeightVal){
											 $getRandomNumber = rand($arrData['secondMinimumVal'],$arrData['secondMaximumVal']);
											 $totalListData = count($list['data']);
											 $getTotalCountryPercentage = array_sum($getCountryRandomPercentageWeightData);
											 //echo "<pre>";var_dump($totalListData);var_dump($getTotalCountryPercentage);exit;
											 $getCountryRandomPercentageWeightDataVal = round($totalListData*$getTotalCountryPercentage/100);
											 $getCountryRandomPercentageDataval = CountryPercentage::where('job_id',$jobs->id)->inRandomOrder()->get();
											 //echo "<pre>";var_dump($getCountryRandomPercentageCodeData);
											 if(!empty($getCountryRandomPercentageCodeData[0]) && !empty($getCountryRandomPercentageWeightData[0])){
												 $country = array();
												 for($q=0;$q<count($getCountryRandomPercentageCodeData);$q++){
													 $varTotalWeight = round($totalListData*$getCountryRandomPercentageWeightData[$q]/100);
													 for($r=0;$r<$varTotalWeight;$r++){
														$country[] = $getCountryRandomPercentageCodeData[$q];
													 }
												 }
											 }
											//  echo "<pre>";var_dump($country);exit;
											 $getOriginalData[] = array(
																 'page_type' =>$listData['page_type'],
																 'url' => $listData['url'],
																 'options.query'=>($k<=$arrData['percentageCapitalizeVal']) ? ucfirst($listData['options.resultQuery']) : lcfirst($listData['options.resultQuery']),
																 'options.result_url'=> $listData['options.result_url'],
																 'options.landing_min_time'=>$getRandomNumber,
																 'options.landing_click'=>($k<=$arrData['percentageYesVal']) ? 'Yes' : 'No',
																 'country'=>($k<=$getCountryRandomPercentageWeightDataVal) ? $getCountryRandomPercentageDataval[0]->country_code : '',
																 );
																 $k = $k+1;
																 // unset($list['data']);
										// }
									 }
									 
								 }else{
									$getOriginalData = array(); 
								 }
							//echo "<pre>";var_dump($getOriginalData);exit;	 
							if(!empty($getOriginalData[0])){
								$z=0;
								foreach($getOriginalData as $getOriginal){
									$getOriginalDataLatest[] = array(
															 'page_type' =>$getOriginal['page_type'],
															 'url' => $getOriginal['url'],
															 'options.query'=>$getOriginal['options.query'],
															 'options.result_url'=> $getOriginal['options.result_url'],
															 'options.landing_min_time'=>$getOriginal['options.landing_min_time'],
															 'options.landing_click'=>$getOriginal['options.landing_click'],
															 'country'=>(!empty($country[$z])) ? $country[$z] : ''
															 );
															 $z = $z+1;
								}
							}
					//}
				}
				//$getOriginalDataLatest = shuffle($getOriginalDataLatest);
			//echo "<pre>";var_dump(shuffle($getOriginalDataLatest));var_dump($getOriginalDataLatest);exit;
			//$myLatestRandomOriginalDataLatest = $this->custom_shuffle($getOriginalDataLatest);
			  shuffle($getOriginalDataLatest);
              $collectData = 	collect($getOriginalDataLatest);
				
            if(!empty($getOriginalDataLatest)){
                return (new FastExcel($collectData))->export(storage_path($fileName.'.xlsx'));
            }
        } else {
            return $this->createBlankExcel($fileName);
        }
    }
	public function exportJobsApi($id)
    {
		$arrData = array();
		$getCountryRandomPercentageWeightData = array();
		$getCountryRandomPercentageCodeData = array();
										     
        $jobs = $this->_model->with('jobdetails','projects')->where('id',$id)->first();
        $list = array();
		$mytime = Carbon::now();
		$dateTimeData = $mytime->format('d-M-Y');
        $fileName = 'download-jobs-'.$dateTimeData.'-'.$this->getFileName(6,rand(0,100));
		if(!empty($jobs)){
            if(!empty($jobs->no_of_searches)){
				                $arrData['percentageYesVal'] = round($jobs->no_of_searches*$jobs->project_url_yes_percentage/100);
								$arrData['percentageNoVal'] = round($jobs->no_of_searches*$jobs->project_url_no_percentage/100);
								$arrData['secondMinimumVal'] = round($jobs->project_url_minimum_range);
								$arrData['secondMaximumVal'] = round($jobs->project_url_maximum_range);
								$arrData['percentageCapitalizeVal'] = round($jobs->no_of_searches*$jobs->project_url_capitalize_percentage/100);
								$getCountryRandomPercentageData = CountryPercentage::where('job_id',$jobs->id)->get();
								if(!empty($getCountryRandomPercentageData[0])){
											 foreach($getCountryRandomPercentageData as $countryPercentage){
												 $getCountryRandomPercentageWeightData[] = $countryPercentage->country_weight;
												 $getCountryRandomPercentageCodeData[] = $countryPercentage->country_code;
											 
											}
										 }
										// var_dump($getCountryRandomPercentageWeightData);exit;
					//for($i=0;$i<$jobs->no_of_searches;$i++){
						$totalKeywordVal = 0;
						if(!empty($jobs->jobdetails)){
							$totalPercentageWeightVal = 0;
							foreach($jobs->jobdetails as $jobDetails){
								$arrData['percentageWeightVal'] = round($jobs->no_of_searches*$jobDetails->project_url_weight/100);
								$arrData['percentageExactKeywordVal'] = ($arrData['percentageWeightVal']*$jobDetails->project_url_exact/100);
								$arrData['percentageBrandPlusExactVal'] = ($arrData['percentageWeightVal']*$jobDetails->project_url_brand_plus_exact/100);
								$arrData['percentageSecondaryPlusExact'] = ($arrData['percentageWeightVal']*$jobDetails->project_url_secondary_plus_exact/100);
								$arrData['percentagePartialPlusExactVal'] = ($arrData['percentageWeightVal']*$jobDetails->project_url_partial_plus_exact/100);
								$arrData['percentagePartialPlusbrandVal'] = ($arrData['percentageWeightVal']*$jobDetails->project_url_partial_plus_brand/100);
								
								$arrData['project_url_name'] = $jobDetails->projectUrls->url_name;
								$totalKeywordVal = round($arrData['percentageExactKeywordVal']+$arrData['percentageBrandPlusExactVal']+$arrData['percentageSecondaryPlusExact']+$arrData['percentagePartialPlusExactVal']+$arrData['percentagePartialPlusbrandVal']);
								$totalWithRoundTotalKeywordVal = (round($arrData['percentageExactKeywordVal'])+round($arrData['percentageBrandPlusExactVal'])+round($arrData['percentageSecondaryPlusExact'])+round($arrData['percentagePartialPlusExactVal'])+round($arrData['percentagePartialPlusbrandVal']));
								$totalPercentageWeightVal = $totalPercentageWeightVal+$arrData['percentageWeightVal'];
								$jobExactkeywords = $jobs->projects->exactKeywords;
								$jobBrandkeywords = $jobs->projects->brandKeywords;
								
								 for($i=0;$i<round($arrData['percentageExactKeywordVal']);$i++){
									 $jobExactkeywords = ProjectExactKeyword::where('project_id',$jobs->project_id)->inRandomOrder()->limit(3)->get();
									 if(!empty($jobExactkeywords[0])){
										 $jobExactkeywordsVal = $jobExactkeywords[0]->exact_keywords;
									 }else{
										 $jobExactkeywordsVal = '';
									 }
									  $list['data'][] = array(
															 'page_type' => 'GoogleSearchResult',
															 'url' => 'https://www.google.com/',
															 'options.result_url'=> $jobDetails->projectUrls->url_name,
															 'options.resultQuery'=>$jobExactkeywordsVal,
															 'job_title'=> $jobs->job_title,
															 'weight' => $arrData['percentageWeightVal'],
															 'options.landing_min_time'=>1,
															 'options.landing_click'=>''
															 );
								 }
								 for($i=0;$i<round($arrData['percentageBrandPlusExactVal']);$i++){
									  $jobExactkeywords = ProjectExactKeyword::where('project_id',$jobs->project_id)->inRandomOrder()->limit(3)->get();
									  $jobBrandkeywords = ProjectUrlBrandKeyword::where('project_id',$jobs->project_id)->where('project_url_id',$jobDetails->project_url_id)->inRandomOrder()->limit(3)->get();
									  if(!empty($jobExactkeywords[0])){
										 $jobExactkeywordsVal = $jobExactkeywords[0]->exact_keywords;
										 }else{
											 $jobExactkeywordsVal = '';
										 }
									  if(!empty($jobBrandkeywords[0])){
											 $jobBrandkeywordsVal = $jobBrandkeywords[0]->brand_keyword;
										 }else{
											 $jobBrandkeywordsVal = '';
										 }
										 $jobBrandPlusExactVal = $jobBrandkeywordsVal.' '.$jobExactkeywordsVal;
									  
									  $list['data'][] = array(
															 'page_type' => 'GoogleSearchResult',
															 'url' => 'https://www.google.com/',
															 'options.result_url'=> $jobDetails->projectUrls->url_name,
															 'options.resultQuery'=>$jobBrandPlusExactVal,
															 'job_title'=> $jobs->job_title,
															 'weight' => $arrData['percentageWeightVal'],
															 'options.landing_min_time'=>1,
															 'options.landing_click'=>1
															 );
								 }
								 for($i=0;$i<round($arrData['percentageSecondaryPlusExact']);$i++){
									 $jobExactkeywords = ProjectExactKeyword::where('project_id',$jobs->project_id)->inRandomOrder()->limit(3)->get();
									 $jobSecondarykeywords = ProjectUrlSecondaryKeyword::where('project_id',$jobs->project_id)->where('project_url_id',$jobDetails->project_url_id)->inRandomOrder()->limit(3)->get();
									 if(!empty($jobExactkeywords[0])){
										 $jobExactkeywordsVal = $jobExactkeywords[0]->exact_keywords;
										 }else{
										 $jobExactkeywordsVal = '';
										 }
									 if(!empty($jobSecondarykeywords[0])){
										 $jobSecondarykeywordsVal = $jobSecondarykeywords[0]->secondary_keyword;
										 }else{
										 $jobSecondarykeywordsVal = '';
										 }
										 $jobSecondaryPlusExactVal = $jobSecondarykeywordsVal.' '.$jobExactkeywordsVal;
									 $list['data'][] = array(
															 'page_type' => 'GoogleSearchResult',
															 'url' => 'https://www.google.com/',
															 'options.result_url'=> $jobDetails->projectUrls->url_name,
															 'options.resultQuery'=>$jobSecondaryPlusExactVal,
															 'job_title'=> $jobs->job_title,
															 'weight' => $arrData['percentageWeightVal'],
															 'options.landing_min_time'=>1,
															 'options.landing_click'=>1
															 );
								 }
								  for($i=0;$i<round($arrData['percentagePartialPlusExactVal']);$i++){
									  $jobPartialkeywords = ProjectPartialKeyword::where('project_id',$jobs->project_id)->inRandomOrder()->limit(3)->get();
									  $jobSecondarykeywords = ProjectUrlSecondaryKeyword::where('project_id',$jobs->project_id)->where('project_url_id',$jobDetails->project_url_id)->inRandomOrder()->limit(3)->get();
									   if(!empty($jobPartialkeywords[0])){
										 $jobPartialkeywordsVal = $jobPartialkeywords[0]->partial_keywords;
										 }else{
										 $jobPartialkeywordsVal = '';
										 }
										 
									  if(!empty($jobSecondarykeywords[0])){
										 $jobSecondarykeywordsVal = $jobSecondarykeywords[0]->secondary_keyword;
										 }else{
										 $jobSecondarykeywordsVal = '';
										 }
										 $jobPartialPlusSecondaryVal = $jobPartialkeywordsVal.' '.$jobSecondarykeywordsVal;
									 
									  $list['data'][] = array(
															 'page_type' => 'GoogleSearchResult',
															 'url' => 'https://www.google.com/',
															 'options.result_url'=> $jobDetails->projectUrls->url_name,
															 'options.resultQuery'=>$jobPartialPlusSecondaryVal,
															 'job_title'=> $jobs->job_title,
															 'weight' => $arrData['percentageWeightVal'],
															 'options.landing_min_time'=>1,
															 'options.landing_click'=>1
															 );
								 }
								  $varWithRoundPercentagePartialPlusbrandVal = round($arrData['percentagePartialPlusbrandVal']);
								  $varTotalListData = $totalWithRoundTotalKeywordVal;
								 if($varTotalListData > $arrData['percentageWeightVal']){
										 $varRoundPercentagePartialPlusbrandVal =  $varWithRoundPercentagePartialPlusbrandVal-($varTotalListData - $arrData['percentageWeightVal']);
									 }else{
										 $varRoundPercentagePartialPlusbrandVal = round($arrData['percentagePartialPlusbrandVal']);
									 }
								 for($i=0;$i<$varRoundPercentagePartialPlusbrandVal;$i++){
									  $jobPartialkeywords = ProjectPartialKeyword::where('project_id',$jobs->project_id)->inRandomOrder()->limit(3)->get();
									  $jobBrandkeywords = ProjectUrlBrandKeyword::where('project_id',$jobs->project_id)->where('project_url_id',$jobDetails->project_url_id)->inRandomOrder()->limit(3)->get();
									   if(!empty($jobPartialkeywords[0])){
										 $jobPartialkeywordsVal = $jobPartialkeywords[0]->partial_keywords;
										 }else{
										 $jobPartialkeywordsVal = '';
										 }
									   if(!empty($jobBrandkeywords[0])){
											 $jobBrandkeywordsVal = $jobBrandkeywords[0]->brand_keyword;
										 }else{
											 $jobBrandkeywordsVal = '';
										 }
										 $jobPartialPlusBrandVal = $jobPartialkeywordsVal.' '.$jobBrandkeywordsVal;
									  
									  $list['data'][] = array(
															 'page_type' => 'GoogleSearchResult',
															 'url' => 'https://www.google.com/',
															 'options.result_url'=> $jobDetails->projectUrls->url_name,
															 'options.resultQuery'=>$jobPartialPlusBrandVal,
															 'job_title'=> $jobs->job_title,
															 'weight' => $arrData['percentageWeightVal'],
															 'options.landing_min_time'=>1,
															 'options.landing_click'=>1
															 );
								 }
								 for($i=$totalWithRoundTotalKeywordVal;$i<$arrData['percentageWeightVal'];$i++){
									  $list['data'][] = array(
															 'page_type' => 'GoogleSearchResult',
															 'url' => 'https://www.google.com/',
															 'options.result_url'=> $jobDetails->projectUrls->url_name,
															 'options.resultQuery'=>'',
															 'job_title'=> $jobs->job_title,
															 'weight' => $arrData['percentageWeightVal'],
															 'options.landing_min_time'=>1,
															 'options.landing_click'=>1
															 );
								 }
								
								unset($arrData['percentageWeightVal']);
								 unset($arrData['percentageExactKeywordVal']);
                                 unset($arrData['percentageBrandPlusExactVal']);
                                 unset($arrData['percentageSecondaryPlusExact']);
                                 unset($arrData['percentagePartialPlusExactVal']);
                                 unset($arrData['percentagePartialPlusbrandVal']);
                                 unset($totalWithRoundTotalKeywordVal);	
								 unset($varRoundPercentagePartialPlusbrandVal);	
                                 unset($varWithRoundPercentagePartialPlusbrandVal);	
                                 								 
								}
								
						}
						 //All Original data according to jobs 
						if(!empty($list['data'])){
							         $k=1;
									 foreach($list['data'] as $listData){
										// if($k<=$totalPercentageWeightVal){
											 $getRandomNumber = rand($arrData['secondMinimumVal'],$arrData['secondMaximumVal']);
											 $totalListData = count($list['data']);
											 $getTotalCountryPercentage = array_sum($getCountryRandomPercentageWeightData);
											 //echo "<pre>";var_dump($totalListData);var_dump($getTotalCountryPercentage);exit;
											 $getCountryRandomPercentageWeightDataVal = round($totalListData*$getTotalCountryPercentage/100);
											 $getCountryRandomPercentageDataval = CountryPercentage::where('job_id',$jobs->id)->inRandomOrder()->get();
											 //echo "<pre>";var_dump($getCountryRandomPercentageCodeData);
											 if(!empty($getCountryRandomPercentageCodeData[0]) && !empty($getCountryRandomPercentageWeightData[0])){
												 $country = array();
												 for($q=0;$q<count($getCountryRandomPercentageCodeData);$q++){
													 $varTotalWeight = round($totalListData*$getCountryRandomPercentageWeightData[$q]/100);
													 for($r=0;$r<$varTotalWeight;$r++){
														$country[] = $getCountryRandomPercentageCodeData[$q];
													 }
												 }
											 }
											$getOriginalData[] = array(
																 'page_type' =>$listData['page_type'],
																 'url' => $listData['url'],
																 'options.query'=>($k<=$arrData['percentageCapitalizeVal']) ? ucfirst($listData['options.resultQuery']) : lcfirst($listData['options.resultQuery']),
																 'options.result_url'=> $listData['options.result_url'],
																 'options.landing_min_time'=>$getRandomNumber,
																 'options.landing_click'=>($k<=$arrData['percentageYesVal']) ? 'Yes' : 'No',
																 'country'=>($k<=$getCountryRandomPercentageWeightDataVal) ? $getCountryRandomPercentageDataval[0]->country_code : '',
																 );
																 $k = $k+1;
																 
										// }
									 }
									 
								 }else{
									$getOriginalData = array(); 
								 }
							if(!empty($getOriginalData[0])){
								$z=0;
								foreach($getOriginalData as $getOriginal){
									$getOriginalDataLatest[] = array(
															 'page_type' =>$getOriginal['page_type'],
															 'url' => $getOriginal['url'],
															 'options.query'=>$getOriginal['options.query'],
															 'options.result_url'=> $getOriginal['options.result_url'],
															 'options.landing_min_time'=>$getOriginal['options.landing_min_time'],
															 'options.landing_click'=>$getOriginal['options.landing_click'],
															 'country'=>(!empty($country[$z])) ? $country[$z] : ''
															 );
															 $z = $z+1;
								}
							}
					//}
				}
			shuffle($getOriginalDataLatest);
			$collectData = 	collect($getOriginalDataLatest);
				
            if(!empty($getOriginalDataLatest)){
                return (new FastExcel($collectData))->export(storage_path($fileName.'.xlsx'));
            }
        } else {
            return $this->createBlankExcel($fileName);
        }
    }
	public function getPostJobCrawler($id){
		$postJobData = Postjob::where('job_id',$id)->get();
		return $postJobData;
	}
	public function getLatestPostJobCrawler($id){
		$postJobData = Postjob::where('job_id',$id)->latest()->first();
		return $postJobData;
	}
	
	private function custom_shuffle($my_array = array()) {
	  $copy = array();
	  while (count($my_array)) {
		// takes a rand array elements by its key
		$element = array_rand($my_array);
		// assign the array and its value to an another array
		$copy[$element] = $my_array[$element];
		//delete the element from source array
		unset($my_array[$element]);
	  }
	  return $copy;
	}
    /**
     * will genrate unique ffile name for export excel
    */
    private function getFileName($length, $seed){    

        $name = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "0123456789";

        mt_srand($seed);

        for($i=0;$i<$length;$i++){
            $name .= $codeAlphabet[mt_rand(0,strlen($codeAlphabet)-1)];
        }
        return $name;
    }
    public function getMyJobs($userId){
		$jobs = Job::where('created_by_user',$userId)->orderBy('id', 'desc')->limit(5)->get();
		return $jobs;
	}
	public function getTotalMyJobsCount($userId){
		$jobs = Job::where('created_by_user',$userId)->orderBy('id', 'desc')->get()->count();
		return $jobs;
	}
    

}
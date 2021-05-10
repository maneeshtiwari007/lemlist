<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Project;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\JobRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use App\ConfigureCrawler;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\PostJob;
use View;
use Carbon\Carbon;

class ApiController extends Controller
{
    const DATA_LIMIT = 10;

    private $varAcesstoken = "9c855147dac14e862a261269bba649490ed1b5658e2be52aeb50e084519960d4";
    protected $userRepositery;
	protected $projectRepositery;
	protected $jobRepositery;
    public function __construct(UserRepository $userRepositery,ProjectRepository $projectRepositery,JobRepository $jobRepositery)
    {
        $this->userRepositery = $userRepositery;
		$this->projectRepositery = $projectRepositery;
		$this->jobRepositery = $jobRepositery;
    }
    public function getAccessToken(Request $request){
        $user = Auth::user();
        $arrData = array();
        $getConfigureCrawler = ConfigureCrawler::where('user_id',$user->id)->first();
        $arrData['getConfigureCrawler'] = !empty($getConfigureCrawler) ? $getConfigureCrawler: '';
        if(!empty($getConfigureCrawler)){
            $arrData['scheduleDate'] = Carbon::now()->addHour($getConfigureCrawler->expires_in);
        }
		
		//$createdTime = date("m/d/Y h:i:s a",strtotime($getConfigureCrawler[0]->updated_at));
		//$currentTime = date("m/d/Y h:i:s a", time());
		//$cronTime = date("m/d/Y h:i:s a", time() + 5184000);
		//$cronTime = ;
		//var_dump($createdTime);
		//var_dump($cronTime);
		//exit;
		 return view('api.configure',$arrData);


    }
    public function postAccessToken(Request $request){
        $user = Auth::user();
        $post = $request->post();
		$arrDataPost = array();
        $arrDataPost = array('grant_type'=>'password','username'=> $post['email'],'password'=>$post['password']);
        $varUrl = "https://www.cloudcrawler.io/api/v1/oauth/token";
		$command = 'curl -X POST -F grant_type=password -F username='.$post['email'].' -F password="'.$post['password'].'" '.$varUrl.'';
		$output = exec($command);
		$jsonData = json_decode($output);
	//	echo "<pre>";var_dump($jsonData);exit;
		 if(!empty($jsonData)){
			if(!empty($jsonData->access_token)){
				if(empty($post['hid_config_id'])){
					$arrData = array();
					$arrData['username']=$post['email'];
					$arrData['password']=$post['password'];
                    $arrData['user_id']=$user->id;
					$arrData['access_token']=$jsonData->access_token;
					$arrData['expires_in']=$jsonData->expires_in;
					$arrData['token_type']=$jsonData->token_type;
					$arrData['created_at_token']=$jsonData->created_at;
					$newConfigureCrawler = new ConfigureCrawler($arrData);
					$newConfigureCrawler->save();
					session::flash('success', 'Successfully Submitted!'); 
				    return redirect(route('api.v1.access-token'));
				}else{
					$arrUpdateData = array();
					$arrUpdateData['username']=$post['email'];
					$arrUpdateData['password']=$post['password'];
					
					$updateConfigureCrawler = ConfigureCrawler::find($post['hid_config_id']);
                    $updateConfigureCrawler->user_id=$user->id;
					$updateConfigureCrawler->access_token=$jsonData->access_token;
					$updateConfigureCrawler->expires_in=$jsonData->expires_in;
					$updateConfigureCrawler->token_type=$jsonData->token_type;
					$updateConfigureCrawler->created_at_token=$jsonData->created_at;
					$updateConfigureCrawler->update();
					session::flash('success', 'Update Successfully!'); 
				    return redirect(route('api.v1.access-token'));
				}

			}else{
			    if(!empty($jsonData->error_description)){
			        session::flash('error', $jsonData->error_description); 
			    } else {
				session::flash('error', 'Something wents wrong.Try again!'); 
			    }
				return redirect(route('api.v1.access-token'));
			}
		 }else{
			 session::flash('error', 'Something wents wrong.Try again!'); 
			 return redirect(route('api.v1.access-token'));
		 }
    }
    public function uploadCsvFileForCrawler(Request $request,$id){
        if(!empty($id)){
            $user = Auth::user();
            $arrData = array();
            $arrData['id'] =$id;
			$getCrawlerConfigure = ConfigureCrawler::where('user_id',$user->id)->first();
			//echo "<pre>";var_dump($user->id);exit;
            if(!empty($getCrawlerConfigure)){
               $accessToken = $getCrawlerConfigure->access_token;
                $data = $this->jobRepositery->exportJobsApi($id);
                $varUrl = "https://www.cloudcrawler.io/api/v1/crawlers/377/crawl_jobs";
                $command = 'curl -X POST -H "Authorization: Bearer '.$accessToken.'" -F "page_requests_file=@'.$data.'" -F "page_requests_scheduling_strategy=random" -F "page_requests_scheduling_duration=10" '.$varUrl.'';
                $output = exec($command);
                $jsonData = json_decode($output);
                //echo "<pre>";var_dump($output);exit;
                if(!empty($jsonData)){
                        if(!empty($jsonData->errors)){
                            session::flash('error', 'Something went wrong!'); 
                            //return redirect(route('jobs.index'));
                            return redirect()->back();
                        }else{
                            $getPostJob = PostJob::where('job_id',$id)->first();
                            $newPostJob = new PostJob();
                                $newPostJob->job_id = $id;
                                $newPostJob->crawler_job_id = $jsonData->id;
                                $newPostJob->crawler_id = $jsonData->crawler_id;
                                $newPostJob->callback_url = $jsonData->callback_url;
                                $newPostJob->save();
                            session::flash('success', 'Post Your Job Successfuly!'); 
                            //return redirect(route('jobs.index'));
                            return redirect()->back();
                        }
                    }
                }else{
                            $linkUrl = route('api.v1.access-token');
                            $linkUrlHtml = "<a href='".$linkUrl."'>Click Here</a>";
                            $textMessage = "Oops you have not configure your coudcrawler.io credentials please configure first ";
                            $message = $textMessage.''.$linkUrlHtml;
                            session::flash('error', $message); 
                            //return redirect(route('jobs.index'));
                            return redirect()->back();  
                }
           

        }
	}
	public function postReportCrawler(Request $request){
		$user = Auth::user();
		$arrData = array();
        if ($request->ajax() && $request->method() == "POST")
        {
            $input = $request->input();
            $input = json_decode($input['data']);
			$id = $input->id;
			$getLatestPostJobCrawler =  $this->jobRepositery->getLatestPostJobCrawler($id);
			if(!empty($getLatestPostJobCrawler)){
				$getCrawlerConfigure = ConfigureCrawler::get();
				$accessToken = $getCrawlerConfigure[0]->access_token;
				$varUrl = $getLatestPostJobCrawler->callback_url;
				$command = 'curl -H "Authorization: Bearer '.$accessToken.'" '.$varUrl.'';
				//echo $command;exit;
				//$command = 'curl -X POST -H "Authorization: Bearer '.$accessToken.'" -F "page_requests_file=@'.$data.'" -F "page_requests_scheduling_strategy=random" -F "page_requests_scheduling_duration=10" '.$varUrl.'';
				$output = exec($command);
				$jsonData = json_decode($output);
				//echo "<pre>";var_dump($jsonData);exit;
				$arrData['getJobReport'] = $jsonData;
				$arrData['getJob'] =  $this->jobRepositery->getEditJob($id);
				$arrResponseData = View::make('jobs.view-report', $arrData);
				return response()->json(array(
					'status' => 200,
					'result' => $arrResponseData->render()
				));
			}
			
        }
		if(!empty($id)){
			$getLatestPostJobCrawler =  $this->jobRepositery->getLatestPostJobCrawler($id);
			if(!empty($getLatestPostJobCrawler)){
				$getCrawlerConfigure = ConfigureCrawler::get();
				$accessToken = $getCrawlerConfigure[0]->access_token;
				$varUrl = $getLatestPostJobCrawler->callback_url;
				$command = 'curl -H "Authorization: Bearer '.$accessToken.'" '.$varUrl.'';
				//echo $command;exit;
				//$command = 'curl -X POST -H "Authorization: Bearer '.$accessToken.'" -F "page_requests_file=@'.$data.'" -F "page_requests_scheduling_strategy=random" -F "page_requests_scheduling_duration=10" '.$varUrl.'';
				$output = exec($command);
				$jsonData = json_decode($output);
				echo "<pre>";var_dump($jsonData);exit;
			}
			echo "<pre>";var_dump($getLatestPostJobCrawler);exit;
		}
	}
	public function getReportCrawler(Request $request,$id){
		if(!empty($id)){
			$getLatestPostJobCrawler =  $this->jobRepositery->getLatestPostJobCrawler($id);
			if(!empty($getLatestPostJobCrawler)){
				$getCrawlerConfigure = ConfigureCrawler::get();
				$accessToken = $getCrawlerConfigure[0]->access_token;
				$varUrl = $getLatestPostJobCrawler->callback_url;
				$command = 'curl -H "Authorization: Bearer '.$accessToken.'" '.$varUrl.'';
				//echo $command;exit;
				//$command = 'curl -X POST -H "Authorization: Bearer '.$accessToken.'" -F "page_requests_file=@'.$data.'" -F "page_requests_scheduling_strategy=random" -F "page_requests_scheduling_duration=10" '.$varUrl.'';
				$output = exec($command);
				$jsonData = json_decode($output);
				echo "<pre>";var_dump($jsonData);exit;
			}
			echo "<pre>";var_dump($getLatestPostJobCrawler);exit;
		}
	}
	
	
	public function uploadCsvFileForCrawlerssss(Request $request,$id){
        if(!empty($id)){
            $arrData = array();
            $arrData['id'] =$id;
            $user = Auth::user();
			$arrData['user'] = $user;
			$post = $request->post();
			//echo "<pre>";var_dump($post);exit;
			//$data = $this->jobRepositery->exportJobsApi($id);
			$data = $post['hid_job_crawler'];
			//var_dump($data);exit;
			if(!empty($data)){
				$getCrawlerConfigure = ConfigureCrawler::get();
                $accessToken = $getCrawlerConfigure[0]->access_token;
				//$request = Request::create("https://www.cloudcrawler.io/api/v1/crawlers/377/crawl_jobs");
                //$request->headers->set('Authorization', 'Bearer $accessToken');
				$arrDataPost = array();
				$arrDataPost['page_requests_file'] = $data;
                $arrDataPost['page_requests_scheduling_strategy'] = 'random';
                $arrDataPost['page_requests_scheduling_duration'] = 10;
				$varUrl="https://www.cloudcrawler.io/api/v1/crawlers/377/crawl_jobs";
				 // $client = new \GuzzleHttp\Client(
					// [
						// 'headers'=>[
							// "Authorization"=> "Bearer b6fd6e7abf1656dd78a8075f4debc95f5b99959a4918e76a9d6537fbc1a62a05"
						// ]
					// ]
				// );
				// $res = $client->request('POST',url('https://www.cloudcrawler.io/api/v1/crawlers/377/crawl_jobs'), [
					// 'multipart' => [
						// [
							// 'name'     => 'page_requests_file',
							// 'contents' => fopen($data, 'r' ),
						// ],
					// ],
				// ]);
				// $statusCode = $res->getStatusCode();
                // $content = $res->getBody();
				// var_dump($statusCode);var_dump($content);exit;
				//$jsonData = $this->hitPostUrlTest($arrDataPost,$varUrl,$accessToken);
				$output = shell_exec('curl -X POST -H "Authorization: Bearer 2ca76112fff888788674d8ad98c615ef2a380fb5151e30c7ef0b53e9de60c6d6" -F "page_requests_file=@C:\xampp\htdocs\cloudcrawlernew\storage\download-jobs-27-Mar-2021-KESFO6.xlsx" -F "page_requests_scheduling_strategy=random" -F "page_requests_scheduling_duration=10" https://www.cloudcrawler.io/api/v1/crawlers/377/crawl_jobs');
				echo "<pre>";var_dump($output);exit;
			}
            return view('api.crawler-upload',$arrData);

        }
	}
	private function hitPostUrlTest($arrDataPost,$varUrl,$accessToken){
		// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://www.cloudcrawler.io/api/v1/crawlers/377/crawl_jobs');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		$post = array(
			'page_requests_file' => '@' .realpath('C:xampp\htdocs\cloudcrawlernew\storage\download-jobs-27-Mar-2021-KESFO6.xlsx'),
			'page_requests_scheduling_strategy' => 'random',
			'page_requests_scheduling_duration' => 10
		);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

		$headers = array();
		$headers[] = 'Authorization: Bearer 2ca76112fff888788674d8ad98c615ef2a380fb5151e30c7ef0b53e9de60c6d6';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		echo realpath('C:xampp\htdocs\cloudcrawlernew\storage\download-jobs-27-Mar-2021-KESFO6.xlsx');
		echo "<pre>";var_dump($post);var_dump($result);exit;
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		return $result;
	}
    public function submitCrawlerJobbbbbb(Request $request,$id){
       if(!empty($id)){
            $arrData = array();
			$user = Auth::user();
			$arrData['user'] = $user;
			$data = $this->jobRepositery->exportJobsApi($id);
            if(!empty($data)){
                $getCrawlerConfigure = ConfigureCrawler::get();
                $accessToken = $getCrawlerConfigure[0]->access_token;
                if(!empty($accessToken)){
                    if (!empty($request->hasFile('upload_csv')))
                        {
                            $file = $request->file('upload_csv');
                           // var_dump($file->getClientMimeType());exit;
                            
                             //$request->validate(['file'=> $file,'extension' => strtolower($file->getClientOriginalExtension()),
                           // ],['file'=> 'required|in:csv',]);
                            $timestamp = time();
                            $name = $timestamp . '-' . $file->getClientOriginalName();
                            $destinationPath = public_path('/uploads/api/crawler');
                            //$file->move($destinationPath, $name);
                            $image_path =  $file->getPathname();
                            $image_mime =  $file->getmimeType();
                            $image_org  =  $file->getClientOriginalName();
                            $client = new \GuzzleHttp\Client(
                                [
                                    'headers'=>[
                                        "Authorization"=> "Bearer b6fd6e7abf1656dd78a8075f4debc95f5b99959a4918e76a9d6537fbc1a62a05"
                                    ]
                                ]
                            );
                            $res = $client->request('POST',url('https://www.cloudcrawler.io/api/v1/crawlers/377/crawl_jobs'), [
                                'multipart' => [
                                    [
                                        'name'     => 'page_requests_file',
                                        'filename' => $image_org,
                                        'Mime-Type'=> $image_mime,
                                        'contents' => fopen( $image_path, 'r' ),
                                    ],
                                ],
                            ]);
							$getStatusCode = $res->getStatusCode();
							if($getStatusCode == 201){
								session::flash('success', 'Job Uploaded Successfully!'); 
		                        return redirect(route('jobs.index'));
							}else{
								session::flash('error', 'Something wents wrong.Try again!'); 
		                        return redirect(route('api.v1.get-crawler',['id'=>$id]));
							}
							
                        }
                   
                }
            }
           
        }

    }
    public function crawlerJob(Request $request){
        $input = $request->input();
        $arrDataPost = array();
        $arrDataPost['starting_url'] = 'https://test.com';
        $arrDataPost['starting_page_type_id'] = 99;
        $arrDataPost['params'] = array('companies'=>["Apple", "Google"]);
        //echo "<pre>";
        //var_dump(json_encode($arrDataPost));exit;
        $varUrl = "https://www.cloudcrawler.io/api/v1/crawlers/377/crawl_jobs";
        $getCrawlerConfigure = ConfigureCrawler::get();
        $accessToken = $getCrawlerConfigure[0]->access_token;
        $jsonData = $this->hitPostUrlWithAccessToken($arrDataPost,$varUrl,$accessToken);
        return $jsonData;
    }
    private function hitCurl($varEndpoint){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $varEndpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
		$jsonData = array();
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $jsonData = json_decode($response, true);
        }
        return $jsonData;
		// echo "<pre>";var_dump($jsonData);exit;
        
	}
	 private function hitPostUrlForAccessToken($arrDataPost,$varUrl){
       $curl = curl_init();
        $headers = array(
            "Content-Type: application/json",
            );
        curl_setopt($curl, CURLOPT_URL, $varUrl);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $arrDataPost);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $jsonData = array();
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $jsonData = json_decode($response, true);
        }
        return $jsonData;
    }
    private function hitPostUrl($arrDataPost,$varUrl,$accessToken){
      //echo "<pre>";var_dump($arrDataPost);var_dump($varUrl);
      $curl = curl_init();
        $headers = array(
            "Authorization: Bearer $accessToken",
			);
		curl_setopt($curl, CURLOPT_URL, $varUrl);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $arrDataPost);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($curl);
		var_dump($response);exit;
        // $err = curl_error($curl);
        // curl_close($curl);
        // $jsonData = array();
		// if ($err) {
            // echo "cURL Error #:" . $err;
        // } else {
            // $jsonData = json_decode($response, true);
        // }
        // return $jsonData;
    }
	
	private function hisPostUrlTestContent($arrDataPost,$varUrl,$accessToken){
		// Contains the url to post data
				// this is my local server url
				// demo is the folder name and
				// demo1.php is other file
				$url_path = 'https://www.cloudcrawler.io/api/v1/crawlers/377/crawl_jobs';
				  
				// Data is an array of key value pairs
				// to be reflected on the site
				$data = array('page_requests_file' => '@C:\xampp\htdocs\cloudcrawlernew\storage\download-jobs-27-Mar-2021-1MQO1Z.xlsx', 'page_requests_scheduling_strategy' => 'random', 'page_requests_scheduling_duration' => '10');
				  
				// Method specified whether to GET or
				// POST data with the content specified
				// by $data variable. 'http' is used
				// even in case of 'https'
				  
				$options = array(
					'http' => array(
					'method' => 'POST',
					'content' => http_build_query($data))
				);
				  
				// Create a context stream with
				// the specified options
				$stream = stream_context_create($options);
				  
				// The data is stored in the 
				// result variable
				$result = file_get_contents(
						$url_path, false, $stream);
				  
				echo $result;
	}
    private function checkPostUrl($arrDataPost,$varUrl,$accessToken){
        //The URL that accepts the file upload.
        //var_dump($arrDataPost);var_dump($varUrl);var_dump($accessToken);exit;
                    $url = $varUrl;

                    //The name of the field for the uploaded file.
                    $uploadFieldName = 'page_requests_file';

                    //The full path to the file that you want to upload
                   // $filePath = "@/path_to_file/".$arrDataPost['page_requests_file'];
                   $filePath = $arrDataPost['page_requests_file'];

                    $headers = array(
                        "Authorization: Bearer $accessToken",
                        //"content-type: multipart/form-data",
                        "cache-control: no-cache"
                        
                    );
                    //Initiate cURL
                    $ch = curl_init();

                    //Set the URL
                    curl_setopt($ch, CURLOPT_URL, $url);

                    //Set the HTTP request to POST
                    curl_setopt($ch, CURLOPT_POST, true);

                    //Tell cURL to return the output as a string.
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    //If the function curl_file_create exists
                   // $fileName = "download-jobs-18-Mar-2021-W6BD2M";
                   // $filePath = storage_path($fileName.'.csv');
                    //If the function curl_file_create exists
                        if(function_exists('curl_file_create')){
                            //Use the recommended way, creating a CURLFile object.
                            $filePath = curl_file_create($filePath);
                        } else{
                            //Otherwise, do it the old way.
                            //Get the canonicalized pathname of our file and prepend
                            //the @ character.
                            $filePath = '@' . realpath($filePath);
                            //Turn off SAFE UPLOAD so that it accepts files
                            //starting with an @
                            curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
                        }
                   
                   
                    //Setup our POST fields
                    $postFields = array(
                        'page_requests_file ' => $filePath->name,
                        'page_requests_scheduling_strategy' => 'random',
                        'page_requests_scheduling_duration' => 10
                    );
                    
                   //echo "<pre>";var_dump($postFields);exit;
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                    //Execute the request
                    $result = curl_exec($ch);
                    $err = curl_error($ch);
                    //If an error occured, throw an exception
                   

                    //Print out the response from the page
                    $jsonData = array();
                    if ($err) {
                        echo "cURL Error #:" . $err;
                    } else {
                        $jsonData = json_decode($result, true);
                    }
                    var_dump($jsonData);exit;
                    return $jsonData;
    }
    private function checkPostAccessUrl($arrDataPost,$varUrl,$accessToken){
                $file = "uploads/payables.csv";
                $authorization = "Authorization: Bearer [$accessToken]";

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $varUrl);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_HTTPHEADER, [$authorization, 'Content-Type: text/csv']);
                $cfile = new CurlFile($file,  'text/csv');
                //curl file itself return the realpath with prefix of @
                $data = array('data-binary' => $cfile);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $curl_response = curl_exec($curl);
                curl_close($curl);
    }
    private function hitPostUrlWithAccessToken($arrDataPost,$varUrl,$accessToken){
       $jsonEncodePostData = json_encode($arrDataPost);
       //echo "<pre>";var_dump($jsonEncodePostData);exit;
         // Set required HTTP headers
        $headers = array(
            "Content-Type: application/json",
            "Content-Length: " . strlen( $jsonEncodePostData),
            "Authorization: Bearer $accessToken"
        );

        // Make the call
        $curl = curl_init($varUrl);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonEncodePostData);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $jsonData = array();
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $jsonData = json_decode($response, true);
        }
        return $jsonData;
    }
    public function adminList(Request $request){
        $input = $request->input();
        $user = $this->userRepositery->getAll($input);
        $data = $this->userRepositery->genrateUserResponseCollection($user['data']);
		echo "<pre>";var_dump($data);exit;
        return response()->json(array(
            'draw'=>(!empty($input['draw']))?$input['draw']:1,
            'recordsTotal'=>$user['total'],
            'recordsFiltered'=>$user['total'],
            'data'=>$data
        ));
    }
	public function projectList(Request $request){
        $input = $request->input();
        $project = $this->projectRepositery->getAll($input);
		$data = $this->projectRepositery->genrateProjectResponseCollection($project['data']);
		return response()->json(array(
            'draw'=>(!empty($input['draw']))?$input['draw']:1,
            'recordsTotal'=>$project['total'],
            'recordsFiltered'=>$project['total'],
            'data'=>$data
        ));
    }
	public function projectUrlList(Request $request,$id){
		$input = $request->input();
        $projectUrl = $this->projectRepositery->getProjectUrlData($input,$id);
		$data = $this->projectRepositery->genrateProjectUrlResponseCollection($projectUrl['data']);
		return response()->json(array(
            'draw'=>(!empty($input['draw']))?$input['draw']:1,
            'recordsTotal'=>$projectUrl['total'],
            'recordsFiltered'=>$projectUrl['total'],
            'data'=>$data,
			
        ));
	}
	public function jobList(Request $request){
		$user = Auth::user();
		$input = $request->input();
		$job = $this->jobRepositery->getAll($input);
		$data = $this->jobRepositery->genrateJobResponseCollection($job['data']);
		return response()->json(array(
            'draw'=>(!empty($input['draw']))?$input['draw']:1,
            'recordsTotal'=>$job['total'],
            'recordsFiltered'=>$job['total'],
            'data'=>$data
        ));
	}
}

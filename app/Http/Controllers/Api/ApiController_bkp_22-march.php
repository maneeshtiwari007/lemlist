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
        $getConfigureCrawler = ConfigureCrawler::get();
        $arrData['getConfigureCrawler'] = !empty($getConfigureCrawler[0]) ? $getConfigureCrawler[0] : '';
        return view('api.configure',$arrData);


    }
    public function postAccessToken(Request $request){
        $user = Auth::user();
        $post = $request->post();
        $arrDataPost = array();
        $arrDataPost = array('grant_type'=>'password','username'=> $post['email'],'password'=>$post['password']);
        $varUrl = "https://www.cloudcrawler.io/api/v1/oauth/token";
        $jsonData = $this->hitPostUrl($arrDataPost,$varUrl);
        if(!empty($jsonData['access_token'])){
            $arrData = array();
            $arrData['username']=$post['email'];
            $arrData['password']=$post['password'];
            $arrData['access_token']=$jsonData['access_token'];
            $arrData['expires_in']=$jsonData['expires_in'];
            $arrData['token_type']=$jsonData['token_type'];
            $arrData['created_at_token']=$jsonData['created_at'];
            $newConfigureCrawler = new ConfigureCrawler($arrData);
            $newConfigureCrawler->save();
            session::flash('success', 'Successfully Submitted!'); 
		    return redirect(route('api.v1.access-token'));

        }else{
            session::flash('error', 'Something wents wrong.Try again!'); 
		    return redirect(route('api.v1.access-token'));
        }
    }
    public function uploadCsvFileForCrawler(Request $request,$id){
        if(!empty($id)){
            $arrData = array();
            $arrData['id'] =$id;
            return view('api.crawler-upload',$arrData);

        }
	}
    public function submitCrawlerJob(Request $request,$id){
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
                            
                           // var_dump($id);exit;
                            $request->validate(['file'=> $file,'extension' => strtolower($file->getClientOriginalExtension()),
                            ],['file'=> 'required|in:csv',]);
                            $timestamp = time();
                            $name = $timestamp . '-' . $file->getClientOriginalName();
                            $destinationPath = public_path('/uploads/api/crawler');
                            $file->move($destinationPath, $name);
                            $fileCsv = url('public/uploads/api/crawler') . '/' . $name;
                            $arrPostData = array();
                            $arrPostData['page_requests_file'] =  $fileCsv;
                            $arrPostData['page_requests_scheduling_strategy'] = "random";
                            $arrPostData['page_requests_scheduling_duration'] = 10;
                                // $arrPostData['starting_url'] = 'https://test.com';
                                // $arrPostData['starting_page_type_id'] = 99;
                                // $arrPostData['params'] = array('companies'=>["Apple", "Google"]);
                            //echo "<pre>";var_dump($arrPostData);exit;
                            $varUrl = "https://www.cloudcrawler.io/api/v1/crawlers/377/crawl_jobs";
                            $jsonData = $this->checkPostUrl($arrPostData,$varUrl,$accessToken);
                            echo "<pre>";var_dump($jsonData);exit;
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
    private function hitPostUrl($arrDataPost,$varUrl,$accessToken){
        //echo "<pre>";var_dump($arrDataPost);var_dump($accessToken);var_dump($varUrl);exit;
       // $postfields = array("filedata" => "@$filedata", "filename" => $filename);
       if (function_exists('curl_file_create')) { // php 5.5+
        $cFile = curl_file_create($file_name_with_full_path);
        } else { // 
            $cFile = '@' . realpath($file_name_with_full_path);
        }
       $post['page_requests_file'] = '@/path_to_file'.'/'.$arrDataPost['page_requests_file'];
       $post['page_requests_scheduling_strategy'] = 'random';
       $post['page_requests_scheduling_duration'] = 10;
        //$post = array('page_requests_file'=> '@/uploads/crawler/'.$arrDataPost['page_requests_file'],'page_requests_scheduling_strategy'=>'random','page_requests_scheduling_duration'=>10);
        $curl = curl_init();
        $headers = array(
            "Authorization: Bearer $accessToken",
            "content-type: multipart/form-data",
            "cache-control: no-cache"
        );
        curl_setopt($curl, CURLOPT_URL, $varUrl);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
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
    private function checkPostUrl($arrDataPost,$varUrl,$accessToken){
        //The URL that accepts the file upload.
                    $url = $varUrl;

                    //The name of the field for the uploaded file.
                    $uploadFieldName = 'page_requests_file';

                    //The full path to the file that you want to upload
                    $filePath = $arrDataPost['page_requests_file'];

                    $headers = array(
                        "Authorization: Bearer $accessToken",
                        "content-type: multipart/form-data",
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
                    if(function_exists('curl_file_create')){
                        //Use the recommended way, creating a CURLFile object.
                        $filePath = curl_file_create($filePath);
                        
                    } else{
                        //Otherwise, do it the old way.
                        //Get the canonicalized pathname of our file and prepend
                        //the @ character.
                        $filePath = '@/path_to_file/' . realpath($filePath);
                        //Turn off SAFE UPLOAD so that it accepts files
                        //starting with an @
                        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
                        
                    }
                    
                    //Setup our POST fields
                    $postFields = array(
                        $uploadFieldName => $filePath,
                        'page_requests_scheduling_strategy' => 'random',
                        'page_requests_scheduling_duration' => 10
                    );

                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                    //Execute the request
                    $result = curl_exec($ch);

                    //If an error occured, throw an exception
                    //with the error message.
                    if(curl_errno($ch)){
                        throw new Exception(curl_error($ch));
                    }

                    //Print out the response from the page
                    echo $result;
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

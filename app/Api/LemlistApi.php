<?php

namespace App\Api;

class LemlistApi{
    
    // private variables for api urls and keys
    private $apiUrl;
    private $apiKey;

    public function __construct($api_name=""){
        // assign the api names and keys
        $this->apiUrl = "https://api.lemlist.com/api/".$api_name;
        $this->apiKey = "f0cbbddf1e4f827f79e93a557155fb34";
    }

    /*
    * function to get all capaigns from Lemlist api
    * @param void
    * @return Decoded Json Data @jsonData
    * @author Shiv Kumar Tiwari
    */
    public function callApi(){
        $command = 'curl '.$this->apiUrl.' --user ":'.$this->apiKey.'"';
		$output = exec($command);
		$jsonData = json_decode($output);
        return $jsonData;
    }


}

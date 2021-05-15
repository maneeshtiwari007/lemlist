<?php

// this controller handles all the campaigns related urls and crud operations
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CampaignRepository;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class LeadController extends Controller{

    private $objCampaignRepositery;

    public function __construct(CampaignRepository $campaignRepositery){
        $this->objCampaignRepositery = $campaignRepositery;
    }

    public function upload_leads(){
        $arrCampaigns = $this->objCampaignRepositery->getAllCampaigns();
		return view('leads.upload_leads',['arrCampaigns'=>$arrCampaigns]);
    }

    public function upload_csv_file(Request $request){
        if ($request->ajax()){
            $path = $request->file('file')->getRealPath();
            $data = array_map('str_getcsv', file($path));
            var_dump($data);
            return response("done");
        }
    } 

    public function sync_with_lemlist(Request $request){
        if ($request->ajax()){
            $this->objCampaignRepositery->syncCampaign();
            return response()->json(array('processed'=>1));
        }
    }

}
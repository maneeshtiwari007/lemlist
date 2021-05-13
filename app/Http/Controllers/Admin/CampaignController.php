<?php

// this controller handles all the campaigns related urls and crud operations
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CampaignRepository;
use Illuminate\Contracts\View\View;
use Yajra\DataTables\DataTables;

class CampaignController extends Controller{

    private $objCampaignRepositery;

    public function __construct(CampaignRepository $campaignRepositery){
        $this->objCampaignRepositery = $campaignRepositery;
    }

    public function index(){
		return view('campaigns.index',[
        ]);
    }

    public function get_campaigns(Request $request){
        if ($request->ajax()){
            $arrCampaigns = $this->objCampaignRepositery->getAllCampaignsWithDataTable();
            return ($arrCampaigns);
        }
    } 

    public function sync_with_lemlist(Request $request){
        if ($request->ajax()){
            $this->objCampaignRepositery->syncCampaign();
            return response()->json(array('processed'=>1));
        }
    }

}
<?php

// this controller handles all the campaigns related urls and crud operations
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CampaignRepository;
use App\Repositories\LeadRepository;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class LeadController extends Controller{

    public function index(CampaignRepository $campaignRepositery){
        $this->objCampaignRepositery = $campaignRepositery;
        $arrCampaigns = $this->objCampaignRepositery->getAllCampaigns();
		return view('leads.upload_leads',['arrCampaigns'=>$arrCampaigns]);
    }

    function upload_leads(Request $request, LeadRepository $objLeadRepository)
    {
        $objLeadRepository->uploadLeadOnLemlist($request);
        Session::flash('success', 'Leads uploaded successfully!'); 
        return redirect(route("leads.upload-leads"));
    }

    public function upload_csv_file(Request $request){
        if ($request->ajax()){
            $request->validate([
                'file' => 'required|mimes:xlx,csv,txt|max:1024*5',
            ]);
            $fileName = time().'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('uploads/csv'), $fileName);
            $arrReturnData = ['file_name'=>$fileName];
            return response()->json($arrReturnData);
        }
    } 

    public function sync_with_lemlist(Request $request){
        if ($request->ajax()){
            $this->objCampaignRepositery->syncCampaign();
            return response()->json(array('processed'=>1));
        }
    }

}
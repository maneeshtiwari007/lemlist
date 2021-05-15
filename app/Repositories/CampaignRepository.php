<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Campaign;
use App\Api\LemlistApi;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class CampaignRepository extends BaseRepository
{
    
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Campaign::class;
    }


    /*
    * function to get all capaigns from database
    * @param void
    * @return array of objects
    * @author Shiv Kumar Tiwari
    */
    public function getAllCampaigns(){

            $campaigns = $this->_model;
            $campaigns = $campaigns->orderBy('id','desc')->get();
            return $campaigns;
    }
    public function getAllCampaignsWithDataTable(){

        $campaigns = $this->_model->where(DB::raw("1"),1);
        $table = new DataTables();
        return $table->eloquent($campaigns)
                    ->editColumn('updated_at',function($data){
                        return date("d M, Y H:i:s", strtotime($data->updated_at));
                    })->addIndexColumn()->toJson();
}

    /*
    * function to get all capaigns from Lemlist and save or update into our database
    * @param void
    * @return void
    * @author Shiv Kumar Tiwari
    */
    public function syncCampaign(){
        $user = Auth::user();
        $objLemlistApi = new LemlistApi('campaigns');
        $jsonData = $objLemlistApi->callApi();
        if(!empty($jsonData)){
            foreach($jsonData as $arrCmpData){
                if(!empty($arrCmpData->name)){
                    $arrCheck = ['campaign_id'=>$arrCmpData->_id];
                    $attributes = [
                        'campaign_id'=>$arrCmpData->_id,
                        'campaign_name'=>$arrCmpData->name
                    ];
                    $this->_model->updateOrCreate($arrCheck,$attributes);
                }
            }
        }
    }
}
<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Campaign;
use App\Api\LemlistApi;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class LeadRepository extends BaseRepository
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
    public function getAllCampaignsWithDataTable(){

        $campaigns = $this->_model->where(DB::raw("1"),1);
        $table = new DataTables();
        return $table->of($campaigns)
                    ->editColumn('updated_at',function($data){
                        return date("d M, Y H:i:s", strtotime($data->updated_at));
                    })->addIndexColumn()->toJson();
    }

   
}
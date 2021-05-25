<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Api\LemlistApi;
use App\Lead;
use GuzzleHttp\Psr7\Request;
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
        return Lead::class;
    }

    /*
    * function to upload on the lemlist and also save on the database as well
    * @param Request $request
    * @return void
    * @author Shiv Kumar Tiwari
    */
    public function uploadLeadOnLemlist($request){
        //$user = Auth::user();
        $file_name = $request->post('file_uploaded');
        $all_campaigns = $request->post('campaigns');
        $data = array_map('str_getcsv', file(public_path('uploads/csv/'.$file_name)));
        $objLemlistApi = new LemlistApi('campaigns');
        $arrCampaignsData=[];
        $totalCampaignsSelected = count($all_campaigns);
        $totalActualLeads = count($data)-1;
        //echo "<pre>";var_dump($data);exit;
        if($totalActualLeads <= $totalCampaignsSelected){
            foreach($all_campaigns as $key=>$val){
                if(!empty($data[$key+1])){
                    $csvRow = $data[$key+1];
                    $varEmail = $csvRow[6];
                    $arrPostData = [
                        'companyName'=>$csvRow[0],
                        'Keyword'=>$csvRow[1],
                        'URL'=>$csvRow[2],
                        'Outreach Description'=>$csvRow[3],
                        'firstName'=>$csvRow[4],
                        'lastName'=>$csvRow[5],
                        'Area of interest'=>$csvRow[7],
                        'Source'=>$csvRow[8],
                        'SDR'=>$csvRow[9],
                    ];
                    $jsonData = $objLemlistApi->callApiWithData($arrPostData,"{$val}/leads/{$varEmail}?deduplicate=true");
                    //var_dump($jsonData);
                    $is_inserted_lemlist = !empty($jsonData) ? 1 : 0;
                    $attributes = [
                        'campaign_id'=>$val,
                        'company'=>$csvRow[0],
                        'keyword'=>$csvRow[1],
                        'url'=>$csvRow[2],
                        'description'=>$csvRow[3],
                        'first_name'=>$csvRow[4],
                        'last_name'=>$csvRow[5],
                        'email'=>$varEmail,
                        'area_interest'=>$csvRow[7],
                        'source'=>$csvRow[8],
                        'sdr'=>$csvRow[9],
                        'uploaded_by'=>Auth::id(),
                        'is_inserted_lemlist'=>$is_inserted_lemlist
                    ];
                    
                }
            }
        }else{
            //echo "leads-".$totalActualLeads."<br>campaigns-".$totalCampaignsSelected."<br>";
            $dataCountToeachCampaign = ceil($totalActualLeads/$totalCampaignsSelected);
            //echo $dataCountToeachCampaign;
            $counter = 1;
            foreach($all_campaigns as $key=>$val){
                for($i=0;$i<$dataCountToeachCampaign;$i++){
                    // checks if reaches to end of the csv record
                    if($counter > $totalActualLeads){break;}
                    // chcek if that node exists
                    if(!empty($data[$counter])){
                        $csvRow = $data[$counter];
                        $varEmail = $csvRow[6];

                        // data to post on lemlist
                        $arrPostData = [
                            'companyName'=>$csvRow[0],
                            'Keyword'=>$csvRow[1],
                            'URL'=>$csvRow[2],
                            'Outreach Description'=>$csvRow[3],
                            'firstName'=>$csvRow[4],
                            'lastName'=>$csvRow[5],
                            'Area of interest'=>$csvRow[7],
                            'Source'=>$csvRow[8],
                            'SDR'=>$csvRow[9],
                        ];

                        $jsonData = $objLemlistApi->callApiWithData($arrPostData,"{$val}/leads/{$varEmail}?deduplicate=true");
                        //var_dump($jsonData);
                        $is_inserted_lemlist = !empty($jsonData) ? 1 : 0;
                        $attributes = [
                            'campaign_id'=>$val,
                            'company'=>$csvRow[0],
                            'keyword'=>$csvRow[1],
                            'url'=>$csvRow[2],
                            'description'=>$csvRow[3],
                            'first_name'=>$csvRow[4],
                            'last_name'=>$csvRow[5],
                            'email'=>$varEmail,
                            'area_interest'=>$csvRow[7],
                            'source'=>$csvRow[8],
                            'sdr'=>$csvRow[9],
                            'uploaded_by'=>Auth::id(),
                            'is_inserted_lemlist'=>$is_inserted_lemlist
                        ];
                        $this->_model->create($attributes);

                        $counter++;
                    }
                }

            }
            //exit;
        }
        unlink(public_path('uploads/csv/'.$file_name));
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
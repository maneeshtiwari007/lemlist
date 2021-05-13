<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model{
    protected $table = "tbl_campaigns";
    protected $fillable = ['campaign_id','campaign_name'];
}
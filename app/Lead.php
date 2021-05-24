<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model{
    protected $table = "tbl_leads";
    protected $fillable = ['campaign_id','company','keyword','url','description','first_name','last_name','email','area_interest',
    'source','sdr','uploaded_by','is_inserted_lemlist'];
}
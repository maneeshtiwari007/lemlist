<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryPercentage extends Model
{
    protected $fillable = ['project_url_id','job_detail_id', 'job_id', 'country_code', 'country_weight'];
}

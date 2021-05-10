<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobDetail extends Model
{
    protected $fillable = ['job_id','project_url_id', 'project_url_weight', 'project_url_exact', 'project_url_brand_plus_exact', 
	'project_url_secondary_plus_exact', 'project_url_partial_plus_exact', 'project_url_partial_plus_brand', 'project_url_capitalize_percentage', 
	'project_url_country_percentage', 'project_url_yes_percentage', 'project_url_no_percentage', 'project_url_length_of_job', 'project_url_random_job'
	, 'project_url_minimum_range', 'project_url_maximum_range', 'created_by_user'];
	
	public function projectUrls(){
        return $this->belongsTo(ProjectUrl::class,'project_url_id','id');
    }
	public function countryPercentage(){
		return $this->hasMany(CountryPercentage::class);
    }
}

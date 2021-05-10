<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = ['job_title','no_of_searches', 'project_id','created_by_user'];
	public function projects(){
        return $this->belongsTo(Project::class,'project_id','id');
    }
	public function jobDetails() {
     return $this->hasMany(JobDetail::class)->orderBy('project_url_id');
    }
	public function chkUser(){
        return $this->belongsTo(User::class,'created_by_user','id');
    }
	public function projectExactKeyword(){
        return $this->hasMany(ProjectExactKeyword::class,'project_id','project_id');
    }
	public function countryPercentage(){
		return $this->hasMany(CountryPercentage::class);
    }
    public function projectPartialKeyword(){
        return $this->hasMany(ProjectPartialKeyword::class,'project_id','project_id');
    }
	
}

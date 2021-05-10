<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUrl extends Model
{
    protected $fillable = ['project_id','user_id','url_name'];

    public function projects(){
        return $this->belongsTo(Project::class,'project_id','id');
    }
	public function brandKeywords() {
     
        return $this->hasMany(ProjectUrlBrandKeyword::class);
            
    }
	public function secondaryKeywords() {
     
        return $this->hasMany(ProjectUrlSecondaryKeyword::class);
            
    }
	public function jobDetailsByUrl(){
		return $this->hasMany(JobDetail::class);
    }
}

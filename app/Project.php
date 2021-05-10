<?php

namespace App;
use App\Role;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'user_id'];

    public function urls() {
     
        return $this->hasMany(ProjectUrl::class)->orderBy('id');;
            
     }
	 public function exactKeywords() {
     
        return $this->hasMany(ProjectExactKeyword::class);
            
     }
	 public function partialKeywords() {
     
        return $this->hasMany(ProjectPartialKeyword::class);
            
     }
	 public function projecturls() {
     
        return $this->belongsTo(ProjectUrl::class,'project_id','id');
            
     }
	 // public function brandKeywords() {
     
        // return $this->hasMany(ProjectUrlBrandKeyword::class);
            
     // }
	  // public function secondaryKeywords() {
     
        // return $this->hasMany(ProjectUrlSecondaryKeyword::class);
            
     // }
	  public function jobs() {
     
        return $this->hasMany(Job::class);
            
     }
}

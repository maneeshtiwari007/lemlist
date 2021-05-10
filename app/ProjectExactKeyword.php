<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectExactKeyword extends Model
{
   protected $fillable = ['project_id','user_id','exact_keywords'];

    public function projects(){
        return $this->belongsTo(Project::class);
    }
}

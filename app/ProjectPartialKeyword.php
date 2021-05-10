<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectPartialKeyword extends Model
{
    protected $fillable = ['project_id','user_id','partial_keywords'];

    public function projects(){
        return $this->belongsTo(Project::class);
    }
}

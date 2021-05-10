<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUrlSecondaryKeyword extends Model
{
     protected $fillable = ['project_id','user_id','project_url_id','secondary_keyword'];
}

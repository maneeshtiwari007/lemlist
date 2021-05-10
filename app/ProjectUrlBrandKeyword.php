<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUrlBrandKeyword extends Model
{
    protected $fillable = ['project_id','user_id','project_url_id','brand_keyword'];
}

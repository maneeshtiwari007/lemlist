<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostJob extends Model
{
    protected $fillable = ['job_id', 'crawler_job_id', 'crawler_id', 'callback_url'];
}

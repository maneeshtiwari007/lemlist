<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigureCrawler extends Model
{
   protected $fillable = ['username','password', 'access_token', 'expires_in', 'token_type', 'created_at_token','user_id'];
}

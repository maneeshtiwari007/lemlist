<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sheet extends Model{
    protected $table = "tbl_uploaded_sheet";
    protected $fillable = ['sheet_name','sheet_short_name','uploaded_by'];
	public function user(){
        return $this->belongsTo(User::class,'uploaded_by','id');
    }
}
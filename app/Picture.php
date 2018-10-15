<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table = 'pictures';
    protected $primaryKey = 'id';
    protected $fillable = ['post_id','name'];
 	public $timestamps = false;
 	public function Post(){
 		return $this->belongsTo('App\Post');
 	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
 	protected $table = 'news';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','title','detail','id_new_cat','active','created_at','updated_at'];
}

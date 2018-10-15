<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $fillable = ['cat_id','district_id','village_id','street_id','id_home','price1','price2','title','detail','user_id','view','created_at','updated_at'];
}

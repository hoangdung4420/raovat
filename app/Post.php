<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $fillable = ['cat_id','district_id','village_id','street_id','id_home','map','price1','price2','title','detail','pictures','user_id','view','sell','created_at','updated_at'];

    public function tinDang($user_id){
    	return $this->join('approvals','posts.id','post_id')->where('posts.user_id',$user_id)->where('status',2)->count();
    }

    public function tinCho($user_id){
    	return $this->join('approvals','posts.id','post_id')->where('posts.user_id',$user_id)->where('status',1)->count();
    }

    public function tinTuChoi($user_id){
    	return $this->join('approvals','posts.id','post_id')->where('posts.user_id',$user_id)->where('status',3)->count();
    }
}

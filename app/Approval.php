<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Approval extends Model
{
    protected $table = 'approvals';
    protected $primaryKey = 'id';
    protected $fillable = ['post_id','user_id','status','reason','created_at','updated_at'];
}

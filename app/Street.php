<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
 	protected $table = 'streets';
    protected $primaryKey = 'id';
    protected $fillable = ['name','village_id'];
 	public $timestamps = false;
}

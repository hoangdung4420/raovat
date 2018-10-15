<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $table = 'villages';
    protected $primaryKey = 'id';
    protected $fillable = ['name','district_id'];
 	public $timestamps = false;
}

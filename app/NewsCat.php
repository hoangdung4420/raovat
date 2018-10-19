<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsCat extends Model
{
    protected $table = 'new_cats';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];
 	public $timestamps = false;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Introduction extends Model
{
    protected $table = 'introductions';
    protected $primaryKey = 'id';
    protected $fillable = ['title','detail','is_link'];
 	public $timestamps = false;
}

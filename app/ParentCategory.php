<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParentCategory extends Model
{
 	protected $table = 'parent_categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name','picture'];
     public $timestamps = false;

    public function checkNameP($name,$id){
    	$checkName = ParentCategory::where('name',$name)->where('id','!=',$id)->get();
    	if(count($checkName) > 0){
            return false;
        }else{
            return true;
        }
    }

    
}

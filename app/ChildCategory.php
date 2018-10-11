<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    protected $table = 'child_categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name','parent_id','content','price'];
     public $timestamps = false;

    public function getChildsOfParent($id){
    	return ChildCategory::select('child_categories.*')
    				->where('parent_id',$id)->get();
    }
    public  function countChildOfParent($parent_id){
        return ChildCategory::select('child_categories.*')
                    ->where('parent_id',$parent_id)->count();
    }
    public function checkNameC($name,$id){
    	$checkName = ChildCategory::where('name',$name)->where('id','!=',$id)->get();
    	if(count($checkName) > 0){
            return false;
        }else{
            return true;
        }
    }

}

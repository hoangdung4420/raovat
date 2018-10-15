<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AddParentCatRequest;
use App\Http\Requests\AddChildCatRequest;
use App\ParentCategory;
use App\ChildCategory;

class CategoryController extends Controller
{

	public function __construct(ParentCategory $mParentCategory, ChildCategory $mChildCategory){
		
		$this->mParentCategory = $mParentCategory;
		$this->mChildCategory = $mChildCategory;

	}
//parent cat
    public function indexParent(){
    	$title = "QL-Danh mục";
    	$parentCats = ParentCategory::all();
    	return view('admin.category.indexParent',['title'=>$title,'parentCats'=>$parentCats]);
    }
    public function getAddParent(){
    	$title = "QL-Danh mục";
    	return view('admin.category.addparent',['title'=>$title]);
    }
    public function postAddParent(AddParentCatRequest $req){
    	//lưu hình ảnh
        $picture = $req->picture;

    	if($picture != '')
        {
          $tmp = $req->file('picture')->store('files');
          $arTmp = explode('/', $tmp);
          $picture = end($arTmp);
        }

        $ar = [
        	'name'=>$req->name,
        	'picture'=>$picture,
        ];

        $result = ParentCategory::insert($ar);

        if($result){
        	return redirect()->route('admin.category.indexparent')->with('success','Thêm thành công');
        }else{
        	return redirect()->back()->with('fail','Thêm thất bại');
        }
    }

     public function getEditParent($id){
    	$title = "QL-Danh mục";
    	$parentCat = ParentCategory::findOrFail($id);
    	return view('admin.category.editparent',['title'=>$title,'parentCat'=>$parentCat ]);
    }

    public function postEditParent(Request $req,$id){
    	if($req->name == ''){
    		return redirect()->back()->with('fail','Bạn phải thêm tên danh mục');
    	}
    	//kiểm tra tên danh mục cha đã tồn tại chưa
    	if(!$this->mParentCategory->checkNameP($req->name,$id)){
    		return redirect()->back()->with('fail','Tên danh mục đã tồn tại');
    	}

    	$obj = ParentCategory::findOrFail($id);
    	$obj->name = $req->name;
    	$picture = $req->picture;
    	if($picture != '')
        {
          $tmp = $req->file('picture')->store('files');
          $arTmp = explode('/', $tmp);
          $picture = end($arTmp);
          if($obj->picture != ''){
          	Storage::delete('files/'.$obj->picture); //xóa hình cũ
          }
          $obj->picture = $picture;
        }

        if($obj->save()){
        return redirect()->back()->with('success','Sửa thành công');
        }else{
        	return redirect()->back()->with('fail','Sửa thất bại');
        }
    }

    public function delParent($id){
    	$obj = ParentCategory::findOrFail($id);
    	//kiểm tra có danh mục con ko
    	$count = $this->mChildCategory->countChildOfParent($id);
    	if($count > 0){
    		$text = 'Bạn phải xóa hết các danh mục con của '.$obj->name;
    		return redirect()->back()->with('fail',$text);
    	}else{
    		if($obj->picture != ''){
	          	Storage::delete('files/'.$obj->picture); //xóa hình cũ
	          }

    		$obj->delete();
    		return redirect()->back()->with('success','Xóa thành công');
    	}
    }

    //child cat
    public function indexChild($id){
    	$title = "QL-Danh mục";
    	$parentCat = ParentCategory::findOrFail($id);
    	$childCats = $this->mChildCategory->getChildsOfParent($id);
    	return view('admin.category.indexchild',['title'=>$title,'parentCat'=>$parentCat,'childCats'=>$childCats]);
    }
    
    public function getAddChild(){
    	$title = "QL-Danh mục";
    	return view('admin.category.addchild',['title'=>$title]);
    }

    public function postAddChild(AddChildCatRequest $req){
    	$ar = [
    		'name'=> $req->name,
    		'parent_id'=>$req->parent_id,
    		'price'=> $req->price,
    		'content'=>$req->content
    	];

    	$result = ChildCategory::insert($ar);
      
    	if($result){
        	return redirect()->route('admin.category.indexchild',$req->parent_id)->with('success','Thêm thành công');
        }else{
        	return redirect()->back()->with('fail','Thêm thất bại');
        }

    }

    public function getEditChild($id){
    	$title = "QL-Danh mục";
    	$childCat = ChildCategory::findOrFail($id);
    	return view('admin.category.editchild',['title'=>$title,'childCat'=>$childCat]);
    }

   public function postEditChild(Request $req, $id){
   		if(!$this->mChildCategory->checkNameC($req->name,$id)){
   			return redirect()->back()->with('fail','Tên danh mục đã tồn tại');
   		}
   		$obj = ChildCategory::findOrFail($id);
   		$obj->name=  $req->name;
   		$obj->parent_id=  $req->parent_id;
   		$obj->price=  $req->price;
   		$obj->content=  $req->content;
   		if($obj->save()){
   			return redirect()->back()->with('success','Sửa thành công');
   		}else{
   			return redirect()->back()->with('fail','Sửa thất bại');
   		}
   }

   public function delChild($id){
   	$obj=ChildCategory::findOrFail($id);
   	$obj->delete();
   	return redirect()->back()->with('success','Xóa thành công');
   }

}

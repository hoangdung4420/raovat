<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\News;
use App\User;
class NewsController extends Controller
{
    public function index(){
    	$title = 'QL-Tin tức';
    	$news  = News::join('users','user_id','users.id')->select('news.*','users.username')->get();
    	return view('admin.news.index',['title'=>$title,'news'=> $news]);
    }
    public function getAdd(){
    	$title = 'QL-Tin tức';
    	return view('admin.news.add',['title'=>$title]);
    }
    public function postAdd(Request $req){
    	$title = 'QL-Tin tức';
    	$ar = [
    		'user_id'=>Auth::id(),
    		'title'=>$req->title,
    		'id_new_cat'=>$req->id_new_cat,
    		'detail'=>$req->detail,
    		'active'=>0
    	];
    	$result = News::insert($ar);
    	if($result){
    		return redirect()->route('admin.news.index')->with('success','Thành công');
    	}else{
    		return redirect()->back()->with('fail','Thất bại');
    	}
    }

    public function getEdit($id){
    	$title ="QL-Tin tức";
    	$news = News::findOrFail($id);
    	if(Auth::user()->role == 1 || Auth::id() == $news->user_id){
    		$user = User::findOrFail($news->user_id);
    		return view('admin.news.edit',['title'=>$title,'news'=>$news,'user'=>$user]);
    	}else{
    		return redirect()->back()->with('fail','Bạn không có quyền sửa tin này');
	    }	
    }

    public function postEdit(Request $req, $id){
    	$title ="QL-Tin tức";

    	$news = News::findOrFail($id);
    	if(Auth::user()->role == 1 || Auth::id() == $news->user_id){
	    	$news->title = $req->title;
	    	$news->id_new_cat = $req->id_new_cat;
	    	$news->detail = $req->detail;
	    	$result = $news->save();
	    	if($result){
	    		return redirect()->back()->with('success','Thành công');
	    	}else{
	    		return redirect()->back()->with('fail','Thất bại');
	    	}
	    }else{
	    		return redirect()->back()->with('fail','Bạn không có quyền sửa tin này');
	    }
    }

    public function del($id){
    	$news = News::findOrFail($id);
    	$result = $news->delete();
    	if($result){
    		return redirect()->back()->with('success','Thành công');
    	}else{
    		return redirect()->back()->with('fali','Thất bại');
    	}
    }

    public function changeActive(Request $req){
    	$id = $req->id;
    	$news = News::findOrFail($id);
    	if($news->active == 1){
    		$news->active = 0;
    		$html = '<p class="btn btn-danger status" onclick="return changeActive('.$id.')">disactive</p>';
    	}else{
    		$news->active = 1;
    		$html = '<p class="btn btn-success status" onclick="return changeActive('.$id.')">active</p>';
    	}
    	$news->save();
    	echo $html;
    }
}

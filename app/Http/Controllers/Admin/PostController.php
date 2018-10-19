<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\ChildCategory;
use App\ParentCategory;
use App\Post;
use App\Approval;

class PostController extends Controller
{
    public function index(){
    	$title = "QL-Tin rao vặt";
    	$posts = Post::join('users','posts.user_id','users.id')
	    			 ->join('approvals','posts.id','post_id')
	    			 ->select('posts.*','users.username','approvals.status')
	    			 ->get();
    	return view('admin.post.index',['title'=>$title,'posts'=>$posts]);
    }
}

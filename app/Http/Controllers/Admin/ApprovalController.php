<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Approval;
use App\User;

class ApprovalController extends Controller
{
	public function test(){
		$approvals = Post::join('approvals','posts.id','approvals.post_id')
    							->join('users','posts.user_id','users.id')
    							->select('approvals.*','approvals.user_id as user_approval','posts.title','posts.cat_id','posts.district_id','users.username as user_post');
    	return $approvals;
	}
	public function getUserApproval($approvals){
		$users = User::where('role','<',3)->get();
		foreach ($approvals as $approval) {
    			if($approval->user_approval != 0){
    				foreach($users as $user){
    					if(($approval->user_approval == $user->id)){
    						$approval->user_approval = $user->username;
    					}
		    		}
	    		}else{
	    			$approval->user_approval = 'chưa có';
	    		}
    	}
    	return $approvals;
	}
    public function index(){
    	$title = "QL-Duyệt Tin";
    	$approvals = $this->test()->get();
    	$approvals = $this->getUserApproval($approvals);
    	return view('admin.approval.index',['title'=>$title,'approvals'=>$approvals]);
    }

    public function indexWait(){
    	$title = "QL-Duyệt Tin";
    	$approvals = $this->test()->where('approvals.status',1)->get();		
    	$approvals = $this->getUserApproval($approvals);
    	return view('admin.approval.index',['title'=>$title,'approvals'=>$approvals]);
    }

    public function indexRefuse(){
    	$title = "QL-Duyệt Tin";
    	$approvals = $this->test();
    	if(Auth::user()->role == 2){
    		$approvals = $this->test()->where('approvals.user_id',Auth::id());
    	}
    	$approvals = $approvals->where('approvals.status',3)->get();		
    	$approvals = $this->getUserApproval($approvals);
    	return view('admin.approval.index',['title'=>$title,'approvals'=>$approvals]);
    }

    public function indexPost(){
    	$title = "QL-Duyệt Tin";
    	$approvals = $this->test();
    	if(Auth::user()->role == 2){
    		$approvals = $this->test()->where('approvals.user_id',Auth::id());
    	}
    	$approvals = $approvals->where('approvals.status',2)->get();		
    	$approvals = $this->getUserApproval($approvals);
    	return view('admin.approval.index',['title'=>$title,'approvals'=>$approvals]);
    }

    public function getApproval($id){
    	$title = "QL-Duyệt Tin";
    	$approval = Approval::findOrFail($id);
    	if($approval->user_id == 0){
    		$approval->user_id = Auth::id();
   			$approval->save();
    	}
    	$post = Post::join('users','user_id','posts.id')->select('posts.*','users.username')->get();
    	return view('admin.approval.approval',['title'=>$title,'approval'=>$approval,'post'=>$post]);
    }
}

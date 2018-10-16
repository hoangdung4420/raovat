<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\EditPostRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\ChildCategory;
use App\ParentCategory;
use App\Post;
use App\Approval;

class CustomerController extends Controller
{
	public function __construct(User $mUser,ChildCategory $mChildCategory){
		$this->mUser = $mUser;
        $this->mChildCategory = $mChildCategory;
	}

 /*===sửa thông tin tài khoản khách hàng=====*/
    public function getProfile(){
        $title = "Trang cá nhân";
    	return view('customer.profile',['title'=>$title]);
    }

    public function postProfile(Request $req){
    	$id = Auth::id();
    	$obj = User::findOrFail($id);
        $username = $req->username;
    	$email = $req->email;
    	$phone = $req->phone;
    	$picture = $req->picture;

    	//kiểm tra email đã tồn tại chưa
    	if(!$this->mUser->checkEmail($email,$id)){
    		return redirect()->back()->with('fail','Email đã tồn tại');
    	}
    	//kiểm tra số điện thoại 
    	if(!$this->mUser->checkPhone($phone,$id)){
    		return redirect()->back()->with('fail','Số điện thoại đã tồn tại');
    	}
    	//lưu hình ảnh
    	if($picture != '')
        {
            $tmp = $req->file('picture')->store('files');
            $arTmp = explode('/', $tmp);
            $picture = end($arTmp);
            if($obj->picture != ''){
              Storage::delete('files/'.$obj->picture); //xóa hình cũ nếu có
            }
            $obj->picture = $picture;
        }

        $obj->username=$username;
    	$obj->email = $email;
    	$obj->phone = $phone;
    	$obj->address = $req->address;
    	$result = $obj->save();
    	if($result){
    		return redirect()->back()->with('success','Cập nhật thành công');
    	}else{
    		echo 'error';
    	}
    }
/*===thay đổi mật khẩu====*/
    public function getChangePassword(){
        $title = "Thay đổi mật khẩu";
    	return view('customer.password',['title'=>$title]);
    }

    public function postChangePassword(ChangePasswordRequest $req){
    	$obj = User::findOrFail(Auth::id());
    	if(Hash::check($req->oldpass,$obj->password)){
    		$obj->password = bcrypt(trim($req->newpass));
    		$obj->save();
    		return redirect()->back()->with('success','Cập nhật thành công');
    	}else{
    		return redirect()->back()->with('fail','Mật khẩu cũ không đúng');
    	}
    }


/*===Sửa tin bị từ chối=====*/
public function editPost($name,$id){
    $post = Post::findOrFail($id);
    $approval = Approval::where('post_id',$id)->get();
    $title = $post->title;
    $childCat = ChildCategory::findOrFail($post->cat_id);
    $parentCat = ParentCategory::findOrFail($childCat->parent_id);
    return view('customer.editpost',['title'=>$title,'post'=>$post,'approval'=>$approval,'childCat'=>$childCat,'parentCat'=>$parentCat]);
}
public function savePost(EditPostRequest $req,$name,$id){
    $post = Post::findOrFail($id);
    $childCat = ChildCategory::findOrFail($post->cat_id);
    $post->district_id = $req->district_id;
    $post->village_id = $req->village_id;
    $post->street_id = ($req->street_id != 'a')?$req->street_id:0;
    $post->id_home = $req->id_home;
    /*$post->map = ?*/
     if($childCat->price == 2){
            $post->price1=$req->price1;
            $post->price2=$req->price2;
        }elseif($childCat->price == 1){
            $post->price1=$req->price1;
        }
    $post->title = $req->title;
    $post->detail = $req->detail;
    //pictures
    $pictures = $req->picture;
    if($pictures != ''){
       $listPicture='';
        foreach($pictures as $picture)
        {
          $tmp = $picture->store('files');
          $arTmp = explode('/', $tmp);
          
          $listPicture .= end($arTmp).'|';//lưu tên ảnh thành 1 chuỗi ngăn cách bằng dấu "|"
        }
        $listPicture = chop($listPicture,'|');//xóa kí tự '|' cuối cùng của chuỗi
        //xóa ảnh cũ
        if($post->pictures != ''){
            $ar = explode('|',$post->pictures);
            foreach ($ar as $value) {
                Storage::delete('files/'.$value);
            }

        }
        $post->pictures=$listPicture;
    }
    //nếu đổi tên
    if($req->username != Auth::user()->username){
        $user = User::findOrFail(Auth::id());
        $user->username = $req->username;
        $user->save();
    }
    $result = $post->save();

    if($result){
        return redirect()->route('customer.listrefuse')->with('success','Thành công');
    }
       

}
/*xoa tin*/
public function delPost($id){
    $post = Post::findOrFail($id);
    //xoa xet duyet
    $approval = Approval::where('post_id',$post->id)->get();
    $approval[0]->delete();
    //xóa ảnh cũ
    if($post->pictures != ''){
        $ar = explode('|',$post->pictures);
        foreach ($ar as $value) {
            Storage::delete('files/'.$value);
        }
    }
    $post->delete();
    return redirect()->route('customer.listrefuse')->with('success','Thành công');
}

/*===Xem danh sách tin=====*/
public function listPost(){
    $title = 'Danh sách tin đăng';
    $id = Auth::id();
    //so tin dang 
    $arPosts = Post::join('approvals','posts.id','post_id')->select('posts.*','approvals.status')->where('posts.user_id',$id)->where('status',2)->get();

    $post = new Post();
    $tinDang = $post->tinDang($id);
    $tinCho = $post->tinCho($id);
    $tinTuChoi = $post->tinTuChoi($id);

    return view('customer.list',
        [
            'title'=>$title,
            'arPosts'=>$arPosts,
            'tinDang'=>$tinDang,
            'tinCho'=>$tinCho,
            'tinTuChoi'=>$tinTuChoi,
        ]);
}

public function listRefuse(){
    $title = 'Danh sách tin bị từ chối';
    $id = Auth::id();
    //so tin dang 
    $arPosts = Post::join('approvals','posts.id','post_id')->select('posts.*','status','reason')->where('posts.user_id',$id)->where('status',3)->get();
    $post = new Post();
    $tinDang = $post->tinDang($id);
    $tinCho = $post->tinCho($id);
    $tinTuChoi = $post->tinTuChoi($id);
    return view('customer.list',
        [
            'title'=>$title,
            'arPosts'=>$arPosts,
            'tinDang'=>$tinDang,
            'tinCho'=>$tinCho,
            'tinTuChoi'=>$tinTuChoi,
        ]);
}

public function listWait(){
    $title = 'Danh sách tin bị từ chối';
    $id = Auth::id();
    //so tin dang 
    $arPosts = Post::join('approvals','posts.id','post_id')->select('posts.*','approvals.status')->where('posts.user_id',$id)->where('status',1)->get();
    $post = new Post();
    $tinDang = $post->tinDang($id);
    $tinCho = $post->tinCho($id);
    $tinTuChoi = $post->tinTuChoi($id);
    return view('customer.list',
        [
            'title'=>$title,
            'arPosts'=>$arPosts,
            'tinDang'=>$tinDang,
            'tinCho'=>$tinCho,
            'tinTuChoi'=>$tinTuChoi,
        ]);
}
/*===Xem lịch sử hỏi đáp=====*/

/*===Xem Tài khoản Coin=====*/

}

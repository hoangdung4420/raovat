<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ChangePasswordRequest;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\ChildCategory;
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


/*===Sửa tin đã lưu hoặc bị từ chối=====*/

/*===Sửa tin bị từ chối=====*/

/*===Xem danh sách tin=====*/
public function listPost(){
    $title = 'Danh sách tin đăng';
    $id = Auth::id();
    //so tin dang 
    $tinDang = Post::join('approvals','posts.id','post_id')->where('posts.user_id',$id)->where('status',2)->get();
    //so tin dang cho phe duyet
    $tinCho = Post::join('approvals','posts.id','post_id')->where('posts.user_id',$id)->where('status',1)->get();
    //so tin bij tu choi
    $tinChoi = Post::join('approvals','posts.id','post_id')->where('posts.user_id',$id)->where('status',0)->get();
    return view('customer.list',
        [
            'title'=>$title,
            'tinDang'=>$tinDang,
            'tinCho'=>$tinCho,
            'tinChoi'=>$tinChoi
        ]);
}
/*===Xem lịch sử hỏi đáp=====*/

/*===Xem Tài khoản Coin=====*/




}

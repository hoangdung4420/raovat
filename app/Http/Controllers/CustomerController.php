<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\User;

class CustomerController extends Controller
{
	public function __construct(User $mUser){
		$this->mUser = $mUser;
	}

    public function getRegister(){
        $title = "Đăng ký tài khoản";
        return view('customer.register',['title'=>$title]);
    }

    public function postRegister(){

    }

    public function getLogin(){
        $title = "Đăng nhập tài khoản";
    	return view('customer.login',['title'=>$title]);
    }

    public function postLogin(LoginRequest $request){
    	$username = $request->username;
		$password = $request->password;
        if(filter_var($username, FILTER_VALIDATE_EMAIL)){
            $result = Auth::attempt([
            'email' => $username,
            'password' => $password,
            'active' => 1,
            'role' =>3
        ]);
        }else{
            $result = Auth::attempt([
            'username' => $username,
            'password' => $password,
            'active' => 1,
            'role' =>3
             ]);
        }
		if($result){
			return redirect()->route('customer.getprofile')->with('success','Đăng nhập thành công');
		}
		else{
			return redirect()->route('customer.getlogin')->with('fail','Tài khoản không tồn tại');
		}
    }
 
    public function getProfile(){
        $title = "Trang cá nhân";
    	return view('customer.profile',['title'=>$title]);
    }

    public function postProfile(Request $req){
    	$id = Auth::id();
    	$obj = User::findOrFail($id);
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
}

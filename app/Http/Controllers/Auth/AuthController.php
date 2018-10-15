<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\AuthLoginRequest;
use Illuminate\Support\Facades\Auth;
use App\User;
class AuthController extends Controller
{
    public function __construct(User $mUser){
		$this->mUser = $mUser;
	}

	public function getLogin(){
		if(Auth::check() && Auth::user()->role < 3){
			return redirect()->route('auth.getprofile');
		}else{
			return view('auth.login');
		}
	} 

	public function postLogin(AuthLoginRequest $request){
		//đăng nhập của ban quản trị web
		$email = $request->email;
		$password = $request->password;

		$result = Auth::attempt([
			'email' => $email,
			'password' => $password,
			'active' => 1
		]);

		if($result && Auth::user()->role < 3){
			return redirect()->route('auth.getprofile')->with('success','Đăng nhập thành công');
		}else{
			return redirect()->route('auth.getlogin')->with('fail','Tài khoản không tồn tại');
		}
	}

	public function getProfile(){
		return view('auth.profile');
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
		return view('auth.password');
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

	public function logout(){
		Auth::logout();
		return redirect()->route('public.index');
	}

}

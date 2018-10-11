<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
class UserController extends Controller
{
    public function __construct(User $mUser){
        $this->mUser = $mUser;
    }

    public function index(){
        $title = "QL-người dùng";
        $users = User::where('role',3)->get();
        return view('admin.user.index',['title'=>$title,'users'=>$users]);
    }

    public function getAdd(){
        $title = "QL-người dùng";
        return view('admin.user.add',['title'=>$title]);
    }

    public function postAdd(AddUserRequest $req){
        $ar=[
            'username'=> $req->username,
            'password' => bcrypt(trim($req->password)),
            'email' =>$req->email,
            'phone' =>$req->phone,
            'address' =>$req->address,
            'picture' =>'',
            'role' => 3,
            'active'=>1
        ];
        if(Auth::user()->role == 1){
            $ar['role'] = $req->role;
        }
        if($req->picture != '')
        {
          $tmp = $req->file('picture')->store('files');
          $arTmp = explode('/', $tmp);
          $picture = end($arTmp);
          $ar['picture'] = $picture;
        }
        $result = $this->mUser->insert($ar);
        if($result){
            return redirect()->route('admin.user.index')->with('success','Thêm thành công');
        }else{
            return redirect()->back()->with('fail','Thêm thất bại');
        }

    }

    public function  getEdit($id){
        $title = "QL-người dùng";
        $user = User::findOrFail($id);
        return view('admin.user.edit',['title'=>$title, 'user'=>$user]);
    }
    public function postEdit(Request $req,$id){
    	$obj = User::findOrFail($id);
    	
        //kiểm tra email đã tồn tại chưa
    	if(!$this->mUser->checkUsername( $req->username,$id)){
            return redirect()->back()->with('fail','Tên người dùng đã tồn tại');
        }
        //kiểm tra email đã tồn tại chưa
        if(!$this->mUser->checkEmail( $req->email,$id)){
            return redirect()->back()->with('fail','Email đã tồn tại');
        }
        //kiểm tra số điện thoại 
        if(!$this->mUser->checkPhone( $req->phone,$id)){
            return redirect()->back()->with('fail','Số điện thoại đã tồn tại');
        }
    	//lưu hình ảnh
        $picture = $req->picture;
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
        //kiểm tra có lưu mật khẩu ko
        $password = $req->password;
        if($password != ''){
            $obj->password = bcrypt(trim($password));
        }
        
        $obj->username = $req->username;
    	$obj->email = $req->email;
    	$obj->phone = $req->phone;
        $obj->address = $req->address;
    	if($req->active){
            $obj->active = 0;
        }
        if(Auth::user()->role==1){
            $obj->role = $req->role;
        }
    	$result = $obj->save();
    	if($result){
    		return redirect()->back()->with('success','Cập nhật thành công');
    	}else{
    		echo 'error';
    	}
    }

    public function del($id){
        $obj = User::findOrFail($id);
        
        if($obj->role != 1){
            if($obj->picture != ''){
                Storage::delete('files/'.$obj->picture); //xóa hình cũ nếu có
            }
            $result = $obj->delete();
            if($result){
                return redirect()->route('admin.user.index')->with('success','Xóa thành công');
            }else{
                echo 'error';
            }
        }else{
             return redirect()->route('admin.user.index')->with('fail','Không thể xóa admin');
        }
        
    }
}

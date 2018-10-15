<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\AddPostRequest;


use App\User;
use App\ChildCategory;
use App\ParentCategory;
use App\District;
use App\Village;
use App\Street;
use App\Post;
use App\Picture;
use App\Approval;

class PageController extends Controller
{
	public function __construct(User $mUser,ChildCategory $mChildCategory, ParentCategory $mParentCategory){
        $this->mUser = $mUser;
        $this->mChildCategory = $mChildCategory;
        $this->mParentCategory = $mParentCategory;
    }

	/*===Đăng ký tài khoản=====*/
    public function getRegister(){
        $title = "Đăng ký tài khoản";
        return view('public.register',['title'=>$title]);
    }

    public function postRegister(RegisterRequest $req){
        $email = $req->email;
        $password = $req->password;
        $username = 'User'.time();
        $ar = [
            'username'=>$username,
            'email'=>$email,
            'password'=>bcrypt(trim($password)),
            'role'=>3,
            'active'=>1
        ];
        if($this->mUser->insert($ar)){
            ///gửi mail cho người dùng?
            $result = Auth::attempt([
            'email' => $email,
            'password' => $password,
             ]);
            return redirect()->route('customer.getprofile')->with('success','Đăng ký thành công');
        }else{
            return redirect()->back()->with('fail','error');
        }
    }
/*===Đăng nhập tài khoản khách hàng=====*/
    public function getLogin(){
        $title = "Đăng nhập tài khoản";
    	return view('public.login',['title'=>$title]);
    }

    public function postLogin(LoginRequest $request){
    	$email = $request->email;
		$password = $request->password;
        $result = Auth::attempt([
            'email' => $email,
            'password' => $password,
            'active' => 1,
            'role' =>3
        ]);
		if($result){
			return redirect()->route('customer.getprofile')->with('success','Đăng nhập thành công');
		}
		else{
			return redirect()->back()->with('fail','Tài khoản không tồn tại');
		}
    }
/*===Thêm tin=====*/
public function getPost1(){
    $title = "Đăng tin";
    return view('public.post1',['title'=>$title]);
}

public function getPost2($id,Request $req){
    $title = "Đăng tin";
    $childCat = ChildCategory::findOrFail($id);
    $req->session()->put('oldCat',$childCat);
    $parentCat = ParentCategory::findOrFail($childCat->parent_id);
    return view('public.post2',['title'=>$title,'childCat'=>$childCat,'parentCat'=>$parentCat]);
}

public function postPost2(AddPostRequest $req){
    //Kiểm tra có đăng nhập ko
    if(!Auth::check()){
        $email = $req->email;
        if($this->mUser->checkExistEmail($email)){
            $username = $req->username;
            //tạo tài khoản
            $newUser = [
                'username'=>$username,
                'email'=>$email,
                'password'=>bcrypt('123456'),
                'role'=>3,
                'active'=>1
            ];
            $id = User::insertGetId($newUser);
            //đăng nhập luôn
            $result = Auth::attempt([
                'email' => $email,
                'password' => '123456',
            ]);
            $req->session()->flash('newbie',true);
        }else{
            return redirect()->back()->with('fail','Email này đã được sử dụng');
            //có thể lưu toàn bộ thông tin vào mảng session, chuyển đếp xác nhận mật khẩu cho tài khoản, sau 1 thời gian ko xác nhận đk thì xóa mảng?
        }
    }else{
        $id = Auth::id();
        $username = $req->username;
        if($username != Auth::user()->username){
            //cập nhật username
            $user = User::findOrFail($id);
            $user->username = $username;
            $user->save();
        }
    }
    $arPost =[
            'cat_id'=>$req->cat_id,
            'district_id'=>$req->district_id,
            'village_id'=>$req->village_id,
            'id_home'=>$req->id_home,
            'title'=>$req->title,
            'detail'=>$req->detail,
            'user_id'=>$id,
            'view'=>0,
        ];
        if($req->street_id != 'a'){
            $arPost['street_id']=$req->street_id;
        }
        $cat = ChildCategory::findOrFail($req->cat_id);
        if($cat->price == 2){
            $arPost['price1']=$req->price1;
            $arPost['price2']=$req->price2;
        }elseif($cat->price == 1){
            $arPost['price1']=$req->price1;
        }
       $post_id =Post::insertGetId($arPost);
    //lưu ảnh
       $pictures = $req->picture;
        foreach($pictures as $picture)
        {
          $tmp = $picture->store('files');
          $arTmp = explode('/', $tmp);
          $picture = end($arTmp);
          
          $arPicture = [
            'post_id'=>$post_id,
            'name'=>$picture
          ];
          Picture::insert($arPicture);
        }
    //lưu vào bảng phê duyệt
        $arApproval = [
            'post_id'=>$post_id,
            'status'=> 1
        ];
        Approval::insert($arApproval);
    //
    return redirect()->route('customer.listpost')->with('suceess','Đăng tin thành công');
}
public function getChildCat(Request $req){
    $id = $req->id;
    $childsOfParent = ChildCategory::where('parent_id',$id)->pluck('name','id')->toArray();
    echo json_encode($childsOfParent) ;
    /*return view('public.childcat',['childsOfParent'=>$childsOfParent]);*/
}
public function changeCat(){
    return redirect()->route('public.getpost1')->with('change',true);
}

public function changeDistrict(Request $req){
    $districtId = $req->district_id;
    $villages = Village::where('district_id',$districtId)->pluck('name','id')->toArray();
    echo json_encode($villages);
}

public function changeVillage(Request $req){
    //do ko tim đk database nen liet ke ten dương theo quan huyen
    $district_id = $req->district_id;
    $streets = Street::where('district_id',$district_id)->orderBy('name','DESC')->pluck('name','id')->toArray();
    echo json_encode($streets);
}
public function getTest(){
    return view('public.testsuastreet');
}
public function postTest(Request $req){
    $name = $req->name;
    $village_id = $req->village_id;
    $ar = explode(', ',$name);
        //dd($ar);
    foreach($ar as $val){
        $item = [
            'name'=>$val,
            'district_id'=>$village_id
        ];
        Street::insert($item);
    }
    return redirect()->back();

}
/*===Trang chủ=====*/
public function index(){
    return view('public.index');
}
/*===Trang danh mục=====*/
public function cat(){
    return view('public.cat');
}
/*===Trang chi tiết tin=====*/
public function detail(){
    return view('public.detail');
}

    
}

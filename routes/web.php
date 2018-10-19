<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::pattern('id','[0-9]+');
Route::pattern('name','(.*)');

Route::group(['prefix'=>'qt','namespace'=>'Auth'], function(){
	Route::get('login', 'AuthController@getLogin')->name('auth.getlogin');

	Route::post('login', 'AuthController@postLogin')->name('auth.postlogin');

	Route::get('profile', [
		'uses'=>'AuthController@getProfile',
		'as'=>'auth.getprofile'
	])->middleware('auth');

	Route::post('profile', [
		'uses'=>'AuthController@postProfile',
		'as'=>'auth.postprofile'
	])->middleware('auth');

	Route::get('change-password', [
		'uses'=>'AuthController@getChangePassword',
		'as'=>'auth.getchangepassword'
	])->middleware('auth');

	Route::post('change-password', [
		'uses'=>'AuthController@postChangePassword',
		'as'=>'auth.postchangepassword'
	])->middleware('auth');

	Route::get('logout', 'AuthController@logout')->name('auth.logout');
});

Route::group(['prefix'=>'taikhoancanhan','middleware'=>'auth'], function(){
	Route::get('thongtincanhan','CustomerController@getProfile')->name('customer.getprofile');
	Route::post('thongtincanhan','CustomerController@postProfile')->name('customer.postprofile');
	Route::get('thaydoimatkhau', 'CustomerController@getChangePassword')->name('customer.getchangepassword');
	Route::post('thaydoimatkhau', 'CustomerController@postChangePassword')->name('customer.postchangepassword');

	Route::get('danhsachtindang','CustomerController@listPost')->name('customer.listpost');
	Route::get('danhsachtinbituchoi','CustomerController@listRefuse')->name('customer.listrefuse');
	Route::get('danhsachtinchoduyet','CustomerController@listWait')->name('customer.listwait');
	Route::get('suatin/{name}-{id}','CustomerController@editPost')->name('customer.editpost');
	Route::post('luutin/{name}-{id}','CustomerController@savePost')->name('customer.savepost');
	Route::get('xoatin/{id}','CustomerController@delPost')->name('customer.delpost');
	//còn list tin đã lưu, cho xóa tin đã lưu khỏi bảng save
	//hiển thị danh sách câu hỏi, ajax load ra các câu trả lời->ko cho xóa, sửa
	//quản lý tài khoản coin

});

Route::group(['prefix' => ''], function(){
	//trang public
	Route::get('dangky','PageController@getRegister')->name('public.getregister');
	Route::post('dangky','PageController@postRegister')->name('public.postregister');

	Route::get('dangnhap','PageController@getLogin')->name('public.getlogin');
	Route::post('dangnhap','PageController@postLogin')->name('public.postlogin');

	Route::get('dangtin/b1','PageController@getPost1')->name('public.getpost1');
	Route::get('dangtin/{id}/b2','PageController@getPost2')->name('public.getpost2');
	Route::post('dangtin/{id}/b2','PageController@postPost2')->name('public.postpost2');
	Route::get('childcat','PageController@getChildCat')->name('public.childcat');
	Route::get('changecat','PageController@changeCat')->name('public.changecat');

	Route::get('changedistrict','PageController@changeDistrict')->name('public.changedistrict');
	Route::get('changevillage','PageController@changeVillage')->name('public.changevillage');
	Route::get('test','PageController@getTest')->name('public.gettest');//nháp
	Route::post('test','PageController@postTest')->name('public.posttest');//nháp

	Route::get('/', 'PageController@index')->name('public.index'); //chưa làm

	Route::get('/cat', 'PageController@cat')->name('public.cat');//chưa làm

	Route::get('/detail', 'PageController@detail')->name('public.detail');//chưa làm
});

Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>'auth'], function(){
	//Trang quản lý
	Route::group(['prefix'=>'user'], function(){
		Route::get('index', 'UserController@index')->name('admin.user.index');
		Route::get('changeactive','UserController@changeActive')->name('admin.user.changeactive');
		Route::get('add', 'UserController@getAdd')->name('admin.user.getadd');
		Route::post('add', 'UserController@postAdd')->name('admin.user.postadd');
		Route::get('edit/{id}', 'UserController@getEdit')->name('admin.user.getedit');
		Route::post('edit/{id}', 'UserController@postEdit')->name('admin.user.postedit');
		Route::get('del/{id}', 'UserController@del')->name('admin.user.del');
	});
	Route::group(['prefix'=>'category'], function(){
		//parent cat
		Route::get('indexparent','CategoryController@indexParent')->name('admin.category.indexparent');
		Route::get('addparent','CategoryController@getAddParent')->name('admin.category.getaddparent');
		Route::post('addparent','CategoryController@postAddParent')->name('admin.category.postaddparent');
		Route::get('editparent/{id}','CategoryController@getEditParent')->name('admin.category.geteditparent');
		Route::post('editparent/{id}','CategoryController@postEditParent')->name('admin.category.posteditparent');
		Route::get('delparent/{id}','CategoryController@delParent')->name('admin.category.delparent');
		//child cat
		Route::get('indexchild/{id}','CategoryController@indexChild')->name('admin.category.indexchild');
		Route::get('addchild','CategoryController@getAddChild')->name('admin.category.getaddchild');
		Route::post('addchild','CategoryController@postAddChild')->name('admin.category.postaddchild');
		Route::get('editchild/{id}','CategoryController@getEditChild')->name('admin.category.geteditchild');
		Route::post('editchild/{id}','CategoryController@postEditChild')->name('admin.category.posteditchild');
		Route::get('delchild/{id}','CategoryController@delChild')->name('admin.category.delchild');
	});
	Route::group(['prefix'=>'post'],function(){
		Route::get('','PostController@index')->name('admin.post.index');
	});
	Route::group(['prefix'=>'news'],function(){
		Route::get('','NewsController@index')->name('admin.news.index');
		Route::get('add','NewsController@getAdd')->name('admin.news.getadd');
		Route::post('add','NewsController@postAdd')->name('admin.news.postadd');
		Route::get('edit/{id}','NewsController@getEdit')->name('admin.news.getedit');
		Route::post('edit/{id}','NewsController@postEdit')->name('admin.news.postedit');
		Route::get('del/{id}','NewsController@del')->name('admin.news.del');
		Route::get('change-active','NewsController@changeActive')->name('admin.news.changeactive');
	});
	Route::group(['prefix'=>'introduction'], function(){
		Route::get('index','IntroductionController@index')->name('admin.introduction.index');
		Route::get('edit/{id}','IntroductionController@getEdit')->name('admin.introduction.getedit');
		Route::post('edit/{id}','IntroductionController@postEdit')->name('admin.introduction.postedit');

	});

	Route::group(['prefix'=>'approval'],function(){
		Route::get('','ApprovalController@index')->name('admin.approval.index');
		Route::get('wait','ApprovalController@indexWait')->name('admin.approval.indexwait');
		Route::get('refuse','ApprovalController@indexRefuse')->name('admin.approval.indexrefuse');
		Route::get('post','ApprovalController@indexPost')->name('admin.approval.indexpost');
		Route::get('approval/{id}','ApprovalController@getApproval')->name('admin.approval.approval');
	});

});


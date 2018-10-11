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

Route::group(['namespace'=>'Admin','prefix'=>'admin'], function(){
	Route::group(['prefix'=>'user'], function(){
		Route::get('index', 'UserController@index')->name('admin.user.index');
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
});

Route::group(['prefix'=>'taikhoan'], function(){
	Route::get('dangky','CustomerController@getRegister')->name('customer.getregister');
	
	Route::get('dangnhap','CustomerController@getLogin')->name('customer.getlogin');
	Route::post('dangnhap','CustomerController@postLogin')->name('customer.postlogin');
	Route::get('thongtincanhan','CustomerController@getProfile')->name('customer.getprofile');
	Route::post('thongtincanhan','CustomerController@postProfile')->name('customer.postprofile');
	Route::get('thaydoimatkhau', 'CustomerController@getChangePassword')->name('customer.getchangepassword');
	Route::post('thaydoimatkhau', 'CustomerController@postChangePassword')->name('customer.postchangepassword');
});

Route::group(['prefix' => ''], function(){
	//trang public
	Route::get('/', 'PageController@index')->name('public.index');

	Route::get('/cat', 'PageController@cat')->name('public.cat');

	Route::get('/detail', 'PageController@detail')->name('public.detail');
});


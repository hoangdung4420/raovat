<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Introduction;
class IntroductionController extends Controller
{
   public function index(){
   	$title = "QL-Giới thiệu";
   	$introductions = Introduction::get();
   	return view('admin.introduction.index',['title'=>$title,'introductions'=>$introductions]);
   }
   public function getEdit($id){
   	$title = "QL-Giới thiệu";
   	$intro = Introduction::findOrFail($id);
   	return view('admin.introduction.edit',['title'=>$title,'intro'=>$intro]);
   }
   public function postEdit(Request $req, $id){
   	$intro = Introduction::findOrFail($id);
   	$intro->detail = $req->detail;
   	$intro->save();
   	return redirect()->route('admin.introduction.index')->with('success','Thành công');
   }
}

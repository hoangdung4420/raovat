<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index(){
    	return view('public.index');
    }

    public function cat(){
    	return view('public.cat');
    }

    public function detail(){
    	return view('public.detail');
    }

    
}

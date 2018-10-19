<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="{{$AdminUrl}}/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="{{$AdminUrl}}/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>{{ isset($title)?$title:'Trang quản lý' }}</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{$AdminUrl}}/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{$AdminUrl}}/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{$AdminUrl}}/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{$AdminUrl}}/css/demo.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{$AdminUrl}}/css/themify-icons.css" rel="stylesheet">

    <script src="{{$AdminUrl}}/js/jquery-1.10.2.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

    <script src="/public/ckeditor/ckeditor.js"></script>
      <link rel="stylesheet" href="{{$AdminUrl}}/css/custom.css" type="text/css">

</head>
<body>

<div class="wrapper">
	<div class="sidebar" data-background-color="white" data-active-color="danger">
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="" class="simple-text alert-warning">AdminCP</a>
            </div>

            <ul class="nav">
                <li class="{{Request::is('*user*')?'active':''}}">
                    <a href="{{ route('admin.user.index') }}">
                        <i class="ti-user"></i>
                        <p>Người Dùng</p>
                    </a>
                </li>
            	<li class="{{Request::is('*category*')?'active':''}}">
                    <a href="{{ route('admin.category.indexparent')}}">
                        <i class="ti-map"></i>
                        <p>Danh mục sản phẩm</p>
                    </a>
                </li>
                <li class="{{Request::is('*post*')?'active':''}}">
                    <a href="{{route('admin.post.index')}}">
                        <i class="ti-view-list"></i>
                        <p>Tin Rao Vặt(thiếu add,edit,del)</p>
                    </a>
                </li>
                <li class="{{Request::is('*approval*')?'active':''}}">
                    <a href="{{route('admin.approval.index')}}">
                        <i class="ti-pencil-alt"></i>
                        <p>Duyệt Tin (phần edit chưa xong)</p>
                    </a>
                </li>
                <li>
                    <a href="index.html">
                        <i class="ti-comment"></i>
                        <p class="text-warning">Hỏi/Đáp</p>
                    </a>
                </li>
                <li class="{{ (Request::is('*news*')?'active':'') }}">
                    <a href="{{Route('admin.news.index')}}">
                        <i class="ti-rss-alt"></i>
                        <p>Tin tức</p>
                    </a>
                </li>
                
                <li class="{{Request::is('*introduction*')?'active':''}}">
                    <a href="{{ route('admin.introduction.index')}}">
                        <i class="ti-home"></i>
                        <p>Giới thiệu Website</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand " href="{{ route('auth.getprofile') }}" title="Xem trang cá nhân" >Xin chào, {{ Auth::user()->username }}</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
						<li class="text-center">
                            <a  href="{{ route('auth.logout') }}">
								<p>Thoát</p>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>


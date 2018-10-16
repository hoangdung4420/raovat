<!DOCTYPE html>
<html lang="en">
<head>
  <title>{{ isset($title)?$title:'Rao vặt' }}</title>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" sizes="96x96" href="{{$PublicUrl}}/img/icon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{$AdminUrl}}/css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="{{$AdminUrl}}/css/custom.css" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <script src="{{$AdminUrl}}/js/jquery-1.10.2.js" type="text/javascript"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    
 <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
  <script src="/public/ckeditor/ckeditor.js"></script>
</head>
<body>

<div class="navbar navbar-add navbar-inverse navbar-fixed-top " role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('public.index') }}" style="size: 250px"><img src="{{$PublicUrl}}/img/raovat.png" alt="" class="img-responsive" width="150px" /></a>
    </div>
    <div class="collapse navbar-collapse pull-right">
      <ul class="nav navbar-nav">
        <li class="active" width="100px"><a href="#">	
<i class="fa fa-search"> </i> Tìm Kiếm</a></li>
        <li ><a href="#">Trợ giúp</a></li>
        <li>
          <a href="{{route('public.getpost1')}}" class="btn btn-warning" style="padding: 5px;margin-top: 10px" id="send_post">Đăng tin</a>
        </li>
        @if(Auth::check())
        	@if(Auth::user()->role < 3)
       	 		<li><a href="{{ route('auth.getprofile') }}">Trang cá nhân</a></li>
       	 	@else 
       	 		<li><a href=" {{ route('customer.getprofile')}} ">Trang cá nhân</a></li>
       	 	@endif

        <li><a href="{{ route('auth.logout') }}">Thoát</a></li>
        @else
        <li><a href="{{ route('public.getregister')}}">Đăng ký</a></li>
        <li><a href="{{ route('public.getlogin') }}">Đăng nhập</a></li>
        @endif
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>		
<div style="height: 80px">
  
</div>



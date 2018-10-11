@extends('templates.admin.master')
@section('content')
<div class="card">
    <div class="header">
        <h4 class="title">Đổi mật khẩu <a href="{{ route('auth.getprofile') }}" class="alert alert-success"> Trang cá nhân</a></h4>
    </div>
    <div class="content">
        @if(session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>

         @elseif(session('fail'))
            <p class="alert alert-danger">{{ session('fail') }}</p>
        @endif
        <form action="" method="post" >
        {{ csrf_field() }}
          @if($errors->any()) 
            <div class="alert alert-danger">
                <ul>
                @foreach($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
                </ul>
            </div>
            @endif
        <div class="row">
            <div class="col-md-4 text-center">
            </div>
            <div class="col-md-6">
                <div class="">
                    <div class="form-group">
                        <input type="password" name="oldpass" class="form-control border-input" placeholder="Mật khẩu cũ" value="" >
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <input type="password" name="newpass" class="form-control border-input" placeholder="Mật khẩu mới" value="">
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <input type="password" name="repass" class="form-control border-input" placeholder="Mật khẩu xác nhận" value="">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center">
            <input type="submit" class="btn btn-info btn-fill btn-wd" value="Thực hiện" />
        </div>
        <div class="clearfix"></div>
    </form>
    </div>
</div>
@stop
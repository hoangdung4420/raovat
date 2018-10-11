@extends('templates.admin.master')
@section('content')
<div class="card">
    <div class="header">
        <h4 class="title">Thêm người dùng</h4>
    </div>
    <div class="content">
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if(session('fail'))
                <p class="danger">{{ session('fail') }}</p>
            @endif
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
                <div class="col-md-4">
                    <div class="form-group text-center">
                        <img src="{{$AdminUrl}}/img/tim_80x80.png" width="120px" alt="" /> 
                        <input type="file" name="picture" class="form-control" placeholder="Chọn ảnh"  />
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Tên người dùng</label>
                        <input type="text" name="username" class="form-control border-input" placeholder="Họ tên" value="{{old('username')}}">
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="password" name="password" class="form-control border-input" placeholder="Mật khẩu" value="">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control border-input" placeholder="email" value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" name="phone" class="form-control border-input" placeholder="Số điện thoại" value="{{old('phone')}}">
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" name="address" class="form-control border-input" placeholder="Địa chỉ" value="{{old('address')}}">
                    </div>
                    <div class="form-group">
                        <label>Cấp bậc</label>
                        <select name="role" class="form-control border-input">
                            @if(Auth::user()->role ==1)
                            <option value="1" {{(old('role')==1)?'selected':''}}>Admin</option>
                            <option value="2" {{(old('role')==2)?'selected':''}}>Mod</option>
                            @endif
                            <option value="3" {{(old('role')==3)?'selected':''}}>Customer</option>
                        </select>
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
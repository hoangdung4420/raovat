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
                <p class="alert alert-danger">{{ session('fail') }}</p>
            @elseif(session('success'))
                <p class="alert alert-success">{{ session('success') }}</p>
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
                        @if($user->picture != '')
                        <img src="/storage/app/files/{{$user->picture}}" class="img-responsive displayImg" alt="" />
                        @else 
                        <img src="{{$AdminUrl}}/img/tim_80x80.png" class="img-responsive displayImg" alt="" /> 
                        @endif
                        <input type="file" name="picture" class="form-control inputImg" placeholder="Chọn ảnh" />
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Khóa tài khoản</label>
                        <input type="checkbox" name="active" {{($user->active==1)?'':'checked'}} value="1" />
                    </div>
                    <div class="form-group">
                        <label>Tên người dùng</label>
                        <input type="text" name="username" class="form-control border-input" placeholder="Họ tên" value="{{$user->username}}" >
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="password" name="password" class="form-control border-input" placeholder="Mật khẩu" value="">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control border-input" placeholder="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" name="phone" class="form-control border-input" placeholder="Số điện thoại" value="{{$user->phone}}">
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" name="address" class="form-control border-input" placeholder="Địa chỉ" value="{{$user->address}}">
                    </div>
                    <div class="form-group">
                        <label>Cấp bậc</label>
                        <select name="role" class="form-control border-input" >
                            @if(Auth::user()->role ==1)
                            <option value="1" {{ ($user->role == 1)?'selected':'' }}>Admin</option>
                            <option value="2" {{ ($user->role == 2)?'selected':'' }}>Mod</option>
                            @endif
                            <option value="3" {{ ($user->role == 3)?'selected':'' }}>Customer</option>
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
<script>
    //upload 1 ảnh
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('.displayImg').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$(".inputImg").change(function() {
  readURL(this);
});
</script>
@stop
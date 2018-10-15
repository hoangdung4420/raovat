@extends('templates.admin.master')
@section('content')
<div class="card">
    <div class="header">
        <h4 class="title">Trang cá nhân <a href="{{ route('auth.getchangepassword') }}" class="alert alert-success"> Đổi mật khẩu</a> </h4>
    </div>
    <div class="content" >
         @if(session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if(session('fail')) 
                <div class="alert alert-danger">
                    {{ session('fail') }}
                </div>
                @endif
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="form-group" >
                        @if(Auth::user()->picture == '')
                            <img src="{{$AdminUrl}}/img/tim_80x80.png" class="displayImg img-responsive" alt="" />
                        @else 
                            <img src="/storage/app/files/{{Auth::user()->picture}}" class="displayImg img-responsive" alt="" />
                        @endif
                        
                        <input type="file" name="picture" class="form-control inputImg" placeholder="Chọn ảnh" />
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="">
                        <div class="form-group">
                            <input type="text" name="email" class="form-control border-input" placeholder="email" value="{{ Auth::user()->email }}">
                        </div>
                    </div>
                    <div class="">
                        <div class="form-group">
                            <input type="text" name="phone" class="form-control border-input" placeholder="Số điện thoại" value="{{ Auth::user()->phone }}">
                        </div>
                    </div>
                    <div class="">
                        <div class="form-group">
                            <input type="text" name="address" class="form-control border-input" placeholder="Địa chỉ" value="{{ Auth::user()->address }}">
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="text-center">
                     <input type="submit" class="btn btn-info btn-fill btn-wd" value="Thực hiện" />
                </div>
            </div>
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
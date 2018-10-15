@extends('templates.public.master')
@section('content')
<br />
<br />
<br />
<div class="col-md-4">
	@include('customer.leftbar')
</div>
<div class="col-md-8">
  <h3 class="topic">Thông Tin Cá Nhân</h3>
  <div class="content">
  	 @if(session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        <form action="{{ route('customer.postprofile') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if(session('fail')) 
                <div class="alert alert-danger">
                    {{ session('fail') }}
                </div>
                @endif
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="form-group">
                        @if(Auth::user()->picture == '')
                            <img src="{{$AdminUrl}}/img/tim_80x80.png"  alt=""  class="displayImg img-responsive"  />
                        @else 
                            <img src="/storage/app/files/{{Auth::user()->picture}}" alt="" class="displayImg  img-responsive" />
                        @endif
                        
                        <input type="file" name="picture" class="form-control inputImg" placeholder="Chọn ảnh" />
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="">
                        <div class="form-group">
                            <input type="text" name="username" class="form-control border-input" placeholder="username" value="{{ Auth::user()->username }}" required="">
                        </div>
                    </div>
                    <div class="">
                        <div class="form-group">
                            <input type="text" name="email" class="form-control border-input" placeholder="email" value="{{ Auth::user()->email }}" required="">
                        </div>
                    </div>
                    <div class="">
                        <div class="form-group">
                            <input type="text" name="phone" class="form-control border-input" placeholder="Số điện thoại" value="{{ Auth::user()->phone }}" required="">
                        </div>
                    </div>
                    <div class="">
                        <div class="form-group">
                            <input type="text" name="address" class="form-control border-input" placeholder="Địa chỉ" value="{{ Auth::user()->address }}" required="">
                        </div>
                    </div>
                    <div class="">
                    	 <input type="submit" class="btn btn-lg btn-info btn-fill btn-wd" value="Thực hiện" />
                	</div>
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
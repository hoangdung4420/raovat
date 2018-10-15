@extends('templates.public.master')
@section('content')
<br />
<br />
<br />
<div class="col-md-4">
	@include('customer.leftbar')
</div>
<div class="col-md-8">
  <h3 class="topic">Danh sách tin của bạn</h3>
  <div class="content">
	@if(session('newbie'))
            <p class="alert alert-success">Bạn đã đăng tin thành công, chúng tôi sẽ nhanh chóng phê duyệt nó trước khi cho hiển thị. Một tài khoản được tại cho bạn với mật khẩu '123456'.Hãy xác nhận bằng tài khoản gmail dùng để đăng tin</p>
            @php 
				Session::forget('newbie')
            @endphp
	@endif

    Tin đăng: {{ count($tinDang) }} <br />
    Tin chờ: {{ count($tinCho) }} <br />
    Tin chối: {{ count($tinChoi) }} <br />
  </div>
</div>

@stop
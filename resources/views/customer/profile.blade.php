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
                            <img src="{{$AdminUrl}}/img/tim_80x80.png" width="120px" alt="" />
                        @else 
                            <img src="/storage/app/files/{{Auth::user()->picture}}" width="120px" alt="" />
                        @endif
                        
                        <input type="file" name="picture" class="form-control" placeholder="Chọn ảnh" />
                    </div>
                </div>
                <div class="col-md-8">
                	<div class="">
                		<label>{{ Auth::user()->username }}</label>
                	</div>
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
                    <div class="">
                    	 <input type="submit" class="btn btn-lg btn-info btn-fill btn-wd" value="Thực hiện" />
                	</div>
                </div>
                
            </div>
        </form>
  </div>
</div>

@stop
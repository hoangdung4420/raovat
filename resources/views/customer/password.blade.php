@extends('templates.public.master')
@section('content')
<br />
<br />
<br />
<div class="col-md-4">
	@include('customer.leftbar')
</div>
<div class="col-md-8">
  <h3 class="topic">Thay Đổi Mật Khẩu</h3>
  <div class="content">
  	 @if(session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>

    @elseif(session('fail'))
            <p class="alert alert-danger">{{ session('fail') }}</p>
        @endif
        <form action="" method="post" >
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
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
                    <div class="">
                        <div class="form-group">
                            <input type="password" name="oldpass" class="form-control border-input" placeholder="Mật khẩu cũ" value="" required="">
                        </div>
                    </div>
                    <div class="">
                        <div class="form-group">
                            <input type="password" name="newpass" class="form-control border-input" placeholder="Mật khẩu mới" value="" required="">
                        </div>
                    </div>
                    <div class="">
                        <div class="form-group">
                            <input type="password" name="repass" class="form-control border-input" placeholder="Xác nhận mật khẩu" value="" required="">
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
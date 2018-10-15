@extends('templates.public.master')
@section('content')

<div class="col-md-6 col-md-offset-3">
  <h3>Đăng nhập</h3>
  @if(session('fail'))
    <p>{!! session('fail') !!}</p>
@endif
  <div class="c-login">
  		<form action="" method="post">
            {!! csrf_field() !!}
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control border-input"  placeholder="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="password" name="password" class="form-control border-input" placeholder="password" value="" required>
                         @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div>
                <input type="submit" class="btn btn-info btn-fill btn-wd" value="Submit" />
                <input type="reset" class="btn btn-default btn-fill btn-wd" value="Reset" />
            </div>
            <div class="clearfix"></div>
        </form>
  </div>

  
</div>

@stop
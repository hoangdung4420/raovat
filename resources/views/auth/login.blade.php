<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{$AdminUrl}}/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{{$AdminUrl}}/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>AdminCP - VinaEnter</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{$AdminUrl}}/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{$AdminUrl}}/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{$AdminUrl}}/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{$AdminUrl}}/css/demo.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{$AdminUrl}}/css/themify-icons.css" rel="stylesheet">

</head>
<body>

<div class="container">
    <div class="header">
        <h4 class="title">Login</h4>
        @if(session('fail'))
            <p>{!! session('fail') !!}</p>
        @endif
    </div>
    <div class="content">
        <form action="{{route('auth.postlogin')}}" method="post">
            {!! csrf_field() !!}
            
            <div class="row">
                <div class="col-md-4 ">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control border-input"  placeholder="username" value="{{ old('username') }}" required autofocus>
                        @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                        @endif
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
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

</body>

    <!--   Core JS Files   -->
    <script src="{{$AdminUrl}}/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="{{$AdminUrl}}/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
    <script src="{{$AdminUrl}}/js/paper-dashboard.js"></script>

    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{$AdminUrl}}/js/demo.js"></script>

</html>
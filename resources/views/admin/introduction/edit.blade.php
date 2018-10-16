@extends('templates.admin.master')
@section('content')
<div class="card">
    <div class="header">
    </div>
    <div class="content">
        <form action="" method="post">
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
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{$intro->title}}</label>
                        @if($intro->is_link)
                        <input type="text" name="detail" placeholder="Nhập link" class="form-control border-input">
                        @else
                        <textarea name="detail" class="form-control border-input ckeditor" placeholder="{{$intro->title}}" required>{{$intro->detail}}</textarea>
                        @endif
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
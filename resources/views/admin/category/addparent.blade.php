@extends('templates.admin.master')
@section('content')
<div class="card">
    <div class="header">
        <h4 class="title">Thêm Danh Mục Cha</h4>
    </div>
    <div class="content">
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if(session('fail'))
                <p class="alert alert-danger">{{ session('fail') }}</p>
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
                        <label>Tên danh mục</label>
                        <input type="text" name="name" class="form-control border-input" placeholder="Tên danh mục" value="{{old('name')}}">
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
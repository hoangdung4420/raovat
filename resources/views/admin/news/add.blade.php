@extends('templates.admin.master')
@section('content')
<div class="card">
    <div class="header">
        <h4 class="title">Thêm Tin tức</h4>
    </div>
    <div class="content">
        <form action="" method="post">
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
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Tên Bài viết</label>
                        <input type="text" name="title" class="form-control border-input" placeholder="Tên Bài viết" value="{{old('title')}}" required="">
                    </div>
                    <div class="form-group">
                        <label>Danh mục</label>
                        <select name="id_new_cat" class="form-control border-input">
                        @foreach($newscats as $newscat)
                           <option value="{{$newscat->id}}" {{ (old('id_new_cat')==$newscat->id)?'selected':'' }}>{{$newscat->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                       <textarea name="detail" class="form-control border-input ckeditor" placeholder="Nội dung bài viết" required="">{{old('detail')}}</textarea>
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
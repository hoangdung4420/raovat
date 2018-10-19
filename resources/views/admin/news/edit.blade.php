@extends('templates.admin.master')
@section('content')
<div class="card">
    <div class="header">
        <h4 class="title">Sửa Tin tức</h4>
         Người viết: <strong class="text-danger">{{$user->username}}</strong>___lúc: <strong class="text-danger">{{ date_format($news->created_at,"d/m/Y H:i:s") }}</strong>___Trang thái: <strong class="text-danger">{{ ($news->active==1)?'active':'disactive'}}</strong>
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
                        <label>Tên Bài viết</label>
                        <input type="text" name="title" class="form-control border-input" placeholder="Tên Bài viết" value="{{ $news->title }}" required="">
                    </div>
                    <div class="form-group">
                        <label>Danh mục</label>
                        <select name="id_new_cat" class="form-control border-input">
                        @foreach($newscats as $newscat)
                           <option value="{{$newscat->id}}" {{ ($news->id_new_cat==$newscat->id)?'selected':'' }}>{{$newscat->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                       <textarea name="detail" class="form-control border-input ckeditor" placeholder="Nội dung bài viết" required="">{{ $news->detail }}</textarea>
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
@extends('templates.admin.master')
@section('content')
<div class="card">
    <div class="header">
        <h4 class="title">Thêm Danh Mục Con</h4>
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
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Tên danh mục</label>
                        <input type="text" name="name" class="form-control border-input" placeholder="Tên danh mục" value="{{old('name')}}" required="">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Danh mục cha</label>
                            <select name="parent_id" class="form-control border-input">
                            @foreach($parentCats as $parentCat)
                               <option value="{{$parentCat->id}}" {{ (old('name')==$parentCat->id)?'selected':'' }}>{{$parentCat->name}}</option>
                            @endforeach
                            </select>
                        </div>
                     </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kiểu giá tiền sản phẩm trong Tin</label>
                            <select name="price" class="form-control border-input">
                               <option value="0" {{ (old('name')==0)?'selected':'' }}>Không có giá tiền</option>
                               <option value="1" {{ (old('name')==1)?'selected':'' }}> 1 giá tiền</option>
                               <option value="2" {{ (old('name')==2)?'selected':'' }}>thấp nhất-cao nhất</option>
                            </select>
                         </div>
                    </div>
                    <div class="form-group">
                        <label>Tên danh mục</label>
                       <textarea name="content" class="form-control border-input ckeditor" placeholder="Nội dung Tin mẫu" required="">{{old('content')}}</textarea>
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
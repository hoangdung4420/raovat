@extends('templates.admin.master')
@section('content')
<div class="card">
    <div class="header">
        <h4 class="title">Sửa Danh Mục Cha</h4>
    </div>
    <div class="content">
        <form action="" method="post" enctype="multipart/form-data">
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
                <div class="col-md-4">
                    <div class="form-group text-center">
                        <img src="/storage/app/files/{{$parentCat->picture}}" class="img-responsive displayImg" alt="" /> 
                        <input type="file" name="picture" class="form-control inputImg" placeholder="Chọn ảnh"  />
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Tên danh mục</label>
                        <input type="text" name="name" class="form-control border-input" placeholder="Tên danh mục" value="{{$parentCat->name}}">
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
<script>
    //upload 1 ảnh
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('.displayImg').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$(".inputImg").change(function() {
  readURL(this);
});
</script>
@stop
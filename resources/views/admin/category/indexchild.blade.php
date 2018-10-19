@extends('templates.admin.master')
@section('content')
<div class="card">
    <div class="header">
        <h4 class="title">Quản Lý danh mục con của <strong>{{ $parentCat->name }}</strong></h4>
        @if(session('fail'))
                <p class="alert alert-danger">{{ session('fail') }}</p>
                @elseif(session('success'))
                <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        <br />
    </div>
    <div class="content  table-responsive "> <!-- -->
        <table class="table table-hover " id="example" ><!--   -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Nội dung Tin mẫu</th>
                    <th>Số bài đăng</th>
                    @if(Auth::user()->role == 1)
                    <th>Chức năng</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($childCats as $childCat)
                    <tr>
                        <td>{{ $childCat->id }}</td>
                        <td>{{ $childCat->name }}</td>
                        <td>{!! str_limit($childCat->content,50) !!}</td>
                        <td>5??</td>
                         @if(Auth::user()->role == 1)
                        <td>
                            <a href="{{route('admin.category.geteditchild',$childCat->id)}}"><img src="{{$AdminUrl}}/img/edit.gif" alt="" /> Sửa</a> &nbsp;||&nbsp;
                            <a href="{{ route('admin.category.delchild',$childCat->id)}}"  onclick="return confirm('Bạn có thật sự muốn xóa không?')"><img src="{{$AdminUrl}}/img/del.gif" alt="" /> Xóa</a>
                        </td>
                        @endif
                    </tr>
               @endforeach
            </tbody>

        </table>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    </div>
</div>

@stop
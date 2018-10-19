@extends('templates.admin.master')
@section('content')
<div class="card">
    <div class="header">
        <h4 class="title">Quản Lý Danh Mục Cha</h4>
        @if(session('fail'))
                <p class="alert alert-danger">{{ session('fail') }}</p>
                @elseif(session('success'))
                 <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        
        <br />
        <a href="{{route('admin.category.getaddparent')}}" class="addtop"><img src="{{$AdminUrl}}/img/add.png" alt="" /> Thêm Danh Mục Cha</a>
        <a href="{{route('admin.category.getaddchild')}}" class="addtop"><img src="{{$AdminUrl}}/img/add.png" alt="" /> Thêm Danh Mục Con</a>
    </div>
    <div class="content  table-responsive "> <!-- -->
        <table class="table table-hover " id="example" ><!--   -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Hình ảnh</th>
                    <th>Tên danh mục</th>
                    <th>Danh mục con</th>
                    @if(Auth::user()->role == 1)
                    <th>Chức năng</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($parentCats as $parentCat)
                    <tr>
                        <td>{{ $parentCat->id }}</td>
                        
                        <td>
                            @if($parentCat->picture == '')
                                <img src="{{$AdminUrl}}/img/tim_80x80.png" width="120px" alt="" />
                            @else 
                                <img src="/storage/app/files/{{$parentCat->picture}}" width="120px" alt="" />
                            @endif
                        </td>
                        <td>{{ $parentCat->name }}</td>
                        <td><a href="{{route('admin.category.indexchild',$parentCat->id)}}" class="btn btn-success">---Xem---</a></td>
                         @if(Auth::user()->role == 1)
                        <td>
                            <a href="{{route('admin.category.geteditparent',$parentCat->id)}}"><img src="{{$AdminUrl}}/img/edit.gif" alt="" /> Sửa</a> &nbsp;||&nbsp;
                            <a href="{{ route('admin.category.delparent',$parentCat->id)}}" onclick="return confirm('Bạn có thật sự muốn xóa không?')"><img src="{{$AdminUrl}}/img/del.gif" alt="" /> Xóa</a>
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
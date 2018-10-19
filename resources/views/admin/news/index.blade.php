@extends('templates.admin.master')
@section('content')
<div class="card">
    <div class="header">
        <h4 class="title">Quản Lý Tin Tức</h4>
        @if(session('fail'))
                <p class="alert alert-danger">{{ session('fail') }}</p>
                @elseif(session('success'))
                <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        <a href="{{route('admin.news.getadd')}}" class="addtop"><img src="{{$AdminUrl}}/img/add.png" alt="" /> Thêm Tin tức</a>
    </div>
    <div class="content  table-responsive "> <!-- -->
        <table class="table table-hover " id="example" ><!--   -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên bài viết</th>
                    <th>Danh mục</th>
                    <th>Người viết</th>
                    <th>Thời gian</th>
                    <th>Trạng thái</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($news as $val)
                    <tr>
                        <td>{{ $val->id }}</td>
                        <td>{{ $val->title }}</td>
                        <td > 
                            @foreach($newscats as $newscat)
                                @if($newscat->id == $val->id_new_cat)
                                    {{ $newscat->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $val->username }}</td>
                        <td>{{ date_format($val->created_at,"d/m/Y H:i:s") }}</td>
                        @if(Auth::user()->role == 1)
                        <td class="active_{{$val->id}}">
                            @if($val->active == 1)
                                <p class="btn btn-success status" onclick="return changeActive({{ $val->id }})">active</p>
                            @else 
                                <p class="btn btn-danger status" onclick="return changeActive({{ $val->id }})">disactive</p>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('admin.news.getedit',$val->id)}}"><img src="{{$AdminUrl}}/img/edit.gif" alt="" /> Sửa</a> &nbsp;||&nbsp;
                            <a href="{{ route('admin.news.del',$val->id)}}"  onclick="return confirm('Bạn có thật sự muốn xóa không?')"><img src="{{$AdminUrl}}/img/del.gif" alt="" /> Xóa</a>
                        </td>
                        @else  
                        <td>
                             @if($val->active == 1)
                                <p class="btn btn-success">active</p>
                            @else 
                                <p class="btn btn-danger">disactive</p>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('admin.news.getedit',$val->id)}}"><img src="{{$AdminUrl}}/img/edit.gif" alt="" /> Sửa</a>
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

        function changeActive(id){
          $.ajax({
            url:'{{route("admin.news.changeactive")}}',
            method:'GET',
            data:{
                'id':id,
            },
            dataType:'html',
            success: function(result){
                var a = '.active_'+id;
                $(a).html(result);
            },
            error:function(){
              alert('sai');
            }
          });
        }
    </script>
    </div>
</div>

@stop
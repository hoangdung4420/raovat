@extends('templates.admin.master')
@section('content')
<div class="card">
    <div class="header">
        <h4 class="title">Danh Sách Khách Hàng</h4>
        @if(session('fail'))
                <p class="alert alert-danger">{{ session('fail') }}</p>
                @elseif(session('success'))
                 <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        
        
        <a href="{{route('admin.user.getadd')}}" class="addtop"><img src="{{$AdminUrl}}/img/add.png" alt="" /> Thêm</a>
    </div>
    <div class="content  table-responsive "> <!-- -->
        <table class="table table-hover " id="example" ><!--   -->
            <thead>
                <tr>
                    <th>ID</th>
                	<th>Họ tên</th>
                    <th>Ngày tạo</th>
                    <th>Hoạt động</th>
                    <th>Tin đăng</th>
                    @if(Auth::user()->role == 1)
                	<th>Chức năng</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                    	<td>{{ $user->id }}</td>
                    	<td>{{ $user->username }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            @if($user->active == 1)
                                <p class="btn btn-success">active</p>
                            @else 
                                <p class="btn btn-danger">disative</p>
                            @endif
                        </td>
                        <td><a href="">>></a></td>
                         @if(Auth::user()->role == 1)
                    	<td>
                    		<a href="{{route('admin.user.getedit',$user->id)}}"><img src="{{$AdminUrl}}/img/edit.gif" alt="" /> Sửa</a> &nbsp;||&nbsp;
                    		<a href="{{ route('admin.user.del',$user->id)}}"><img src="{{$AdminUrl}}/img/del.gif" alt="" /> Xóa</a>
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
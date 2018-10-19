@extends('templates.admin.master')
@section('content')
<div class="card">
    <div class="header">
        <h4 class="title">Quản Lý Tin Rao vặt</h4>
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
                	<th>Tiêu đề</th>
                    <th>Người đăng</th>
                    <th>Danh mục</th>
                    <th>Quận</th>
                    <th>Trạng thái</th>
                    <th>Bán</th>
                    <th>Lượt xem</th>
                    <th>Ngày tạo</th>
                    @if(Auth::user()->role == 1)
                	<th>Chức năng</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                    	<td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->username }}</td>
                        <td>
                            @foreach($childCats as $childCat)
                                @if($childCat->id == $post->cat_id)
                                    <p>{{ $childCat->name }}</p>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($districts as $district)
                                @if($district->id == $post->district_id)
                                    <p>{{ $district->name }}</p>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @if($post->status == 1)
                                <p>Chờ duyệt</p>
                            @elseif($post->status == 2) 
                                <p>Đăng</p>
                            @else 
                                <p>Từ chối</p>
                            @endif
                        </td>
                        <td>
                            @if($post->sell == 1)
                                <p>Đã bán</p>
                            @else 
                                <p>Chưa bán</p>
                            @endif
                        </td>
                        <td class="text-center">{{ $post->view }}</td>
                        <td>{{ date_format($post->created_at,"d/m/Y H:i:s") }}</td>
                         @if(Auth::user()->role == 1)
                    	<td>
                    		<a href=""><img src="{{$AdminUrl}}/img/edit.gif" alt="" /> Sửa</a> &nbsp;||&nbsp;
                    		<a href=""><img src="{{$AdminUrl}}/img/del.gif" alt="" /> Xóa</a>
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
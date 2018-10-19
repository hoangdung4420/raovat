@extends('templates.admin.master')
@section('content')
<div class="card">
    <div class="header">
        <h4 class="title">Duyệt Tin Rao Vặt <a href="" style="font-size: 15px;color: red">Đang làm >> </a>
        </h4>
        @if(session('fail'))
                <p class="alert alert-danger">{{ session('fail') }}</p>
                @elseif(session('success'))
                 <p class="alert alert-success">{{ session('success') }}</p>
        @endif
    </div>
    <div>
        <hr>
        <ul class="list-inline text-center">
            <li class="col-md-3 {{Request::is('*approval')?'active':''}}"><a href="{{route('admin.approval.index')}}">Tất cả</a></li>
            <li class="col-md-3 {{Request::is('*wait')?'active':''}}"><a href="{{route('admin.approval.indexwait')}}">Chờ </a></li>
            <li class="col-md-3 {{Request::is('*refuse')?'active':''}}"><a href="{{route('admin.approval.indexrefuse')}}">Bị từ chối </a></li>
            <li class="col-md-3 {{Request::is('*post')?'active':''}}"><a href="{{route('admin.approval.indexpost')}}">Đăng</a></li>
        </ul>
        <div class="clearfix"></div>
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
                @if(!Request::is('*wait'))
                    <th>Người duyệt</th>
                  @if(Request::is('*approval'))
                    <th>Trạng thái</th>
                  @endif    
                    <th>Lý do</th>
                @endif
                	<th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($approvals as $approval)
                    <tr>
                    	<td>{{ $approval->id }}</td>
                        <td>{{ $approval->title }}</td>
                        <td>{{ $approval->user_post }}</td>
                        <td>
                            @foreach($childCats as $childCat)
                                @if($childCat->id == $approval->cat_id)
                                    {{ $childCat->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($districts as $district)
                                @if($district->id == $approval->district_id)
                                    {{ $district->name }}
                                @endif
                            @endforeach
                        </td>
                    @if(!Request::is('*wait'))
                        <td>{{ $approval->user_approval }}</td>
                         @if(Request::is('*approval'))
                            <td>
                                @if($approval->status == 1)
                                    Chờ duyệt
                                @elseif($approval->status == 2) 
                                    Đăng
                                @else 
                                    Từ chối
                                @endif
                            </td>
                        @endif
                        <td class="text-center">{{ $approval->reason }}</td>
                    @endif
                    	<td>
                            @if($approval->user_id != 0)
                    		  <a href="{{route('admin.approval.approval',$approval->id)}}" class="btn btn-success">{{($approval->status>1)?'Đã Duyệt':'Đang Duyệt'}}</a>
                            @else 
                             <a href="{{route('admin.approval.approval',$approval->id)}}" class="btn btn-danger">Chưa Duyệt</a>
                            @endif
                    	</td>
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
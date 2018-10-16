@extends('templates.admin.master')
@section('content')
<div class="card">
    <div class="header">
        <h4 class="title">Giới thiệu Website</h4>
        @if(session('fail'))
            <p class="alert alert-danger">{{ session('fail') }}</p>
            @elseif(session('success'))
             <p class="alert alert-success">{{ session('success') }}</p>
        @endif
    </div>
    <div class="content  table-responsive "> <!-- -->
        <table class="table table-hover " id="example" ><!--   -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>tiêu đề</th>
                    <th>nội dung</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($introductions as $intro)
                    <tr>
                        <td>{{ $intro->id }}</td>
                        <td>{{ $intro->title }}</td>
                        <td>
                            @if($intro->is_link) 
                                <a href = "{{$intro->detail}}" target="blanck">{{$intro->detail}}</a>
                            @else 
                                {!! str_limit($intro->detail,50) !!}
                            @endif
                        </td>
                        <td>
                            <a href="{{route('admin.introduction.getedit',$intro->id)}}"><img src="{{$AdminUrl}}/img/edit.gif" alt="" /> Sửa</a> 
                        </td>
                    </tr>
               @endforeach
            </tbody>

        </table>
    
    </div>
</div>

@stop
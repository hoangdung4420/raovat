@extends('templates.public.master')
@section('content')
<br />
<br />
<br />
<div class="col-md-4">
	@include('customer.leftbar')
</div>
<div class="col-md-8">
  <h3 class="topic">Danh sách tin của bạn</h3>
  <div class="content">
	@if(session('newbie'))
		<p class="alert alert-success">Bạn đã đăng tin thành công, chúng tôi sẽ nhanh chóng phê duyệt nó trước khi cho hiển thị. Một tài khoản được tại cho bạn với mật khẩu '123456'.Hãy xác nhận bằng tài khoản gmail dùng để đăng tin</p>
		@php 
			Session::forget('newbie')
		@endphp
	@endif
	@if(session('success'))
		<p class="alert alert-success">{{session('success')}}</p>
	@endif
		<div class="ql-tin">
			<ul class="list-inline text-center">
				<li class="col-md-4 {{Request::is('*dang*')?'active':''}}"><a href="{{route('customer.listpost')}}">Đang bán ({{$tinDang}})</a></li>
				<li class="col-md-4 {{Request::is('*tuchoi*')?'active':''}}"><a href="{{route('customer.listrefuse')}}">Bị từ chối ({{$tinTuChoi}})</a></li>
				<li class="col-md-4 {{Request::is('*choduyet*')?'active':''}}"><a href="{{route('customer.listwait')}}">Chờ ({{$tinCho}})</a></li>
			</ul>
			<div class="clearfix"></div>
		</div>
		@if(count($arPosts) ==0 )
			<p class="alert alert-danger text-center">Không có tin nào</p>
		@else 
		<div class="table-responsive "> <!-- -->
        <table class="table table-hover " id="example" ><!--   -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Ngày đăng</th>
                    @if(Request::is('*dang*'))
                    <th>Bán/Chưa</th>
                    @endif
                    @if(Request::is('*tuchoi*'))
                    <th>Lý do</th>
                    <th>Chức năng</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($arPosts as $arPost)
                    <tr>
                        <td>{{ $arPost->id }}</td>
                        <td>{{ $arPost->title }}</td>
                        <td>{{ date_format($arPost->updated_at,"d/m/Y H:i:s") }}</td>
                        @if(Request::is('*dang*'))
                        <td>{{ ($arPost->sell == 0)?'Chưa Bán':'Đã bán' }}</td>
                        @endif
                        @if(Request::is('*tuchoi*'))
                        <td>{{ str_limit($arPost->reason,20) }}</td>
                        <td>
                            <a href="{{ route('customer.editpost',['name'=>str_slug($arPost->title),'id'=>$arPost->id]) }}"><img src="{{$AdminUrl}}/img/edit.gif" alt="" /> Sửa</a> &nbsp;||&nbsp;
                            <a href="{{ route('customer.delpost',$arPost->id)}}"  onclick="return confirm('Bạn có thật sự muốn xóa không?')"><img src="{{$AdminUrl}}/img/del.gif" alt="" /> Xóa</a>
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
    @endif
  </div>
</div>

@stop
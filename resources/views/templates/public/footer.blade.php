<div class="jumbotron boder-solid" style="background: #fbfbfb;margin-bottom: 0px;">
	<div class="container">
		<div class="row">
			<div class="col-md-7 " id="address">
				{!! $introductions['địa chỉ'] !!}
			</div>
			<div class="col-md-2">
				<p>Pages</p>
				<h5><a href="">Giới thiệu</a></h5>
				<h5><a href="">Tin mới</a></h5>
				<h5><a href="">Quy định chung</a></h5>
				<h5><a href="">Câu hỏi thường gặp</a></h5>
				<h5><a href="">Trợ giúp</a></h5><!-- dẫn tới contact, phía trên là list new_cats-->
			</div>
			<div class="col-md-3 text-center">
				<p>Mạng xã hội</p>
				<div class="row ">
						<a href="{{$introductions['facebook']}}"><i class="fa fa-facebook fa-2x"></i></a>
						<a href="{{$introductions['youtobe']}}"><i class="fa fa-twitter fa-2x"></i></a>
						<a href="{{$introductions['instagram']}}"><i class="fa fa-youtube fa-2x"></i></a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="jumbotron footer1">
	<div class="container text-center">
		@for( $i=1;$i< 50;$i++)
		<a href=""><label class="tag1">Công Ty</label></a>
		@endfor
	</div>
</div>
<script src="{{$AdminUrl}}/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>

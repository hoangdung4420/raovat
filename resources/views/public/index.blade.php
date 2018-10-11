@extends('templates.public.master')
@section('content')

<div class="row">
	<br />
	<div class="col-md-7" style="border-right:  2px solid #eee">
		@for($i=1;$i<=12;$i++)
			<a href=""><div class="col-md-3 cast-total">
				<img src="/storage/app/files/me-va-be.jpg" class="img-responsive img-rounded" />
				<h4 class="text-center cats">Me va be</h4>
			</div></a>

		@endfor
	</div>
	<div class="col-md-5">
		@for($i=1;$i<=8;$i++)
			<div class="col-md-4 link1">
			<h4 ><a href="">Lien chieu</a></h4>
				<h5 ><a hrf="" >Hoa Khanh Bac</a></h5>
				<h5 ><a hrf="" >Hoa Khanh Bac</a></h5>
				<h5 ><a hrf="" >Hoa Khanh Bac</a></h5>
			</div>
		@endfor
	</div>
</div>
<br />
<br />
<div class="row">
	<div class="col-md-12 caption1">
		<p >Quảng cáo nổi bật</p>
	</div>
	<div class="clearfix"></div>
	@for($i=1;$i<=6;$i++)
		<div class="col-md-2 link1">
			<a href="">
				<img src="/storage/app/files/me-va-be.jpg" class="img-responsive img-rounded" />
				<p class="text-center">Me va be</p>
			</a>
		</div>
	@endfor

</div>
<!-- <div class="row adv-index">
	<div class="col-md-12">
		<img class="img-responsive text-center" src="/storage/app/files/2adv.png" />
	</div>
</div> -->
<br />
<br />
<div class="row">
	<div class="col-md-12 caption1">
		<p>Tin rao vặt mới</p>
	</div>
	<div class="clearfix"></div>
	@for($i=1;$i<=6;$i++)
		<div class="col-md-2 link1">
			<a href="">
				<img src="/storage/app/files/me-va-be.jpg" class="img-responsive img-rounded" />
				<p class="text-center">Me va be</p>
			</a>
		</div>
	@endfor
</div>	

<div class="row boder-solid">
	@for($i=1;$i<=8;$i++)
		<div class="col-md-3">
			<div class="link1">
				<h5><a href=""><strong>Nhà đất</strong></a></h5>
				<p><a href="">mua đất</a></p>
				<p><a href="">Cho thuê</a></p>
				<p><a href="">Mua chung cư</a></p>
			</div>
		</div>
	@endfor
</div>
@stop


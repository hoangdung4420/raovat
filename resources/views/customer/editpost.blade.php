@extends('templates.public.master')
@section('content')
<div class="col-md-12" >
  <div style="font-size: 15px">
      <i class="fa fa-home"></i>
      <strong>{{$parentCat->name}}</strong>
      <i class="fa fa-angle-right"></i>
      <strong>{{$childCat->name}}</strong>
	     
  </div>
  
</div>
<div class="clearfix"></div>
  <br>
  <div>
    @php 
        $name = str_slug($post->title);
        $id = $post->id;
    @endphp
    <form action="{{route('customer.savepost',['name'=>$name,'id'=>$id])}}" method="post" class="form-horizontal" enctype="multipart/form-data">
      {{csrf_field()}}
      @if(session('fail'))
          <p class="alert alert-danger">{{ session('fail') }}</p>
      @elseif(session('success'))
          <p class="alert alert-success">{{ session('success') }}</p>
      @endif
      @if($errors->any()) 
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach
            </ul>
        </div>
        @endif
      <div class="col-md-7">
      <input type="hidden" name="cat_id" value="{{$post->cat_id}}">

      <div class="form-group">
        <label class="col-md-3">Vị trí:</label>
        <div class="col-md-9">
            <label>Đà Nẵng</label>
            <select name="district_id" id="district" class="form-control" onchange="return changeDistrict()">
              <option value="a">Quận/Huyện (*):</option>
              @foreach($districts as $district)
              <option value="{{$district->id}}" {{ ($post->district_id)?'selected':'' }} >{{$district->name}}</option>
              @endforeach
            </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-3"></label>
        <div class="col-md-9" >
            <select name="village_id" id="village" class="form-control" onchange="return changeVillage()">
              <option value="a">Phường/Xã(*)</option>
              @foreach($villages as $village)
              <option value="{{$village->id}}" {{ ($post->village_id)?'selected':'' }} >{{$village->name}}</option>
              @endforeach
            </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-3"></label>
        <div class="col-md-3">
          <input type="text" name="id_home" value=" {{ $post->id_home }}" placeholder="Số Nhà" class="form-control">
        </div>

        <div class="col-md-6">
            <select name="street_id" class="form-control" id="street">
              <option value="a">Đường/Phố</option>
              @foreach($streets as $street)
              <option value="{{$street->id}}" {{ ($post->street_id)?'selected':'' }} >{{$street->name}}</option>
              @endforeach
            </select>
        </div>
      </div>
      @if($childCat->price == 2)
      <div class="form-group">
        <label class="col-md-3">Mức lương từ :</label>
        <div class="col-md-9">
            <input type="text" name="price1" class="form-control" value="{{$post->price1}}">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-3">Mức lương đến:</label>
        <div class="col-md-9">
            <input type="text" name="price2" class="form-control" value="{{$post->price2}}">
        </div>
      </div>
      @elseif($childCat->price == 1) 
      <div class="form-group">
        <label class="col-md-3">Giá tiền:</label>
        <div class="col-md-9">
            <input type="text" name="price1" class="form-control" value="{{$post->price1}}">
        </div>
      </div>
      @endif
      <div class="form-group">
        <label class="col-md-3">Tiêu đề (*):</label>
        <div class="col-md-9">
            <input type="text" name="title" class="form-control" value="{{$post->title}}" >
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-3">Nội dung (*):</label>
        <div class="col-md-9">
            <textarea name="detail" class="form-control ckeditor" >{{$post->detail}}</textarea>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-3">Đăng hình (*):</label>
        <div class="col-md-9">
            <input class="form-control inputImg" type="file" name="picture[]" multiple />
            <span>Chọn tối đa 6 hình.</span>
            <div id="displayImg">
              @php 
                $arPicture = explode('|',$post->pictures);
              @endphp
              @foreach($arPicture as $picture)
              <img src="/storage/app/files/{{$picture}}" alt="" id="Img" class="col-md-4 img-responsive" />
              @endforeach
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div>
        <div id="mapVOHIEU" style="clear:both; height:200px;"></div>
        <script>
          function initMap() {
                var map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 21.0168864, lng: 105.7855574 },
                zoom: 15
              });
           }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWzPwzUTtnKOzxAAQ3nv_65-OfuAorMkU&callback=initMap"
        async defer>
        </script>
      </div>
      <br>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Tin đăng mẫu</h3>
        </div>
        <div class="panel-body">
          {!!$childCat->content !!}
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
     
    <div class="col-md-7">
      <div class="form-group">
        <label class="col-md-3">Người liên hệ (*):</label>
        <div class="col-md-9">
            <input type="text" name="username" class="form-control" value="{{ Auth::user()->username }}">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-3">email (*):</label>
        <div class="col-md-9">
            <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}"  readonly>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-7">
        <div class="col-md-3"></div>
        <div class="col-md-4">
           <button type="submit" class="btn btn-warning btn-block">Đăng</button>
        </div>
        <div class="col-md-5"></div>
      </div>
    
  </form>
  </div>
<script type="text/javascript">
  $('a').click(function(){
      confirm('changes you made may not be saved');
  });
  //vo hieu hoa nut go back cua trinh duyet
  history.pushState(null, null, '');
  window.addEventListener('popstate', function(event) {
               history.pushState(null, null, '');
  });
  
  //liên quan đến input vị trí
function changeDistrict(){
  district = $('#district').val()
  $.ajax({
    url:'{{route("public.changedistrict")}}',
    method:'GET',
    data:{
      'district_id':district
    },
    dataType:'json',
    success: function(result){
        html ='<option value="a">Phường/Xã(*)</option>';
        $.each(result,function(key,item){
            html +='<option value="'+key+'">'+item+'</option>';
        });
      $('#village').html(html);
    },
    error:function(){
      alert('sai');
    }
  });
}

function changeVillage(district){
  district = $('#district').val();

  $.ajax({
    url:'{{route("public.changevillage")}}',
    method:'GET',
    data:{
      'district_id':district
    },
    dataType:'json',
    success: function(result){
        html ='<option value="a">Đường/Phố(*)</option>';
        $.each(result,function(key,item){
            html +='<option value="'+key+'">'+item+'</option>';
        });
      $('#street').html(html);
    },
    error:function(){
      alert('sai');
    }
  });
}
//hiển thị hình ảnh
function readURL(input) {
    $('#displayImg').html('')
     for(var i =0; i< input.files.length; i++){
         if (input.files[i] && i< 6) {
            var reader = new FileReader();

            reader.onload = function (e) {
              
               var div = $('<div id=""></div>');
               div.attr('id',i);
               div.appendTo('#displayImg');
               var cl = '#'+i;

               var img = $('<img id="Img" class="col-md-4 img-responsive" title="Xóa?">');
               img.attr('src', e.target.result);
               img.appendTo(cl);  
            }
            reader.readAsDataURL(input.files[i]);
           }
        }
    }

    $(".inputImg").change(function(){
        readURL(this);
    });
</script>
@stop
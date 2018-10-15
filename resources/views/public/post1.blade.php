@extends('templates.public.master')
@section('content')

<div class="form_post">
	<div class="col-md-4">
		<h4 class="text-primary"><span class="badge">1</span> Chọn chuyên mục đăng</h4>
		<ul class="list-group">
		@foreach($parentCats as $parentCat)
		  <li class="list-group-item parent" onclick="return getChild({{ $parentCat->id }})" id="parent_{{ $parentCat->id }}">
		  	{{$parentCat->name}}
		    <span class="badge">></span>
		  </li>
		@endforeach
		</ul>
	</div>
	<div class="col-md-4 child_list">

	</div>
</div>
<script type="text/javascript">
  <?php 
    if(session('change')){
      $oldCat= Session::get('oldCat');
      echo '$("#parent_'.$oldCat->parent_id.'").click();';
    }
  ?>
  function getChild(id){
  	$('.parent').removeClass('active');
  	$('#parent_'+id).toggleClass('active');
    $.ajax({
        url: '{!!route("public.childcat")!!}', 
        method: 'GET',
        data: {
          'id':id
        },
        dataType: 'json',
        success: function(result){
            var a ='.child_list';
            html ='<h4 class="text-primary"><span class="badge">2 </span> Chọn chuyên mục đăng tiếp theo</h4>';
            html+='<ul class="list-group">';
            $.each(result,function(key,item){
              html +='<li class="list-group-item child" onclick="return setChild('+key+')" id="child_'+key+'">'+item;
              html+='</li>';
            });
            html+='</ul>';
            $(a).html(html);
              <?php 
                if(session('change')){
                  echo '$("#child_'.$oldCat->id.'").toggleClass("active");';
                  Session::forget('oldCat');
                }
              ?>
        },
        error: function(){
          alert('Sai');
        }
      });
    }
    function setChild(id){
      $('.child').removeClass('active');
      $('#child_'+id).toggleClass('active');
      //chuyển đến route step2: nhập nội dung tin
      window.location.href = '/dangtin/'+id+'/b2';
    }
</script>
@stop
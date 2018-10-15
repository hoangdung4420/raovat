<!-- <h4 class="text-primary"><span class="badge">2 </span> Chọn chuyên mục đăng tiếp theo</h4>
  <ul class="list-group">
  @foreach($childsOfParent as $childCat)
    <li class="list-group-item child" onclick="return setChild({{ $childCat->id }})" id="child_{{ $childCat->id }}">
      {{$childCat->name}}
    </li>
  @endforeach
  </ul>
<script type="text/javascript">
  function setChild(id){
    $('.child').removeClass('active');
    $('#child_'+id).toggleClass('active');
    //tạo session lưu thông tin tiến độ tạo tin 
    <?php Session::put('choice_cat', true);
    ?>
    //chuyển đến route step2: nhập nội dung tin
    window.location.href = '/dangtin/'+id+'/b2';
    }

</script>
 -->
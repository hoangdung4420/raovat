<h3 class="header-title">TRANG CÁ NHÂN</h3>
<div class="list-group">
  
  <a href="{{route('customer.listpost')}}" class="list-group-item {{ Request::is('*danhsachtin*')?'active':''}}">Quản Lý Tin đăng</a>
  <a href="#" class="list-group-item">Quản Lý Tin lưu</a>
  <a href="#" class="list-group-item ">Lịch Sử Hỏi/Đáp</a>
  <a href="#" class="list-group-item ">Tài khoản Coin</a>
  <a href="{{ route('customer.getprofile') }}" class="list-group-item {{ Request::is('*thongtincanhan*')?'active':''}}">Thông Tin Cá Nhân</a>
  <a href="{{ route('customer.getchangepassword') }}" class="list-group-item {{ Request::is('*thaydoimatkhau*')?'active':'' }}">Thay Đổi Mật Khẩu</a>
  
</div>
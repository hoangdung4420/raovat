<h3 class="header-title">TRANG CÁ NHÂN</h3>
<div class="list-group">
  
  <a href="#" class="list-group-item ">Quản Lý Tin đăng</a>
  <a href="#" class="list-group-item">Quản Lý Tin lưu</a>
  <a href="#" class="list-group-item ">Lịch Sử Hỏi/Đáp</a>
  <a href="#" class="list-group-item ">Tài khoản</a>
  <a href="{{ route('customer.getprofile') }}" class="list-group-item {{ Request::is('taikhoancanhan')?'active':''}}">Thông Tin Cá Nhân</a>
  <a href="{{ route('customer.getchangepassword') }}" class="list-group-item {{ Request::is('thaydoimatkhau')?'active':'' }}">Thay Đổi Mật Khẩu</a>
  
</div>
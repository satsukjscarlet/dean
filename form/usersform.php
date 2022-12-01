<script src="js/jquery-3.6.0.min.js"></script>
<div class="container">
  <h2>Tạo tài khoản</h2>
  <form action = "form/adduser_handle.php" method = "post">
    <div class="form-group">
      <label>Tên Hiển Thị:</label>
      <input type="text" name = "display_name" class="form-control" placeholder="Bạn cần nhập thông tin" required="" />
    </div>
    <div class="form-group">
      <label>Mã Nhân Viên</label>
      <input type="text" name = "employeeNumber" class="form-control" placeholder="Bạn cần nhập thông tin" required="" />
    </div>
   
    <div class="form-group">
      <label>Mật Khẩu:</label>
      <input type="password" name = "password" class="form-control" placeholder="Password" required="" />
    </div>
    <!-- <div class="form-group">
      <label>Nhập lại mật khẩu:</label>
      <input type="password" name = "password" class="form-control" placeholder="Password" required="" />
    </div> -->

    <div class="form-group">
      <label>Email:</label>
      <input type="email" name = "email" class="form-control" placeholder="Bạn cần nhập thông tin" required="" />
    </div>

    <div class="form-group">
    <label>Phân Quyền:</label>
    <br/>
        <select class="custom-select" name = 'level' value="1">
        <option selected value="1">Nhân viên</option>
        <!-- <option value="2">Phòng ban</option> -->
        <option value="3">Quản trị viên</option>
        </select>
    </div>
    
    <!-- <div class="form-group">
      <label>Mã nhân viên:</label>
      <input type="employeeNumber" name = "employeeNumber" class="form-control" placeholder="Bạn cần nhập thông tin" required="" />
    </div> -->
    <div class="form-group">
      <label>Phòng Ban:</label>
      <br/>
      <select class="custom-select" name="department" value="NSCL">
        <option selected value="NSCL">Nhân sự chiến lược</option>
        <option value="CNCL">Công nghệ chất lượng</option>
        <option value="DVKH">Dịch vụ khách hàng</option>
        <option value="KTNB">Kế toán nội bộ</option>
        <option value="MKT">Marketing</option>
        <option value="NCPT">Nghiên cứu phát triển</option>
        <option value="NMCK">Nhà máy cơ khí</option>
        <option value="NMPE">Nhà máy PE</option>
        <option value="NMPT1">Nhà máy phụ tùng 1</option>
        <option value="NMPT2">Nhà máy phụ tùng 2</option>
        <option value="NMPVC">Nhà máy PVC</option>
        <option value="PTTT1">Phát triển thị trường 1</option>
        <option value="PTTT2">Phát triển thị trường 2</option>
        <option value="QLDA">Quản lý dự án</option>
        <option value="TCKT">Tài chính kế toán</option>
        <option value="VT">Vật tư</option>
        <option value="VPCT">Văn phòng công ty</option>
    </select>
    </div>
    <div class="form-group">
      <label>Chức Vụ:</label>
      <input type="text" name = "jobTitle" class="form-control" placeholder="Bạn cần nhập thông tin" required="" />
    </div>
    <input type ="submit" class = "btn btn-block btn-info" value="Tạo Tài Khoản" />
  </form>
</div>
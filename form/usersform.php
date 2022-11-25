
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
        <option selected value="NSCL">NSCL</option>
        <option value="CNCL">CNCL</option>
        <option value="DVKH">DVKH</option>
        <option value="KTNB">KTNB</option>
        <option value="MKT">MKT</option>
        <option value="NCPT">NCPT</option>
        <option value="NMCK">NMCK</option>
        <option value="NMPE">NMPE</option>
        <option value="NMPT1">NMPT1</option>
        <option value="NMPT2">NMPT2</option>
        <option value="NMPVC">NMPVC</option>
        <option value="PTTT1">PTTT1</option>
        <option value="PTTT2">PTTT2</option>
        <option value="QLDA">QLDA</option>
        <option value="TCKT">TCKT</option>
        <option value="VT">VT</option>
        <option value="VPCT">VPCT</option>
    </select>
    </div>
    <div class="form-group">
      <label>Chức Vụ:</label>
      <input type="text" name = "jobTitle" class="form-control" placeholder="Bạn cần nhập thông tin" required="" />
    </div>
    <input type ="submit" class = "btn btn-block btn-info" value="Tạo Tài Khoản" />
  </form>
</div>
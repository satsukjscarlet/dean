<script src="js/jquery-3.6.0.min.js"></script>
<?php
include('connection.php');

// if($_SESSION["level"] != 4)
// {
//     header("location: http://localhost/dean/index.php");  
// }
$id = $_GET["sid"];
$sql = "SELECT * FROM users WHERE id='$id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
?>

<div class="container">
  <h2>Tạo tài khoản</h2>
  <form action = "user/user_edit.php" method = "post">
  <input type="hidden" name="id" id="id" <?php echo 'value = "'.$row['id'].'"' ?>>
    <div class="form-group">
      <label>Tên Hiển Thị:</label>
      <input type="text" name = "display_name" class="form-control" placeholder="Bạn cần nhập thông tin" required="" 
      <?php echo 'value = "'.$row['display_name'].'"' ?>/>
    </div>
    <div class="form-group">
      <label>Mã Nhân Viên</label>
      <input type="text" name = "employeeNumber" class="form-control" placeholder="Bạn cần nhập thông tin" required="" 
      <?php echo 'value = "'.$row['employeeNumber'].'"' ?>
      />
    </div>
   
    <div class="form-group">
      <label>Mật Khẩu:</label>
      <input type="password" name = "password" class="form-control" placeholder="Password" />
    </div>
    <!-- <div class="form-group">
      <label>Nhập lại mật khẩu:</label>
      <input type="password" name = "password" class="form-control" placeholder="Password" required="" />
    </div> -->

    <div class="form-group">
      <label>Email:</label>
      <input type="email" name = "email" class="form-control" placeholder="Bạn cần nhập thông tin" required="" 
      <?php echo 'value = "'.$row['email'].'"' ?>
      />
    </div>

    <div class="form-group">
    <label>Phân Quyền:</label>
    <br/>
        <select class="custom-select" name = 'level' <?php echo 'value = "'.$row['level'].'"' ?>>
        <option <?php if($row['level'] == '1') echo"selected"; ?> value="1">Nhân viên</option>
        <option <?php if($row['level'] == '2') echo"selected"; ?> value="2">Trưởng Phòng/Ban</option>
        <option <?php if($row['level'] == '3') echo"selected"; ?> value="3">Lãnh đạo</option>
        <!-- <option value="2">Phòng ban</option> -->
        <option <?php if($row['level'] == '4') echo"selected"; ?> value="4">Quản trị viên</option>
        </select>
    </div>
    
    <!-- <div class="form-group">
      <label>Mã nhân viên:</label>
      <input type="employeeNumber" name = "employeeNumber" class="form-control" placeholder="Bạn cần nhập thông tin" required="" />
    </div> -->
    <div class="form-group">
      <label>Phòng Ban:</label>
      <br/>
      <select class="custom-select" name="department" <?php echo 'value = "'.$row['department'].'"' ?>>
        <option <?php if($row['department'] == 'BĐH') echo"selected"; ?> value="BĐH">Ban Điều Hành</option>
        <option <?php if($row['department'] == 'NSCL') echo"selected"; ?> value="NSCL">Nhân Sự Chiến Lược</option>
        <option <?php if($row['department'] == 'CNCL') echo"selected"; ?> value="CNCL">Công Nghệ Chất Lượng</option>
        <option <?php if($row['department'] == 'DVKH') echo"selected"; ?> value="DVKH">Dịch Vụ Khách Hàng</option>
        <option <?php if($row['department'] == 'KTNB') echo"selected"; ?> value="KTNB">Ké Toán Nội Bộ</option>
        <option <?php if($row['department'] == 'MKT') echo"selected"; ?> value="MKT">Marketing</option>
        <option <?php if($row['department'] == 'NCPT') echo"selected"; ?> value="NCPT">Nghiên Cứu Phát Triển</option>
        <option <?php if($row['department'] == 'NMCK') echo"selected"; ?> value="NMCK">Nhà Máy Cơ Khí</option>
        <option <?php if($row['department'] == 'NMPE') echo"selected"; ?> value="NMPE">Nhà Máy PE-PP</option>
        <option <?php if($row['department'] == 'NMPT') echo"selected"; ?> value="NMPT">Nhà Máy Phụ Tùng </option>
        <option <?php if($row['department'] == 'NMPVC') echo"selected"; ?> value="NMPVC">Nhà Máy PVC</option>
        <option <?php if($row['department'] == 'PTTT1') echo"selected"; ?> value="PTTT1">Phát Triển Thị Trường 1</option>
        <option <?php if($row['department'] == 'PTTT2') echo"selected"; ?> value="PTTT2">Phát Triển Thị Trường 2</option>
        <option <?php if($row['department'] == 'QLDA') echo"selected"; ?> value="QLDA">Quản Lý Dự Án</option>
        <option <?php if($row['department'] == 'TCKT') echo"selected"; ?> value="TCKT">Tài Chính Kế Toán</option>
        <option <?php if($row['department'] == 'VT') echo"selected"; ?> value="VT">Vật Tư</option>
        <option <?php if($row['department'] == 'VPCT') echo"selected"; ?> value="VPCT">Văn Phòng Công Ty</option>    
    </select>
    </div>
    <div class="form-group">
      <label>Chức Vụ:</label>
      <input type="text" name = "jobTitle" class="form-control" placeholder="Bạn cần nhập thông tin" required="" 
      <?php echo 'value = "'.$row['jobTitle'].'"' ?>
      />
    </div>
    <div class="form-group">
      <label>Khối:</label>
      <select class="custom-select" name="block" <?php echo 'value = "'.$row['block'].'"' ?>>
        <option <?php if($row['block'] == 'NC') echo"selected"; ?> value="NC">Khối Nội Chính</option>
        <option <?php if($row['block'] == 'KT') echo"selected"; ?> value="KT">Khối Kỹ Thuật</option>
        <option <?php if($row['block'] == 'SX') echo"selected"; ?> value="SX">Khối Sản Xuất</option>
        <option <?php if($row['block'] == 'KD') echo"selected"; ?> value="KD">Khối Kinh Doanh</option>
        <option <?php if($row['block'] == 'TC') echo"selected"; ?> value="TC">Khối Tài Chính</option>
    </select>
    </div>
    <input type ="submit" class = "btn btn-block btn-info" value="Cập Nhập Tài Khoản" />
  </form>
</div>
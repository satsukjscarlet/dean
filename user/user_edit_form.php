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
        <option <?php if($row['department'] == 'NSCL') echo"selected"; ?> value="NSCL">NSCL</option>
        <option <?php if($row['department'] == 'CNCL') echo"selected"; ?> value="CNCL">CNCL</option>
        <option <?php if($row['department'] == 'DVKH') echo"selected"; ?> value="DVKH">DVKH</option>
        <option <?php if($row['department'] == 'KTNB') echo"selected"; ?> value="KTNB">KTNB</option>
        <option <?php if($row['department'] == 'MKT') echo"selected"; ?> value="MKT">MKT</option>
        <option <?php if($row['department'] == 'NCPT') echo"selected"; ?> value="NCPT">NCPT</option>
        <option <?php if($row['department'] == 'NMCK') echo"selected"; ?> value="NMCK">NMCK</option>
        <option <?php if($row['department'] == 'NMPE') echo"selected"; ?> value="NMPE">NMPE</option>
        <option <?php if($row['department'] == 'NMPT1') echo"selected"; ?> value="NMPT1">NMPT1</option>
        <option <?php if($row['department'] == 'NMPT2') echo"selected"; ?> value="NMPT2">NMPT2</option>
        <option <?php if($row['department'] == 'NMPVC') echo"selected"; ?> value="NMPVC">NMPVC</option>
        <option <?php if($row['department'] == 'PTTT1') echo"selected"; ?> value="PTTT1">PTTT1</option>
        <option <?php if($row['department'] == 'PTTT2') echo"selected"; ?> value="PTTT2">PTTT2</option>
        <option <?php if($row['department'] == 'QLDA') echo"selected"; ?> value="QLDA">QLDA</option>
        <option <?php if($row['department'] == 'TCKT') echo"selected"; ?> value="TCKT">TCKT</option>
        <option <?php if($row['department'] == 'VT') echo"selected"; ?> value="VT">VT</option>
        <option <?php if($row['department'] == 'VPCT') echo"selected"; ?> value="VPCT">VPCT</option>
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
      <input type="text" name = "block" class="form-control" placeholder="Bạn cần nhập thông tin" disabled
      <?php echo 'value = "'.$row['block'].'"' ?>
      />
    </div>
    <input type ="submit" class = "btn btn-block btn-info" value="Cập Nhập Tài Khoản" />
  </form>
</div>
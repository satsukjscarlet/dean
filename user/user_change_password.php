<script src="js/jquery-3.6.0.min.js"></script>
<?php
include('connection.php');

$id = $_SESSION["user_id"];
$sql = "SELECT * FROM users WHERE id='$id' LIMIT 1";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($query);
?>

<div class="container">
  <h2>Đổi mật khẩu</h2>
  <form action="" id="change_password" method="post">
    <input type="hidden" name="id" id="id" <?php echo 'value = "' . $row['id'] . '"' ?>>
    <div class="form-group">
      <label>Tên Hiển Thị:</label>
      <input type="text" name="display_name" class="form-control" placeholder="Bạn cần nhập thông tin" required=""
        disabled <?php echo 'value = "' . $row['display_name'] . '"' ?> />
    </div>
    <div class="form-group">
      <input type="text" name="username" class="form-control" placeholder="Bạn cần nhập thông tin" required="" hidden
        <?php echo 'value = "' . $row['username'] . '"' ?> />
    </div>

    <div class="form-group">
      <label>Mật Khẩu cũ:</label>
      <input type="password" name="password" class="form-control" placeholder="Password" />
    </div>

    <div class="form-group">
      <label>Mật Khẩu mới:</label>
      <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Password" />
    </div>

    <div class="form-group">
      <label>Nhập lại mật khẩu mới:</label>
      <input type="password" name="check_new_password" id = "check_new_password" class="form-control" placeholder="Password" />
    </div>

    <input type="submit" class="btn btn-block btn-info" value="Đổi mật khẩu" />
  </form>
</div>

<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

<script type="text/javascript">

  $('#change_password').submit(function (event) {
    event.preventDefault();
    var new_password = document.getElementById('new_password').value;
    var check_new_password = document.getElementById('check_new_password').value;
    if (new_password == check_new_password) {
      $.ajax({
        type: "POST",
        url: 'user/user_change_password_handle.php',
        data: $(this).serializeArray(),
        success: function (response) {
          response = JSON.parse(response);
          if (response.status == 0) {
            alert(response.message);
          } else {
            window.location.href = "http://localhost/dean"
          }
        }
      })
    } else {
      alert('Nhập lại mật khẩu mới và mật khẩu mới chưa giống nhau');
    }

  });

</script>
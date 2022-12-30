<?php

include('connection.php');

$id = $_GET["sid"];
$sql_info = "SELECT * FROM department WHERE id='$id' LIMIT 1";
$query_info = mysqli_query($con, $sql_info);
$row_info = mysqli_fetch_assoc($query_info);

$id_head_of_department = $row_info['head_of_department'];
$sql_head_of_department = "SELECT * FROM users WHERE id='$id_head_of_department' LIMIT 1";
$query_head_of_department = mysqli_query($con, $sql_head_of_department);
$row_head_of_department = mysqli_fetch_assoc($query_head_of_department);

$id_manager = $row_info['manager'];
$sql_manager = "SELECT * FROM users WHERE id='$id_manager' LIMIT 1";
$query_manager = mysqli_query($con, $sql_manager);
$row_manager = mysqli_fetch_assoc($query_manager);
?>

<form action="user/user_add.php" method="post">
  <div class="form-group">
    <label>Tên Phòng Ban:</label>
    <input type="text" name="display_name" class="form-control" value="<?php echo $row_info['display_name']; ?>"
      required="" />
  </div>
  <div class="form-group">
    <label>Mã Phòng Ban</label>
    <input type="text" name="name" class="form-control" value="<?php echo $row_info['name']; ?>" required="" />
  </div>

  <div class="form-group">
    <label>Khối:</label>
    <br />
    <select class="custom-select" name="block" value="<?php echo $row_info['block']; ?>">
      <option <?php if ($row_info['block'] == 'SX')
        echo "selected"; ?> value="SX">Sản Xuất</option>
      <option <?php if ($row_info['block'] == 'KD')
        echo "selected"; ?> value="KD">Kinh Doanh</option>
      <option <?php if ($row_info['block'] == 'KT')
        echo "selected"; ?> value="KT">Kỹ Thuật</option>
      <option <?php if ($row_info['block'] == 'NC')
        echo "selected"; ?> value="NC">Nội Chính</option>

    </select>
  </div>
  <div class="form-group">
    <label>Ghi chú:</label>
    <textarea class="form-control" aria-label="With textarea" name="issue"
      required=""><?php echo $row_info['note']; ?></textarea>
  </div>

  <input type="submit" class="btn btn-block btn-info" value="Cập nhập" />
</form>
<div class="form-group">
  <label>Trưởng Phòng/Ban:</label>
  <input type="text" name="head_of_department" class="form-control" value="<?php echo $row_head_of_department['username'] . " - " . $row_head_of_department['display_name']
    . " - " . $row_head_of_department['jobTitle'] . " - " . $row_head_of_department['department']; ?>" disabled />
  <input type="button" name="edit_head_of_department" id="edit_head_of_department" class="btn btn-block btn-warning"
    value="Thay Đổi" />
</div>

<div class="form-group">
  <label>Lãnh đạo:</label>
  <input type="text" name="manager" class="form-control" value="<?php echo $row_manager['username'] . " - " . $row_manager['display_name']
    . " - " . $row_manager['jobTitle'] . " - " . $row_manager['department']; ?>" disabled />
  <input type="button" name="edit_manager" id="edit_manager" class="btn btn-block btn-warning" value="Thay Đổi" />
</div>
</div>



<script type="text/javascript">
  // $(document).ready(function () {
    $('#edit_head_of_department').click(function () {
      var id = <?php echo json_encode($row_info['id']) ?>;
      window.location = "department/deparment_change_head_of_department.php?sid=" + id;
  });
  // });
</script>
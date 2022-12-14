<script src="js/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
</script>

<?php
include('connection.php');
$id = $_GET["sid"];
$sql = "SELECT * FROM item WHERE id='$id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
$name = $row['name'];
$field = $row['field'];
$username = strtoupper($_SESSION["username"]);
$display_name = $_SESSION["display_name"];
$leve = $_SESSION["level"];
$email = $_SESSION["email"];
$user_id = $_SESSION["user_id"];
function checkuserdisable(){
  include('connection.php');
  $id_item = $_GET["sid"];
  $sql_item = "SELECT * FROM item WHERE id='$id_item' LIMIT 1";
  $query_item = mysqli_query($con,$sql_item);
  $row_item = mysqli_fetch_assoc($query_item);
  $username = strtoupper($_SESSION["username"]);
  $leve_user = $_SESSION["level"];

  $user_id = $_SESSION["user_id"];
  if($username != $row_item['create_by'] || $row_item['status'] != 1){         
    echo "disabled";
  }else{
    echo "";
  }  
}

function checkuserhidden(){
  include('connection.php');
  $id_item = $_GET["sid"];
  $sql_item = "SELECT * FROM item WHERE id='$id_item' LIMIT 1";
  $query_item = mysqli_query($con,$sql_item);
  $row_item = mysqli_fetch_assoc($query_item);
  $username = strtoupper($_SESSION["username"]);
  $leve_user = $_SESSION["level"];

  $user_id = $_SESSION["user_id"];
  if($username != $row_item['create_by'] || $row_item['status'] != 1){         
    echo "hidden";
  }else{
    echo "";
  }  
}
?>

<div class="container">
  <h1 class = "d-flex justify-content-center">THÔNG TIN ĐỀ ÁN</h1>
  <form action = "modun_project/project/project_edit_handle.php" method = "post">
    <input type="hidden" name="id" id="id" <?php echo 'value = "'.$row['id'].'"' ?>>
    <div class="form-group">
        <label>Trạng thái đề án:</label>
        <br/>
        <select class="custom-select <?php 
        if($row['status'] == 'Chấp Thuận') 
        {
          echo "bg-success text-white";
        }elseif($row['status'] == 'Từ Chối') 
        { 
          echo "bg-danger text-white";
        } 
        ?>            
        "  disabled name="status" <?php if($level != 3) {echo "disabled";} else{ echo 'value = "'.$row['status'].'"';} ?>>
            <option <?php if($row['status'] == 1) echo"selected"; ?>  value="1">Khởi Tạo</option>
            <option <?php if($row['status'] == 2) echo"selected"; ?>  value="2">Chờ bổ sung thông tin</option>
            <option <?php if($row['status'] == 3) echo"selected"; ?>  value="3">Xác Nhận</option>
            <option <?php if($row['status'] == 4) echo"selected"; ?>  value="4">Chấp Thuận</option>
            <option <?php if($row['status'] == 5) echo"selected"; ?>  value="5">Từ Chối</option>
        </select>
    </div>


    <div class="form-group">
      <label>Được tạo bởi:</label>
      <input type="text" name = "create_by1" class="form-control" placeholder="Username" 
      <?php echo 'value = "'.$row['create_by'].' ('.$row['display_name'].')"' ?> disabled/>
    </div>

    <div class="form-group">
      <label>Tên Đề Án:</label>
      <input type="text" name = "name" class="form-control" placeholder="Bạn cần nhập thông tin" required="" 
       value ="<?php echo $row['name'] ?>" 
      <?php checkuserdisable();?>
      />
    </div>

    <div class="form-group">
        <label>Lĩnh Vực:</label>
        <br/>
        <select class="custom-select" name="field" required="" <?php checkuserdisable();?>>
            <!-- <option value = "">Chọn lĩnh vực</option> -->
            <?php
            $sql_category = "select *from category";
            $result_sql_category = mysqli_query($con, $sql_category);
            if (mysqli_num_rows($result_sql_category) > 0) 
            {
              while($row_category = mysqli_fetch_array($result_sql_category)){
                ?>

              <option <?php if ($field == $row_category['id']) echo"selected"; ?> value="<?php echo $row_category["id"] ?>"><?php echo $row_category["name"] ?></option>

                <?php
              }
            }
            ?>
        </select>
    </div>
    
    <div class="form-group">
      <label>Cơ sở thực trạng:</label>
      <textarea class="form-control" aria-label="With textarea" name = "base"
      <?php checkuserdisable();?>
      ><?php echo $row['base']; ?></textarea>
    </div>

    <div class="form-group">
      <label>Ý tưởng, đề xuất:</label>
      <textarea class="form-control" aria-label="With textarea" name = "issue"<?php checkuserdisable();?>><?php echo $row['issue']; ?></textarea>
    </div>
    
    <div class="form-group">
      <label>Phòng ban tham gia:</label>
      <input type="text" name = "department" class="form-control" placeholder="Username" 
      value = "<?php echo $row['department']; ?>" disabled/>
    </div>


    <input type ="submit" class = "btn btn-block btn-info" value="CẬP NHẬP"  <?php checkuserhidden();?> />
  </form>
</div>

<div class="container-fluid" >
    <h1 class="text-center">DANH SÁCH NHÂN VIÊN THAM GIA</h1>
    <div class="row">
      <div class="container">
      <div class="btnAdd">
          <a href="project_user_add_form_screen.php?sid=<?php echo $id?>"  class="btn btn-success btn-sm"
          <?php checkuserhidden();?> 
          >THÊM NHÂN VIÊN</a>
        </div>
        <table class="table table-bordered table-sm">
    <thead>
      <tr>
        <th>Id</th>
        <th>Mã nhân viên</th>
        <th>Tên hiển thị</th>
        <th>Email</th>
        <th>Chức danh</th>
        <th>Phòng ban</th>
        <th></th>
      </tr>
    </thead>
    <tbody>   
    <?php
      $sql1 = "SELECT users.id, users.employeeNumber, users.display_name, users.email,users.jobTitle, users.department 
      FROM users INNER JOIN user_item ON users.id = user_item.employee_id
      where user_item.item_id = '$id';";
      $result1 = $con->query($sql1);
  
   
      if ($result1->num_rows > 0) {
        // Load dữ liệu lên website
        while($r = mysqli_fetch_assoc($result1)) 
        {
          ?>
          <tr>
            <td><?php echo $r['id']; ?></td>
            <td><?php echo $r['employeeNumber']; ?></td>
            <td><?php echo $r['display_name']; ?></td>
            <td><?php echo $r['email']; ?></td>
            <td><?php echo $r['jobTitle']; ?></td>
            <td><?php echo $r['department']; ?></td>
            <td><a href="modun_project/project/project_user_delete_handle.php?item_id=<?php echo $row['id']; ?>,<?php echo $r['id']; ?>" class ="btn btn-danger" <?php 
            checkuserhidden();         
            ?>>Xóa</a></td>
        <?php
        }
        } else {
        echo "0 Có nhân viên tham gia";
        }
        $con->close();
        ?>
   </tbody>
  </table>
      </div>
    </div>
  </div>




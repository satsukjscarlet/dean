<?php
include('connection.php');
$id = $_GET["sid"];
$sql = "SELECT * FROM item WHERE id='$id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
$name = $row['name']
?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = 
    '<div><input type="text" required="" placeholder="Bạn cần nhập mã nhân viên" name="field_name[]" value=""/> <a href="javascript:void(0);" class="remove_button"><i class="fa fa-minus style:"></i></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
<?php 
$username = $_SESSION["username"];
$display_name = $_SESSION["display_name"];
$level = $_SESSION["level"];
$email = $_SESSION["email"];
?>
<div class="container">
  <h2>PHÊ DUYỆT, CHỈNH SỬA ĐỀ ÁN, Ý TƯỞNG</h2>
  <form action = "form/project_edit_handle.php" method = "post">

    <div class="form-group">
      <label>Được tạo bởi:</label>
      <input type="text" name = "create_by1" class="form-control" placeholder="Username" 
      <?php echo 'value = "'.$row['create_by'].'"' ?> disabled/>
    </div>
    <input type="hidden" name="create_by" id="create_by" <?php echo 'value = "'.$row['create_by'].'"' ?>>
    <input type="hidden" name="id" id="id" <?php echo 'value = "'.$row['id'].'"' ?>>
    <div class="form-group">
      <label>Tên Đề Án:</label>
      <input type="text" name = "name" class="form-control" placeholder="Bạn cần nhập thông tin" required="" 
      <?php echo 'value = "'.$row['name'].'"' ?> 
      <?php 
        if($level != 3){
          if($username != $row['create_by'] || $row['status'] != "Khởi Tạo"){         
            echo "disabled";
          }
        }         
      ?>/>
    </div>
<!-- type -->
    <div class="form-group">
        <label>Phòng ban xác nhận, hoặc từ chối:</label>
        <br/>
        <select class="custom-select" id="type" name="type" <?php echo 'value = "'.$row['deparment_approve'].'"' ?>
        <?php 
        if($level != 3){
          if($username != $row['create_by'] || $row['status'] != "Khởi Tạo"){         
            echo "disabled";
          }
        }         
        ?>
        >
          <option <?php if($row['type'] == '0') echo"selected"; ?> value="0">Chờ xác nhận</option>
            <option <?php if($row['type'] == '1') echo"selected"; ?> value="1">Xác nhận</option>
            <option <?php if($row['type'] == '2') echo"selected"; ?> value="2">Từ chối</option>
        </select>
    </div>
<!-- type -->
    <div class="form-group">
        <label>Lãnh đạo phê duyệt:</label>
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
        " name="status" <?php if($level == 1) {echo "disabled";} else{ echo 'value = "'.$row['status'].'"';} ?>>
            <option <?php if($row['status'] == 'Khởi Tạo') echo"selected"; ?>  value="Khởi Tạo">Khởi Tạo</option>
            <option <?php if($row['status'] == 'Chấp Thuận') echo"selected"; ?> value="Chấp Thuận">Chấp Thuận</option>
            <option <?php if($row['status'] == 'Từ Chối') echo"selected"; ?> value="Từ Chối">Từ Chối</option>
        </select>
    </div>
    
    <div class="form-group">
      <label>Cơ sở thực hiện:</label>
      <textarea class="form-control" aria-label="With textarea" name = "base"
      <?php 
        if($level != 3){
          if($username != $row['create_by'] || $row['status'] != "Khởi Tạo"){  
            echo "disabled";
          }
        }         
      ?>
      ><?php echo $row['base']; ?></textarea>
    </div>

    <div class="form-group">
      <label>Vấn đề còn tồn tại khi chưa áp dụng ý tưởng/cải tiến/Sáng Kiến/đề tài:</label>
      <textarea class="form-control" aria-label="With textarea" name = "issue"
      
      <?php 
        if($level != 3){
          if($username != $row['create_by'] || $row['status'] != "Khởi Tạo"){         
            echo "disabled";
          }
        }         
      ?>><?php echo $row['issue']; ?></textarea>
    </div>
    <!-- giatien -->
    <div class="form-group">
        <label>Chi Thưởng:</label>
        <br/>
        <select class="custom-select" id="reward" name="reward" <?php echo 'value = "'.$row['reward'].'"' ?>
        <?php 
        if($level != 3){
            echo "disabled";
          }         
        ?>
        >
            <option <?php if($row['reward'] == '') echo"selected"; ?> value="">0 VND</option>
            <option <?php if($row['reward'] == '100000') echo"selected"; ?> value="100000 ">100.000 VND</option>
            <option <?php if($row['reward'] == '120000') echo"selected"; ?> value="120000">120.000 VND</option>
            <option <?php if($row['reward'] == '150000') echo"selected"; ?> value="150000">150.000 VND</option>
            <option <?php if($row['reward'] == '180000') echo"selected"; ?> value="180000">180.000 VND</option>
            <option <?php if($row['reward'] == '200000') echo"selected"; ?> value="200000">200.000 VND</option>
        </select>
    </div>
    <!-- giatien -->


    <div class="form-group">
      <label>Ghi chú:</label>
      <textarea class="form-control" aria-label="With textarea" name = "note"
      <?php 
        if($level != 3){
          if($username != $row['create_by'] || $row['status'] != "Khởi Tạo"){         
            echo "disabled";
          }
        }         
      ?>
      ><?php echo $row['note']; ?></textarea>
    </div>
    <input type ="submit" class = "btn btn-block btn-info" value="CẬP NHẬP" 
    <?php 
        if($level != 3){
          if($username != $row['create_by'] || $row['status'] != "Khởi Tạo"){         
            echo "hidden";
          }
        }         
      ?>
    />
  </form>
</div>
<!-- 123 -->

   


<div class="container-fluid" >
    <h1 class="text-center">DANH SÁCH NHÂN VIÊN THAM GIA</h1>
    <div class="row">
      <div class="container">
      <div class="btnAdd">
          <a href="project_user_add_form.php?sid=<?php echo $id?>"  class="btn btn-success btn-sm"
          <?php 
           if($level != 3){
            if($username != $row['create_by'] || $row['status'] != "Khởi Tạo"){         
              echo "hidden";
            }
          }         
          ?>
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
      FROM users INNER JOIN user_item ON users.employeeNumber = user_item.employeeNumber 
      where user_item.item_name = '$name';";
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
            <td><a href="form/project_user_delete_handle.php?item_id=<?php echo $row['id']; ?>,<?php echo $r['employeeNumber']; ?>" class ="btn btn-danger" <?php 
             if($level != 3){
              if($username != $row['create_by'] || $row['status'] != "Khởi Tạo"){         
                echo "hidden";
              }
            }         
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
<script src="js/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
</script>
<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
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
  if($username != $row_item['create_by'] || $row_item['status'] > 2){         
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
  if($username != $row_item['create_by'] || $row_item['status'] > 2){         
    echo "hidden";
  }else{
    echo "";
  }
}

function checkuserlevel_xacnhan(){
  include('connection.php');
  $id_item = $_GET["sid"];
  $sql_item = "SELECT * FROM item WHERE id='$id_item' LIMIT 1";
  $query_item = mysqli_query($con,$sql_item);
  $row_item = mysqli_fetch_assoc($query_item);
  $item_department = $row_item["department"];

  $username = strtoupper($_SESSION["username"]);
  $leve_user = $_SESSION["level"];
  $department = $_SESSION["department"];

  $explode_department = explode(',', $item_department);
	$check_department = 0;

	foreach($explode_department as $value_department){
		if($department == $value_department){
			$check_department = 1;
		}
	}

  if($leve_user == 2 && $check_department == 1 && $row_item['status'] != 4  && $row_item['status'] != 3){   
    echo "";
  }else{
    echo "hidden";
  }  
}

function checkuserlevel_tuchoi(){
  include('connection.php');
  $id_item = $_GET["sid"];
  $sql_item = "SELECT * FROM item WHERE id='$id_item' LIMIT 1";
  $query_item = mysqli_query($con,$sql_item);
  $row_item = mysqli_fetch_assoc($query_item);
  $item_department = $row_item["department"];

  $username = strtoupper($_SESSION["username"]);
  $leve_user = $_SESSION["level"];
  $department = $_SESSION["department"];

  $explode_department = explode(',', $item_department);
	$check_department = 0;

	foreach($explode_department as $value_department){
		if($department == $value_department){
			$check_department = 1;
		}
	}

  if($leve_user == 3 && $check_department == 1 && $row_item['status'] == 3){   
    echo "";
  }
  elseif ($leve_user == 2 && $check_department == 1 && $row_item['status'] != 4 && $row_item['status'] != 5) {
    echo "";
  }else{
    echo "hidden";
  }  
}

function checkuserlevel_themthongtin(){
  include('connection.php');
  $id_item = $_GET["sid"];
  $sql_item = "SELECT * FROM item WHERE id='$id_item' LIMIT 1";
  $query_item = mysqli_query($con,$sql_item);
  $row_item = mysqli_fetch_assoc($query_item);
  $item_department = $row_item["department"];

  $username = strtoupper($_SESSION["username"]);
  $leve_user = $_SESSION["level"];
  $department = $_SESSION["department"];

  $explode_department = explode(',', $item_department);
	$check_department = 0;

	foreach($explode_department as $value_department){
		if($department == $value_department){
			$check_department = 1;
		}
	}

  if($leve_user == 3 && $check_department == 1 && $row_item['status'] == 3){   
    echo "";
  }
  elseif ($leve_user == 2 && $check_department == 1 && $row_item['status'] != 4 && $row_item['status'] != 2) {
    echo "";
  }else{
    echo "hidden";
  }  
}

function checkuserlevel_pheduyet(){
  include('connection.php');
  $id_item = $_GET["sid"];
  $sql_item = "SELECT * FROM item WHERE id='$id_item' LIMIT 1";
  $query_item = mysqli_query($con,$sql_item);
  $row_item = mysqli_fetch_assoc($query_item);
  $item_department = $row_item["department"];

  $username = strtoupper($_SESSION["username"]);
  $leve_user = $_SESSION["level"];
  $department = $_SESSION["department"];

  $explode_department = explode(',', $item_department);
	$check_department = 0;

	foreach($explode_department as $value_department){
		if($department == $value_department){
			$check_department = 1;
		}
	}

  if($leve_user == 3 && $check_department == 1 && $row_item['status'] == 3){   
    echo "";
  }
 else{
    echo "hidden";
  }  
}

?>

<div class="container">
  <h1 class = "d-flex justify-content-center">TH??NG TIN ?? T?????NG</h1>
  <form action = "modun_project/project/project_edit_handle.php" method = "post">
    <input type="hidden" name="id" id="id" <?php echo 'value = "'.$row['id'].'"' ?>>

    <div class="form-group">
        <label>Tr???ng th??i ?? t?????ng:</label>
        <br/>
        <select class="custom-select <?php 
        if($row['status'] == 'Ch???p Thu???n') 
        {
          echo "bg-success text-white";
        }elseif($row['status'] == 'T??? Ch???i') 
        { 
          echo "bg-danger text-white";
        } 
        ?>            
        "  disabled name="status" <?php if($level != 3) {echo "disabled";} else{ echo 'value = "'.$row['status'].'"';} ?>>
            <option <?php if($row['status'] == 1) echo"selected"; ?>  value="1">Kh???i T???o</option>
            <option <?php if($row['status'] == 2) echo"selected"; ?>  value="2">Ch??? b??? sung th??ng tin</option>
            <option <?php if($row['status'] == 3) echo"selected"; ?>  value="3">X??c Nh???n</option>
            <option <?php if($row['status'] == 4) echo"selected"; ?>  value="4">Ph?? Duy???t</option>
            <option <?php if($row['status'] == 5) echo"selected"; ?>  value="5">T??? Ch???i</option>
        </select>
    </div>


    <div class="form-group">
      <label>???????c t???o b???i:</label>
      <input type="text" name = "create_by1" class="form-control" placeholder="Username" 
      <?php echo 'value = "'.$row['create_by'].' ('.$row['display_name'].')"' ?> disabled/>
    </div>

    <div class="form-group">
      <label>T??n ?? T?????ng:</label>
      <input type="text" name = "name" class="form-control" placeholder="B???n c???n nh???p th??ng tin" required="" 
       value ="<?php echo $row['name'] ?>" 
      <?php checkuserdisable();?>
      />
    </div>

    <div class="form-group">
        <label>L??nh V???c:</label>
        <br/>
        <select class="custom-select" name="field" required="" <?php checkuserdisable();?>>
            <!-- <option value = "">Ch???n l??nh v???c</option> -->
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
      <label>Th???c tr???ng hi???n nay:</label>
      <textarea class="form-control" aria-label="With textarea" name = "base"
      <?php checkuserdisable();?>
      ><?php echo $row['base']; ?></textarea>
    </div>

    <div class="form-group">
      <label>T??m t???t ?? t?????ng:</label>
      <textarea class="form-control" aria-label="With textarea" name = "issue"<?php checkuserdisable();?>><?php echo $row['issue']; ?></textarea>
    </div>
    
    <div class="form-group">
      <label>Ph??ng ban tham gia:</label>
      <input type="text" name = "department" class="form-control"
      value = "<?php echo $row['department']; ?>" disabled/>
    </div>
    <input type ="submit" class = "btn btn-block btn-info" value="C???P NH???P"  <?php checkuserhidden();?> />
  </form>
  <input href="javascript:void();" data-id="<?php echo $row['id']; ?>" type ="submit" class="btn btn-block btn-success pheduyetBtn" value="PH?? DUY???T"  <?php checkuserlevel_pheduyet();?> />
  <input href="javascript:void();" data-id="<?php echo $row['id']; ?>" type ="submit" class="btn btn-block btn-primary xacnhanBtn" value="X??C NH???N"  <?php checkuserlevel_xacnhan();?> />
  <input href="javascript:void();" data-id="<?php echo $row['id']; ?>" type ="submit"  class="btn btn-block btn-warning themthongtinBtn" value="Y??U C???U B??? SUNG TH??NG TIN"  <?php checkuserlevel_themthongtin();?> />
  <input href="javascript:void();" data-id="<?php echo $row['id']; ?>" type ="submit" class="btn btn-block btn-danger tuchoiBtn" value="T??? CH???I"  <?php checkuserlevel_tuchoi();?> />
</div>

<div class="container-fluid" >
    <h1 class="text-center">DANH S??CH NH??N VI??N THAM GIA</h1>
    <div class="row">
      <div class="container">
      <div class="btnAdd">
          <a href="project_user_add_form_screen.php?sid=<?php echo $id?>"  class="btn btn-success btn-sm"
          <?php checkuserhidden();?> 
          >TH??M NH??N VI??N</a>
        </div>
        <table class="table table-bordered table-sm">
    <thead>
      <tr>
        <th>Id</th>
        <th>M?? nh??n vi??n</th>
        <th>T??n hi???n th???</th>
        <th>Email</th>
        <th>Ch???c danh</th>
        <th>Ph??ng ban</th>
        <th>Ti???n Th?????ng (VND)</th>
        <th></th>
      </tr>
    </thead>
    <tbody>   
    <?php
      $sql1 = "SELECT users.id, users.employeeNumber, users.display_name, users.email,users.jobTitle, users.department, user_item.reward
      FROM users INNER JOIN user_item ON users.id = user_item.employee_id
      where user_item.item_id = '$id';";
      $result1 = $con->query($sql1);
  
   
      if ($result1->num_rows > 0) {
        // Load d??? li???u l??n website
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
            <td><?php echo $r['reward'].".000"; ?></td>
            <td><a href="modun_project/project/project_user_delete_handle.php?item_id=<?php echo $row['id']; ?>,<?php echo $r['id']; ?>" class ="btn btn-danger" <?php 
            checkuserhidden();         
            ?>>X??a</a></td>
        <?php
        }
        } else {
        echo "0 C?? nh??n vi??n tham gia";
        }
        $con->close();
        ?>
   </tbody>
  </table>
      </div>
    </div>
  </div>


<script>

$(document).on('click', '.pheduyetBtn', function(event) {
      var table = $('#example').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      if (confirm("B???n mu???n ph?? duy???t ?? t?????ng n??y? ")) {

        $.ajax({
          url: "modun_project/project_lanhdao/pheduyet.php",
          data: {
            id: id
          },
          type: "post",
          beforeSend: function(){
            $('#exampleModal_loading').modal('show');
          },
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;            
            if (status == 'success') {
              location.reload();
              $('#exampleModal_loading').modal('hide');
            } else {
              $('#loadingIcon').hide();
              alert('Failed');
              return;
            }
          }
        });
      } else {
        return null;
      }
    });
    
 $(document).on('click', '.xacnhanBtn', function(event) {
      var table = $('#example').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      if (confirm("B???n mu???n x??c nh???n ?? t?????ng n??y? ")) {

        $.ajax({
          url: "modun_project/project_truongbophan/xacnhan.php",
          data: {
            id: id
          },
          type: "post",
          beforeSend: function(){
            $('#exampleModal_loading').modal('show');
          },
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;            
            if (status == 'success') {
              location.reload();
              $('#exampleModal_loading').modal('hide');
            } else {
              $('#loadingIcon').hide();
              alert('Failed');
              return;
            }
          }
        });
      } else {
        return null;
      }
    });

    //tu choi
    $(document).on('submit', '#cancel', function(e) {
      e.preventDefault();
      var note = $('#note_cancel').val();
      var id = $('#id').val();
      if (note != '') {
        $.ajax({
          url: "modun_project/project_truongbophan/tuchoi.php",
          type: "post",
          data: {
            note: note,
            id: id
          },
          beforeSend: function(){
            $('#exampleModal_loading').modal('show');
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'success') {
              location.reload();
              $("input[type=text]").val("");
              $("textarea").val("");
              $('#exampleModal_loading').modal('hide');
              $('#exampleModal_tuchoi').modal('hide');
            } else {
              alert('C???p nh???p l???i');
            }
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    });

    $(document).on('click', '.tuchoiBtn', function(event)  {
      // console.log(selectedRow);
      var id = $(this).data('id');
      if (confirm("B???n mu???n t??? ch???i ?? t?????ng n??y? ")) {
      $('#exampleModal_tuchoi').modal('show');
      $.ajax({
        url: "modun_project/project_truongbophan/item_get_single_data.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#id').val(id);
        }
      })
    } else {
        return null;
      }   
    });

    $(document).on('submit', '#info', function(e) {
      e.preventDefault();
      var note = $('#note_info').val();
      var id = $('#id').val();
      if (note != '') {
        $.ajax({
          url: "modun_project/project_truongbophan/themthongtin.php",
          type: "post",
          data: {
            note: note,
            id: id
          },
          beforeSend: function(){
            $('#exampleModal_loading').modal('show');
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'success') {
              location.reload();
              $("input[type=text]").val("");
              $("textarea").val("");
              $('#exampleModal_loading').modal('hide');
              $('#exampleModal_themthongtin').modal('hide');
            } else {
              alert('C???p nh???p l???i');
            }
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    });

    $(document).on('click', '.themthongtinBtn', function(event)  {
      
      var id = $(this).data('id');
      if (confirm("B???n mu???n y??u c???u b??? sung th??ng tin ?? t?????ng n??y? ")) {
        $('#exampleModal_themthongtin').modal('show');
        $.ajax({
        url: "modun_project/project_truongbophan/item_get_single_data.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#id').val(id);
        }
      })
    } else {
        return null;
      }   
    });

</script>

   <!-- Modal- Tu choi -->
   <div class="modal fade" id="exampleModal_tuchoi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">T??? ch???i ?? t?????ng</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="cancel">
            <input type="hidden" name="id" id="id" value="">
            <div class="mb-3 row">
              <label for="note_cancel" class="col-md-3 form-label">L?? do t??? ch???i</label>
              <div class="col-md-9">
                <textarea class="form-control" aria-label="With textarea" id = "note_cancel" name = "note_cancel" required=""></textarea>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">X??c nh???n</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">H???y</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal_themthongtin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Y??u c???u b??? sung th??ng tin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="info">
            <input type="hidden" name="id" id="id" value="">
            <div class="mb-3 row">
              <label class="col-md-3 form-label">Th??ng tin c???n b??? sung</label>
              <div class="col-md-9">
                <textarea class="form-control" aria-label="With textarea" id = "note_info" name = "note_info" required=""></textarea>
              </div>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">X??c nh???n</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">H???y</button>
        </div>
      </div>
    </div>
  </div>

  <!-- loading -->
<div class="modal fade" id="exampleModal_loading" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <img id ="loadingIcon" src = "build/images/loading.gif" />
        <h5 class="modal-title" id="exampleModalLabel">??ang x??? l?? xin vui l??ng ?????i m???t ch??t</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    </div>
  </div>
</div>
  
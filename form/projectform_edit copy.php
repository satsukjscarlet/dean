<?php
include('connection.php');
$id = $_GET["sid"];
$sql = "SELECT * FROM item WHERE id='$id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);

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
      <?php echo 'value = "'.$row['name'].'"' ?> />
    </div>

    <div class="form-group">
        <label>Loại đề án:</label>
        <br/>
        <select class="custom-select" id="type" name="type" <?php echo 'value = "'.$row['type'].'"' ?>>
            <option <?php if($row['type'] == 'Ý Tưởng') echo"selected"; ?> value="Ý Tưởng">Ý Tưởng</option>
            <option <?php if($row['type'] == 'Cải Tiến') echo"selected"; ?> value="Cải Tiến">Cải Tiến</option>
            <option <?php if($row['type'] == 'Sáng Kiến') echo"selected"; ?> value="Sáng Kiến">Sáng Kiến</option>
            <option <?php if($row['type'] == 'Đề Tài') echo"selected"; ?> value="Đề Tài">Đề Tài</option>
        </select>
    </div>

    <div class="form-group">
        <label>Trạng thái:</label>
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
      <textarea class="form-control" aria-label="With textarea" name = "base"><?php echo $row['base']; ?></textarea>
    </div>

    <div class="form-group">
      <label>Vấn đề còn tồn tại khi chưa áp dụng ý tưởng/cải tiến/Sáng Kiến/đề tài:</label>
      <textarea class="form-control" aria-label="With textarea" name = "issue"><?php echo $row['issue']; ?></textarea>
    </div>

    <div class="form-group">
      <label>Ghi chú:</label>
      <textarea class="form-control" aria-label="With textarea" name = "note"><?php echo $row['note']; ?></textarea>
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
          <a href="user_add.php"  class="btn btn-success btn-sm"
          <?php 
           if($level != 3){
            if($username != $row['create_by'] || $row['status'] != "Khởi Tạo"){         
              echo "hidden";
            }
          }         
          ?>
          >THÊM NHÂN VIÊN</a>
        </div>
        <div class="row">
          <div class="col-md-0"></div>
          <div class="col-md-12">
            <table id="example" class="table">
              <thead>
                <th>Id</th>
                <th>Mã nhân viên</th>
                <th>Tên hiển thị</th>
                <th>Email</th>
                <th>Chức vụ</th>
                <th>Phòng ban</th>
                <th>Options</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="col-md-0"></div>
        </div>
      </div>
    </div>
  </div>
  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <!-- <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var username = <?php echo json_encode($_SESSION["username"]) ?>;
      var level = <?php echo json_encode($_SESSION["level"]) ?>;
      var create_by = <?php echo json_encode($row['create_by']) ?>;
      var status = <?php echo json_encode($row['status']) ?>;
      var name = <?php echo json_encode($row['name']) ?>;
      if(level != 3){

        if(username != create_by|| status != "Khởi Tạo"){
        $('#example').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        "language": {
            "sProcessing":   "Đang xử lý...",
            "sLengthMenu":   "Xem _MENU_ mục",
            "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
            "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
            "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
            "sInfoFiltered": "(được lọc từ _MAX_ mục)",
            "sInfoPostFix":  "",
            "sSearch":       "Tìm:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Đầu",
                "sPrevious": "Trước",
                "sNext":     "Tiếp",
                "sLast":     "Cuối"
            }
        },
        "processing": true, // tiền xử lý trước
        "aLengthMenu": [[10, 20, 50], [10, 20, 50]], // danh sách số trang trên 1 lần hiển thị bảng
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'project_user_fetch_data_employee.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [6]
          },

        ]
      });
      }else
      
      {
        console.log(2);
        $('#example').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        "language": {
            "sProcessing":   "Đang xử lý...",
            "sLengthMenu":   "Xem _MENU_ mục",
            "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
            "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
            "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
            "sInfoFiltered": "(được lọc từ _MAX_ mục)",
            "sInfoPostFix":  "",
            "sSearch":       "Tìm:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Đầu",
                "sPrevious": "Trước",
                "sNext":     "Tiếp",
                "sLast":     "Cuối"
            }
        },
        "processing": true, // tiền xử lý trước
        "aLengthMenu": [[10, 20, 50], [10, 20, 50]], // danh sách số trang trên 1 lần hiển thị bảng
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'project_user_fetch_data_admin.php/sid='+name,
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [6]
          },

        ]
      });
      }
      }else
      {
        console.log(3);
        $('#example').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        "language": {
            "sProcessing":   "Đang xử lý...",
            "sLengthMenu":   "Xem _MENU_ mục",
            "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
            "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
            "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
            "sInfoFiltered": "(được lọc từ _MAX_ mục)",
            "sInfoPostFix":  "",
            "sSearch":       "Tìm:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Đầu",
                "sPrevious": "Trước",
                "sNext":     "Tiếp",
                "sLast":     "Cuối"
            }
        },
        "processing": true, // tiền xử lý trước
        "aLengthMenu": [[10, 20, 50], [10, 20, 50]], // danh sách số trang trên 1 lần hiển thị bảng
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'project_user_fetch_data_admin.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [6]
          },

        ]
      });
      }
      // console.log(status);
    });
  </script>











<!-- 123 -->






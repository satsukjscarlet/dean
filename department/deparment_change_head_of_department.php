<?php include('../connection.php'); 
session_start();
if(!isset($_SESSION["username"]))
{
    header("location: http://localhost/dean/login.php");  
}
$id_department = $_GET["sid"];
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="../css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../css/datatables-1.10.25.min.css" />
  <title>CHỌN TRƯỞNG BỘ PHẬN</title>
</head>


<body>
  <div class="container-fluid">
    <h1 class="text-center">CHỌN TRƯỞNG BỘ PHẬN</h1>
    <div class="row">
      <div class="container">
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
                <!-- <th>City</th>
                <th>Options</th> -->
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

  <script src="../js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../js/dt-1.10.25datatables.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
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
          'data': {
          id: <?php echo json_encode($id_department) ?>},
          'url': 'deparment_change_head_of_department_fetch_data.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [6]
          },
        ]
      });
    });
    
    $('#example').on('click', '.editbtn ', function(event) {
      var table = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      var id = $(this).data('id');
      var username = <?php echo json_encode($_SESSION["username"]) ?>;
      var id_department = <?php echo json_encode($id_department) ?>;
      window.location = "department_add_head_handle.php?sid="+id+","+id_department;

    });
  </script>
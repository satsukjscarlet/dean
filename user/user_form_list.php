<?php include('connection.php'); ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <!-- <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous"> -->
  <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
  <!-- <style type="text/css">
    .btnAdd {
      text-align: right;
      width: 83%;
      margin-bottom: 20px;
    }
  </style> -->
</head>

<body>
  <div class="container-fluid">
    <h1 class="text-center">DANH SÁCH TÀI KHOẢN</h1>
    <div class="row">
      <div class="container">
      <div class="btnAdd">
          <a href="user_add_screen.php"  class="btn btn-success btn-sm">THÊM MỚI TÀI KHOẢN</a>
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
                <th>Tùy chọn</th>
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
  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <!-- <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  -->
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
          'url': 'user/user_fetch_data.php',
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
      window.location = "user_add_screen.php?sid="+id;
    });
    // $(document).on('submit', '#addUser', function(e) {
    //   e.preventDefault();
    //   var city = $('#addCityField').val();
    //   var username = $('#addUserField').val();
    //   var mobile = $('#addMobileField').val();
    //   var email = $('#addEmailField').val();
    //   if (city != '' && username != '' && mobile != '' && email != '') {
    //     $.ajax({
    //       url: "add_user.php",
    //       type: "post",
    //       data: {
    //         city: city,
    //         username: username,
    //         mobile: mobile,
    //         email: email
    //       },
    //       success: function(data) {
    //         var json = JSON.parse(data);
    //         var status = json.status;
    //         if (status == 'true') {
    //           mytable = $('#example').DataTable();
    //           mytable.draw();
    //           $('#addUserModal').modal('hide');
    //         } else {
    //           alert('failed');
    //         }
    //       }
    //     });
    //   } else {
    //     alert('Fill all the required fields');
    //   }
    // });
    // $(document).on('submit', '#updateUser', function(e) {
    //   e.preventDefault();
    //   //var tr = $(this).closest('tr');
    //   var city = $('#cityField').val();
    //   var username = $('#nameField').val();
    //   var mobile = $('#mobileField').val();
    //   var email = $('#emailField').val();
    //   var trid = $('#trid').val();
    //   var id = $('#id').val();
    //   if (city != '' && username != '' && mobile != '' && email != '') {
    //     $.ajax({
    //       url: "update_user.php",
    //       type: "post",
    //       data: {
    //         city: city,
    //         username: username,
    //         mobile: mobile,
    //         email: email,
    //         id: id
    //       },
    //       success: function(data) {
    //         var json = JSON.parse(data);
    //         var status = json.status;
    //         if (status == 'true') {
    //           table = $('#example').DataTable();
    //           // table.cell(parseInt(trid) - 1,0).data(id);
    //           // table.cell(parseInt(trid) - 1,1).data(username);
    //           // table.cell(parseInt(trid) - 1,2).data(email);
    //           // table.cell(parseInt(trid) - 1,3).data(mobile);
    //           // table.cell(parseInt(trid) - 1,4).data(city);
    //           var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
    //           var row = table.row("[id='" + trid + "']");
    //           row.row("[id='" + trid + "']").data([id, username, email, mobile, city, button]);
    //           $('#exampleModal').modal('hide');
    //         } else {
    //           alert('failed');
    //         }
    //       }
    //     });
    //   } else {
    //     alert('Fill all the required fields');
    //   }
    // });
    // $('#example').on('click', '.editbtn ', function(event) {
    //   var table = $('#example').DataTable();
    //   var trid = $(this).closest('tr').attr('id');
    //   // console.log(selectedRow);
    //   var id = $(this).data('id');
    //   $('#exampleModal').modal('show');

    //   $.ajax({
    //     url: "get_single_data.php",
    //     data: {
    //       id: id
    //     },
    //     type: 'post',
    //     success: function(data) {
    //       var json = JSON.parse(data);
    //       $('#nameField').val(json.username);
    //       $('#emailField').val(json.email);
    //       $('#mobileField').val(json.mobile);
    //       $('#cityField').val(json.city);
    //       $('#id').val(id);
    //       $('#trid').val(trid);
    //     }
    //   })
    // });

    $(document).on('click', '.deleteBtn', function(event) {
      var table = $('#example').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      if (confirm("Xác nhận xóa tài khoản ? ")) {
        $.ajax({
          url: "delete_user.php",
          data: {
            id: id
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              //table.fnDeleteRow( table.$('#' + id)[0] );
              //$("#example tbody").find(id).remove();
              //table.row($(this).closest("tr")) .remove();
              $("#" + id).closest('tr').remove();
            } else {
              alert('Failed');
              return;
            }
          }
        });
      } else {
        return null;
      }
    })
  </script>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUser">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">
            <div class="mb-3 row">
              <label for="nameField" class="col-md-3 form-label">Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="nameField" name="name">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="emailField" class="col-md-3 form-label">Email</label>
              <div class="col-md-9">
                <input type="email" class="form-control" id="emailField" name="email">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="mobileField" class="col-md-3 form-label">Mobile</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="mobileField" name="mobile">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="cityField" class="col-md-3 form-label">City</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="cityField" name="City">
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Add user Modal -->
  <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addUser" action="">
            <div class="mb-3 row">
              <label for="addUserField" class="col-md-3 form-label">Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addUserField" name="name">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addEmailField" class="col-md-3 form-label">Email</label>
              <div class="col-md-9">
                <input type="email" class="form-control" id="addEmailField" name="email">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addMobileField" class="col-md-3 form-label">Mobile</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addMobileField" name="mobile">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addCityField" class="col-md-3 form-label">City</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addCityField" name="City">
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<script type="text/javascript">
  //var table = $('#example').DataTable();
</script>
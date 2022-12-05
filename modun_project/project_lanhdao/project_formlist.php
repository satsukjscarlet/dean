<?php $con  = mysqli_connect('localhost','root','','dean');
if(mysqli_connect_errno())
{
    echo 'Database Connection Error';
} ?>


  <div class="container-fluid">
    <h1 class="text-center">DANH SÁCH ĐỀ ÁN</h1>
    <div class="row">
      <div class="container">
      <div class="btnAdd">
          <a href="project_add.php"  class="btn btn-success btn-sm" >THÊM MỚI ĐỀ ÁN</a>
        </div>
        <div class="row">
          <div class="col-md-0"></div>
          <div class="col-md-12">
            <table id="example" class="table">
              <thead>
                <th>Id</th>
                <th>Người tạo</th>
                <th>Tên đề án</th>
                <th>Tên người tạo</th>
                <th>Phòng ban</th>
                <th>Khối</th>
                <th>Trạng thái</th>
                <th>Thời gian tạo</th>
                <th>Thông tin</th>
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
  <script src="../../js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <!-- <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
  <script type="text/javascript" src="../../js/dt-1.10.25datatables.min.js"></script>
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
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'project_fetch_data.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [8]
          },
        ]
      });
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
    //           var button = '<td><a href="javascript:void();" data-id="' 
    //           + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' 
    //           + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
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
    $('#example').on('click', '.editbtn ', function(event) {
      var table = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      var id = $(this).data('id');
      var username = <?php echo json_encode($_SESSION["username"]) ?>;
      window.location = "project_add.php?sid="+id;
      // $('#exampleModal').modal('show');
      // $.
      // $.ajax({
      //   url: "get_single_data.php",
      //   data: {
      //     id: id
      //   },
      //   type: 'post',
      //   success: function(data) {
      //     var json = JSON.parse(data);
      //     $('#nameField').val(json.username);
      //     $('#emailField').val(json.email);
      //     $('#mobileField').val(json.mobile);
      //     $('#cityField').val(json.city);
      //     $('#id').val(id);
      //     $('#trid').val(trid);
      //   }
      // })
    });

    // $(document).on('click', '.deleteBtn', function(event) {
    //   var table = $('#example').DataTable();
    //   event.preventDefault();
    //   var id = $(this).data('id');
    //   if (confirm("Are you sure want to delete this User ? ")) {
    //     $.ajax({
    //       url: "delete_user.php",
    //       data: {
    //         id: id
    //       },
    //       type: "post",
    //       success: function(data) {
    //         var json = JSON.parse(data);
    //         status = json.status;
    //         if (status == 'success') {
    //           //table.fnDeleteRow( table.$('#' + id)[0] );
    //           //$("#example tbody").find(id).remove();
    //           //table.row($(this).closest("tr")) .remove();
    //           $("#" + id).closest('tr').remove();
    //         } else {
    //           alert('Failed');
    //           return;
    //         }
    //       }
    //     });
    //   } else {
    //     return null;
    //   }



    // })
  </script>
  
<?php require('connection.php'); ?>

<style>
  table td {
    word-break: break-word;
    vertical-align: top;
    /* white-space: normal !important;
        /* text-overflow: ellipsis; */
    min-width: 10px;
    max-width: 150px;

  }

  table tr td:nth-child(4) {
    /* background: #ccc; */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 20ch;
  }

  .buttons-excel {
    margin-left: 2px;
    margin-right: 2px;
    padding: 2px;
    background-color: green;
  }

  .buttons-print {
    margin-left: 2px;
    margin-right: 2px;
    padding: 2px;
    /* background-color: green; */
  }

  .buttons-pdf {
    margin-left: 2px;
    margin-right: 2px;
    padding: 2px;
    background-color: orange;
  }
</style>
<div class="container-fluid">
  <h1 class="text-center">DANH SÁCH ĐỀ ÁN THEO PHÒNG BAN</h1>
  <div>
    <select class="custom-select" name="department" id ="department" value="">
      <option selected value="">Chọn phòng ban</option>
      <option value="NSCL">Nhân sự chiến lược</option>
      <option value="CNCL">Công nghệ chất lượng</option>
      <option value="DVKH">Dịch vụ khách hàng</option>
      <option value="KTNB">Kế toán nội bộ</option>
      <option value="MKT">Marketing</option>
      <option value="NCPT">Nghiên cứu phát triển</option>
      <option value="NMCK">Nhà máy cơ khí</option>
      <option value="NMPE">Nhà máy PE</option>
      <option value="NMPT1">Nhà máy phụ tùng 1</option>
      <option value="NMPT2">Nhà máy phụ tùng 2</option>
      <option value="NMPVC">Nhà máy PVC</option>
      <option value="PTTT1">Phát triển thị trường 1</option>
      <option value="PTTT2">Phát triển thị trường 2</option>
      <option value="QLDA">Quản lý dự án</option>
      <option value="TCKT">Tài chính kế toán</option>
      <option value="VT">Vật tư</option>
      <option value="VPCT">Văn phòng công ty</option>
    </select>
  </div>
  <div>
     <input type ="button" name="searchbtn" id="searchbtn" class = "btn btn-block btn-info" value="Lọc dữ liệu" />
  </div>
  </br>
</div>
<div class="container-fluid">

  <div class="row">
    <div class="container">
      <div class="row">
        <div class="col-md-0"></div>
        <div class="col-md-12">
          <table id="example" class="table">
            <thead>
              <th>Được tạo bởi</th>
              <th>Tên Đề Án</th>
              <th>Lĩnh Vực</th>
              <th>Tóm tắt ý tưởng</th>
              <th>Trạng thái</th>
              <th>Thời gian tạo</th>
              <!-- <th>Thao tác</th> -->
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
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
<link rel="stylesheet" href="js/DatePicker/themes/jquery-ui.css">
<script src="js/DatePicker/jquery-ui.js"></script>
<script src="js/DatePicker/jquery.ui.datepicker-vi.js"></script>

<script type="text/javascript">

  $(document).ready(function () {
    // $( ".datepicker" ).datepicker( $.datepicker.regional[ "vi" ] );
    // $('.datepicker').datepicker({
    //   dateFormat: "yy-mm-dd",
    //   autoclose: true,
    //   todayHighlight: true
    // },
    //   $.datepicker.regional['vi']
    // );

    // $('#datepicker').datepicker();
    // function today() {
    //   var d = new Date();
    //   var curr_date = d.getDate();
    //   var curr_month = d.getMonth() + 1;
    //   var curr_year = d.getFullYear();
    //   document.write(curr_date + "-" + curr_month + "-" + curr_year);
    // }
    // var department = json_encode();

    function fetch_data_search(is_search, department) {
      $('#example').DataTable({
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        dom: 'Blfrtip',
        buttons: [
          'excel', 'pdf', 'print'
        ],
        "language": {
          "sProcessing": "Đang xử lý...",
          "sLengthMenu": "Xem _MENU_ mục",
          "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
          "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
          "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
          "sInfoFiltered": "(được lọc từ _MAX_ mục)",
          "sInfoPostFix": "",
          "sSearch": "Tìm:",
          "sUrl": "",
          "oPaginate": {
            "sFirst": "Đầu",
            "sPrevious": "Trước",
            "sNext": "Tiếp",
            "sLast": "Cuối"
          }
        },
        "processing": true, // tiền xử lý trước
        "aLengthMenu": [[10, 20, 50, 100, 500], [10, 20, 50, 100, 500]], // danh sách số trang trên 1 lần hiển thị bảng
        'serverSide': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'report/project_by_department_fetch_data.php',
          'type': 'post',
          'data': {
            is_search: is_search, department: department
          }
        },
        "aoColumnDefs": [{
          "bSortable": false,
          "aTargets": [5]
        },
        ]
      });
    }

    $('#searchbtn').click(function () {
      var department = $('#department').val();
      if (department != '') {
        console.log(department);
        // console.log(end_date);
        $('#example').DataTable().destroy();
        fetch_data_search('yes', department);
      }
      else {
        alert("Bạn chưa chọn phòng ban");
      }
    });

  });

  $('#example').on('click', '.editbtn ', function (event) {
    var table = $('#example').DataTable();
    var trid = $(this).closest('tr').attr(' id');
    // console.log(selecte dRow);
    var id = $(this).data('id');
    var username = <?php echo json_encode($_SESSION["username"]) ?>;
    window.location = "project_add_screen.php?sid=" + id;
  });

</script>

<!-- <script src="report/assets/js/bootstrap.bundle.min.js"></script> -->
<!-- <script src="report/assets/js/jquery-3.6.0.min.js"></script> -->
<script src="report/assets/js/datatables.min.js"></script>
<script src="report/assets/js/pdfmake.min.js"></script>
<script src="report/assets/js/vfs_fonts.js"></script>

<!-- <script src="report/assets/js/custom.js"></script> -->
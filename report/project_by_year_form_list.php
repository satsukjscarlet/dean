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

.buttons-excel
 {
    margin-left: 2px;
    margin-right: 2px;
    padding: 2px;
    background-color: green;
}
.buttons-print
 {
    margin-left: 2px;
    margin-right: 2px;
    padding: 2px;
    /* background-color: green; */
}
.buttons-pdf
 {
    margin-left: 2px;
    margin-right: 2px;
    padding: 2px;
    background-color: orange;
}

</style>
<div class="container-fluid">
  <h1 class="text-center">DANH SÁCH Ý TƯỞNG THEO THỜI GIAN</h1>

  <div>
    <label>Bắt Đầu</label>
    <input type="text" name="start_date" id="start_date" class="datepicker"/>
    <label>Kết thúc</label>
    <input type="text" name="end_date" id="end_date" class="datepicker"/>
    <input type="button" name="search" id="search" value="Lọc" class="btn btn-sm btn-info" />
  </div>

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
              <th>Tên Ý Tưởng</th>
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
<!-- <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
<link rel="stylesheet" href="js/DatePicker/themes/jquery-ui.css">
<script src="js/DatePicker/jquery-ui.js"></script>
<script src="js/DatePicker/jquery.ui.datepicker-vi.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<!-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script> -->


<script type="text/javascript">

  $(document).ready(function () {
    // $( ".datepicker" ).datepicker( $.datepicker.regional[ "vi" ] );
    $('.datepicker').datepicker({
      dateFormat: "yy-mm-dd",
      autoclose: true,
      todayHighlight: true    
    },
      $.datepicker.regional['vi']
    ).datepicker("setDate",'now');

    
    // $('.input-daterange').datepicker({
    //   todayBtn: 'linked',
    //   format: "yyyy-mm-dd",
    //   autoclose: true
    // });
    fetch_data_all("no");

    function fetch_data_all(is_date_search, start_date = '', end_date = '') {
      var a = $('#example').DataTable({
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        dom: 'Blfrtip',
        buttons: [
          { extend: 'pdf', className: 'btn-succes' },
          { extend: 'excel', className: 'btn-primary' },
          { extend: 'print', className: 'btn-primary' }
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
          'url': 'report/project_by_year_fetch_data.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
          "bSortable": false,
          "aTargets": [5]
        },
        ]
      });
      
    }

    function fetch_data_search(is_date_search, start_date, end_date) {
      $('#example').DataTable({
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        dom: 'Blfrtip',
        buttons: [
          'pdf', 'excel',  'print'
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
          'url': 'report/search_project_by_year_fetch_data.php',
          'type': 'post',
          'data': {
            is_date_search: is_date_search, start_date: start_date, end_date: end_date
          }
        },
        "aoColumnDefs": [{
          "bSortable": false,
          "aTargets": [5]
        },
        ]
      });
    }

    $('#search').click(function () {
      var start_date = $('#start_date').val();
      var end_date = $('#end_date').val();
      if (start_date != '' && end_date != '' && start_date < end_date) {
        // console.log(start_date);
        // console.log(end_date);
        $('#example').DataTable().destroy();
        fetch_data_search('yes', start_date, end_date);
      }
      else {
        alert("Bạn chưa chọn thời gian hoặc thời gian kết thúc lớn hơn thời gian bắt đầu");
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
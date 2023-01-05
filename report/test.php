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
</style>
<div class="container-fluid">
  <h1 class="text-center">DANH SÁCH ĐỀ ÁN</h1>
  <div class="row">
    <div class="container">
      <div class="btnAdd">
        <a href="project_add_screen.php" class="btn btn-success btn-sm">THÊM MỚI Ý TƯỞNG</a>
      </div>
      <div class="row">
        <div class="col-md-0"></div>
        <div class="col-md-12">
          <table id="order_data" class="table">
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

  <!-- <div class = "row col-12">
    <div class="input-daterange">
      <div class="col-md-4">
        <input type="text" name="start_date" id="start_date" class="form-control" />
      </div>
      <div class="col-md-4">
        <input type="text" name="end_date" id="end_date" class="form-control" />
      </div>
    </div>
    <div class="col-md-4">
      <input type="button" name="search" id="search" value="Search" class="btn btn-info" />
    </div>
  </div>

  <div>
    <table id="order_data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Được tạo bởi</th>
          <th>Tên Đề Án</th>
          <th>Lĩnh Vực</th>
          <th>Tóm tắt ý tưởng</th>
          <th>Trạng thái</th>
          <th>Thời gian tạo</th>
        </tr>
      </thead>
    </table>
  </div> -->


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /> -->
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" language="javascript">
  $(document).ready(function () {

    $('.input-daterange').datepicker({
      todayBtn: 'linked',
      format: "yyyy-mm-dd",
      autoclose: true
    });

    fetch_data('no');

    function fetch_data(is_date_search, start_date = '', end_date = '') {
      var dataTable = $('#order_data').DataTable({
        "processing": true,
        "serverSide": true,
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
        "aLengthMenu": [[10, 20, 50], [10, 20, 50]], // danh sách số trang trên 1 lần hiển thị bảng
        "order": [],
        "ajax": {
          url: "report/project_by_year_fetch_data.php",
          type: "POST",
          data: {
            is_date_search: is_date_search, start_date: start_date, end_date: end_date
          }
        }
      });
    }

    $('#search').click(function () {
      var start_date = $('#start_date').val();
      var end_date = $('#end_date').val();
      if (start_date != '' && end_date != '') {
        $('#order_data').DataTable().destroy();
        fetch_data('yes', start_date, end_date);
      }
      else {
        alert("Both Date is Required");
      }
    });

  });
</script>
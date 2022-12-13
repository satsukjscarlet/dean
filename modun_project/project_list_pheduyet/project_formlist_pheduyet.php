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
</style>
  <div class="container-fluid">
    <h1 class="text-center">DANH SÁCH ĐỀ ÁN</h1>
    <div class="row">
      <div class="container">
      <div class="btnAdd">
          <a href="project_add_screen.php"  class="btn btn-success btn-sm" >THÊM MỚI ĐỀ ÁN</a>
        </div>
        <div class="row">
          <div class="col-md-0"></div>
          <div class="col-md-12">
            <table id="example" class="table">
              <thead>
                <th>Được tạo bởi</th>
                <th>Tên Đề Án</th>
                <th>Lĩnh Vực</th>
                <th>Ý tưởng, đề xuất</th>
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
          'url': 'modun_project/project_list_pheduyet/project_fetch_data_pheduyet.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [5]
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
      window.location = "project_add_screen.php?sid="+id;
    });
  </script>
  
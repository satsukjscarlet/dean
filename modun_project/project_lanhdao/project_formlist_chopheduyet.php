<?php require('connection.php'); ?>

<style>
  table td {
    word-break: break-word;
    vertical-align: top;
    /* white-space: normal !important;
        /* text-overflow: ellipsis; */
    min-width: 10px;
    max-width: 150px;
    padding-block: auto;

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
        <a href="project_add_screen.php" class="btn btn-success btn-sm">THÊM MỚI ĐỀ ÁN</a>
      </div>
      <div class="row">
        <div class="col-md-0"></div>
        <div class="col-md-12">
          <table id="example" class="table">
            <thead>
              <th>Mã người tạo</th>
              <th>Tên người tạo</th>
              <th>Tên Đề Án</th>
              <th>Lĩnh Vực</th>
              <th>Ý tưởng, đề xuất</th>
              <th>Trạng thái</th>
              <th>Thời gian tạo</th>
              <th>Thao tác</th>
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

  $(document).ready(function () {
    $('#example').DataTable({
      "fnCreatedRow": function (nRow, aData, iDataIndex) {
        $(nRow).attr('id', aData[0]);
      },
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
      'serverSide': 'true',
      'paging': 'true',
      'order': [],
      'ajax': {
        'url': 'modun_project/project_lanhdao/project_fetch_data_chopheduyet.php',
        'type': 'post',
      },
      "aoColumnDefs": [{
        "bSortable": false,
        "aTargets": [6]
      },
      ]
    });
  });

  $('#example').on('click', '.editbtn ', function (event) {
    var table = $('#example').DataTable();
    var trid = $(this).closest('tr').attr('id');
    var id = $(this).data('id');
    var username = <?php echo json_encode($_SESSION["username"]) ?>;
    window.location = "project_add_screen.php?sid=" + id;
  });

  $(document).on('click', '.pheduyetBtn', function (event) {
    var table = $('#example').DataTable();
    event.preventDefault();
    var id = $(this).data('id');
    if (confirm("Bạn muốn phê duyệt đề án này? ")) {

      $.ajax({
        url: "modun_project/project_lanhdao/pheduyet.php",
        data: {
          id: id
        },
        type: "post",
        beforeSend: function () {
          $('#exampleModal_loading').modal('show');
        },
        success: function (data) {
          var json = JSON.parse(data);
          status = json.status;
          setTimeout(function () {
            $('#demo-ajax').html(data);
          }, 3000);
          if (status == 'success') {
            mytable = $('#example').DataTable();
            mytable.draw();
            $('#exampleModal_loading').modal('hide');
          } else {
            $('#exampleModal_loading').modal('hide');
            mytable = $('#example').DataTable();
            mytable.draw();
            alert('Đề án đã bị chỉnh sửa, cần tải tại trang và kiểm tra lại');
            return;
          }
        }
      });
    } else {
      return null;
    }
  });

  //tu choi
  $(document).on('submit', '#cancel', function (e) {
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
        beforeSend: function () {
          $('#exampleModal_loading').modal('show');
        },
        success: function (data) {
          var json = JSON.parse(data);
          var status = json.status;
          if (status == 'success') {
            mytable = $('#example').DataTable();
            mytable.draw();
            $("input[type=text]").val("");
            $("textarea").val("");
            $('#exampleModal_loading').modal('hide');
            $('#exampleModal_tuchoi').modal('hide');
          } else {
            alert('Cập nhập lỗi');
          }
        }
      });
    } else {
      alert('Fill all the required fields');
    }
  });

  $('#example').on('click', '.tuchoiBtn ', function (event) {
    var table = $('#example').DataTable();
    // console.log(selectedRow);
    var id = $(this).data('id');
    if (confirm("Bạn muốn từ chối đề án này? ")) {
      $('#exampleModal_tuchoi').modal('show');

      $.ajax({
        url: "modun_project/project_truongbophan/item_get_single_data.php",
        data: {
          id: id
        },
        type: 'post',
        success: function (data) {
          var json = JSON.parse(data);
          $('#id').val(id);
        }
      })
    } else {
      return null;
    }
  });

  $(document).on('submit', '#info', function (e) {
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
        beforeSend: function () {
          $('#exampleModal_loading').modal('show');
        },
        success: function (data) {
          var json = JSON.parse(data);
          var status = json.status;
          if (status == 'success') {
            mytable = $('#example').DataTable();
            mytable.draw();
            $("input[type=text]").val("");
            $("textarea").val("");
            $('#exampleModal_loading').modal('hide');
            $('#exampleModal_themthongtin').modal('hide');
          } else {
            alert('Cập nhập lỗi');
          }
        }
      });
    } else {
      alert('Fill all the required fields');
    }
  });

  $('#example').on('click', '.themthongtinBtn', function (event) {
    var table = $('#example').DataTable();
    var trid = $(this).closest('tr').attr('id');
    // console.log(selectedRow);
    var id = $(this).data('id');
    if (confirm("Bạn muốn yêu cầu bổ sung thông tin đề án này? ")) {
      $('#exampleModal_themthongtin').modal('show');
      $.ajax({
        url: "modun_project/project_truongbophan/item_get_single_data.php",
        data: {
          id: id
        },
        type: 'post',
        success: function (data) {
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
        <h5 class="modal-title" id="exampleModalLabel">Từ chối đề án</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="cancel">
          <input type="hidden" name="id" id="id" value="">
          <div class="mb-3 row">
            <label for="note_cancel" class="col-md-3 form-label">Lý do từ chối</label>
            <div class="col-md-9">
              <textarea class="form-control" aria-label="With textarea" id="note_cancel" name="note_cancel"
                required=""></textarea>
            </div>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary">Xác nhận</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal_themthongtin" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Yêu cầu bổ sung thông tin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="info">
          <input type="hidden" name="id" id="id" value="">
          <div class="mb-3 row">
            <label class="col-md-3 form-label">Thông tin cần bổ sung</label>
            <div class="col-md-9">
              <textarea class="form-control" aria-label="With textarea" id="note_info" name="note_info"
                required=""></textarea>
            </div>
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-primary">Xác nhận</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
      </div>
    </div>
  </div>
</div>

<!-- loading -->
<div class="modal fade" id="exampleModal_loading" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <img id="loadingIcon" src="build/images/loading.gif" />
        <h5 class="modal-title" id="exampleModalLabel">Đang xử lý xin vui lòng đợi một chút</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    </div>
  </div>
</div>
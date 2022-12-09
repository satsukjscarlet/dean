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
    /* img#loadingIcon{
      width: 64px;
      display: none;
    } */
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
  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
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
          'url': 'modun_project/project_truongbophan/project_fetch_data_choxacnhan.php',
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
      var id = $(this).data('id');
      var username = <?php echo json_encode($_SESSION["username"]) ?>;
      window.location = "project_add_screen.php?sid="+id;
    });


    $(document).on('click', '.xacnhanBtn', function(event) {
      var table = $('#example').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      if (confirm("Bạn muốn xác nhận đề án này? ")) {

        $.ajax({
          url: "modun_project/project_truongbophan/xacnhan.php",
          data: {
            id: id
          },
          type: "post",
          beforeSend: function(){
            $('#exampleModal_xacnhan').modal('show');
          },
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;            
            if (status == 'success') {
              mytable = $('#example').DataTable();
              mytable.draw();
              $('#exampleModal_xacnhan').modal('hide');
              //table.fnDeleteRow( table.$('#' + id)[0] );
              //$("#example tbody").find(id).remove();
              //table.row($(this).closest("tr")) .remove();
              // $("#" + id).closest('tr').remove();
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


    $('#example').on('click', '.tuchoiBtn', function(event) {
      var table = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      var id = $(this).data('id');
      if(confirm("Bạn muốn từ chối đề án này? ")) 
      {
        $('#exampleModal_tuchoi').modal('show');
          $.ajax({
          url: "modun_project/project_truongbophan/tuchoi.php",
          data: {
            id: id
          },
          type: 'post',
          success: function(data) {
            var json = JSON.parse(data);
            $('#nameField').val(json.name);
            $('#noteField').val(json.note);
            $('#id').val(id);
            $('#trid').val(trid);
          }
        })
      }else 
      {
        return null;
      }    
    });

    $('#example').on('click', '.themthongtinBtn', function(event) {
      var table = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      var id = $(this).data('id');
      if (confirm("Bạn muốn yêu cầu bổ sung thông tin đề án này? ")) {
        $('#exampleModal_themthongtin').modal('show');
        $.ajax({
        url: "modun_project/project_truongbophan/themthongtin.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#nameField').val(json.name);
          $('#noteField').val(json.note);
          $('#id').val(id);
          $('#trid').val(trid);
        }
      })
      } else {
        return null;
      }    
    });
  </script>
  
   <!-- Modal -->
   <div class="modal fade" id="exampleModal_tuchoi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Từ chối đề án</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUser">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">
            <input type="hidden" name="create_at" id="create_at" value="">
            <div class="mb-3 row">
              <label for="nameField" class="col-md-3 form-label">Lý do từ chối</label>
              <div class="col-md-9">
                <textarea class="form-control" aria-label="With textarea" name = "note" required=""></textarea>
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
  <div class="modal fade" id="exampleModal_themthongtin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yêu cầu bổ sung thông tin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUser">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">
            <input type="hidden" name="create_at" id="create_at" value="">
            <div class="mb-3 row">
              <label class="col-md-3 form-label">Thông tin cần bổ sung</label>
              <div class="col-md-9">
                <textarea class="form-control" aria-label="With textarea" name = "note" required=""></textarea>
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
  <div class="modal fade" id="exampleModal_xacnhan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <img id ="loadingIcon" src = "build/images/loading.gif" />
          <h5 class="modal-title" id="exampleModalLabel">Đang xác nhận đề án xin vui lòng đợi một chút</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      </div>
    </div>
  </div>


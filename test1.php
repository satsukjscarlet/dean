<?php 
include('connection.php');

?>
<!-- <!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css"/>
  <title>PHP Mysqli Datatables Server Side CRUD Ajax (Create, Read, Update and Delete)</title>
  <style type="text/css">
    .btnAdd {
      text-align: right;
      width: 83%;
      margin-bottom: 20px;
    }
  </style>
</head> -->
<body>
<div class="container-fluid">
    <h2 class="text-center">Danh sách tài khoản</h2>
    <!-- <div class="row"> -->
      <div class="container">
        <div class="btnAdd">
         <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal"   class="btn btn-success btn-sm" >The</a>
       </div>
       <div class="row">
        <div class="col-md-0"></div>
        <div class="col-md-12">
         <table id="example" class="table" style="width:100%">
          <thead>
            <th>Id</th>
            <th>Tên tài khoản</th>
            <th>Tên hiển thị</th>
            <th>Email</th>
            <th>Options</th>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <div class="col-md-0"></div>
    <!-- </div> -->
  </div>
</div>

</div>
 
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script> -->
<script type="text/javascript" src="vendors\datatables.net\js\jquery.dataTables.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable({
        "fnCreatedRow": function( nRow, aData, iDataIndex ) {
          $(nRow).attr('id', aData[0]);
        },
        'serverSide':'true',
        'processing':'true',
        'paging':'true',
        'ajax': {
          'url':'fetch_data.php',
          'type':'post',
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
        "order": [[ 4, 'desc' ]] //sắp xếp giảm dần theo cột thứ 1
        
        "columnDefs": [{
          'target':[5],
          'orderable' :false,
        }]
      });
    } );
    // Cấu hình các nhãn phân trang
//   $('#example').dataTable( {
//       'language': {
    //   "sProcessing":   "Đang xử lý...",
    //   "sLengthMenu":   "Xem _MENU_ mục",
    //   "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
    //   "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
    //   "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
    //   "sInfoFiltered": "(được lọc từ _MAX_ mục)",
    //   "sInfoPostFix":  "",
    //   "sSearch":       "Tìm:",
    //   "sUrl":          "",
    //   "oPaginate": {
    //       "sFirst":    "Đầu",
    //       "sPrevious": "Trước",
    //       "sNext":     "Tiếp",
    //       "sLast":     "Cuối"
    //       }
    //   },
    //   "processing": true, // tiền xử lý trước
    //   "aLengthMenu": [[5, 10, 20, 50], [5, 10, 20, 50]], // danh sách số trang trên 1 lần hiển thị bảng
    //   "order": [[ 1, 'desc' ]] //sắp xếp giảm dần theo cột thứ 1
//   } );
//     $(document).on('submit','#addUser',function(e){
//       e.preventDefault();
//       var city= $('#addCityField').val();
//       var username= $('#addUserField').val();
//       var mobile= $('#addMobileField').val();
//       var email= $('#addEmailField').val();
//       if(city != '' && username != '' && mobile != '' && email != '' )
//       {
//        $.ajax({
//          url:"add_user.php",
//          type:"post",
//          data:{city:city,username:username,mobile:mobile,email:email},
//          success:function(data)
//          {
//            var json = JSON.parse(data);
//            var status = json.status;
//            if(status=='true')
//            {
//             mytable =$('#example').DataTable();
//             mytable.draw();
//             $('#addUserModal').modal('hide');
//           }
//           else
//           {
//             alert('failed');
//           }
//         }
//       });
//      }
//      else {
//       alert('Fill all the required fields');
//     }
//   });
    // $(document).on('submit','#updateUser',function(e){
    //   e.preventDefault();
    //    var city= $('#cityField').val();
    //    var username= $('#nameField').val();
    //    var mobile= $('#mobileField').val();
    //    var email= $('#emailField').val();
    //    var trid= $('#trid').val();
    //    var id= $('#id').val();
    //    if(city != '' && username != '' && mobile != '' && email != '' )
    //    {
    //      $.ajax({
    //        url:"update_user.php",
    //        type:"post",
    //        data:{city:city,username:username,mobile:mobile,email:email,id:id},
    //        success:function(data)
    //        {
    //          var json = JSON.parse(data);
    //          var status = json.status;
    //          if(status=='true')
    //          {
    //           table =$('#example').DataTable();
    //           var button =   '<td><a href="javascript:void();" data-id="' +id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' +id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
    //           var row = table.row("[id='"+trid+"']");
    //           row.row("[id='" + trid + "']").data([id,username,email,mobile,city,button]);
    //           $('#exampleModal').modal('hide');
    //         }
    //         else
    //         {
    //           alert('failed');
    //         }
    //       }
    //     });
    //    }
    //    else {
    //     alert('Fill all the required fields');
    //   }
    // });
//     $('#example').on('click','.editbtn ',function(event){
//       var table = $('#example').DataTable();
//       var trid = $(this).closest('tr').attr('id');
//      var id = $(this).data('id');
//      $('#exampleModal').modal('show');
 
//      $.ajax({
//       url:"get_single_data.php",
//       data:{id:id},
//       type:'post',
//       success:function(data)
//       {
//        var json = JSON.parse(data);
//        $('#nameField').val(json.username);
//        $('#emailField').val(json.email);
//        $('#mobileField').val(json.mobile);
//        $('#cityField').val(json.city);
//        $('#id').val(id);
//        $('#trid').val(trid);
//      }
//    })
//    });
 
    // $(document).on('click','.deleteBtn',function(event){
    //    var table = $('#example').DataTable();
    //   event.preventDefault();
    //   var id = $(this).data('id');
    //   if(confirm("Are you sure want to delete this User ? "))
    //   {
    //   $.ajax({
    //     url:"delete_user.php",
    //     data:{id:id},
    //     type:"post",
    //     success:function(data)
    //     {
    //       var json = JSON.parse(data);
    //       status = json.status;
    //       if(status=='success')
    //       {
    //          $("#"+id).closest('tr').remove();
    //       }
    //       else
    //       {
    //         alert('Failed');
    //         return;
    //       }
    //     }
    //   });
    //   }
    //   else
    //   {
    //     return null;
    //   }
    // })
 </script>
</body>
</html>
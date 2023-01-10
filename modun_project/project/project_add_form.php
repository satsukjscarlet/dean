<script src="js/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
</script>
<?php
require('connection.php');
$username = $_SESSION["username"];
$display_name = $_SESSION["display_name"];
$leve = $_SESSION["level"];
$email = $_SESSION["email"];
$user_id = $_SESSION["user_id"];
?>
<div class="container">
  <h2>TẠO Ý TƯỞNG</h2>
  <form action="" id="add_item" method="post">

    <div class="form-group">
      <label>Tên Ý Tưởng:</label>
      <input type="text" name="name" id="name" class="form-control" placeholder="Bạn cần nhập thông tin" required="" />
    </div>

    <div class="form-group">
      <label>Lĩnh Vực:</label>
      <br />
      <select class="custom-select" name="field" id="field" required="">
        <option value="">Chọn lĩnh vực</option>
        <?php
        $sql = "select *from category ORDER BY name ASC";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
            ?>

            <option value="<?php echo $row["id"] ?>">
              <?php echo $row["name"] ?>
            </option>

            <?php
          }
        }
        ?>
      </select>
    </div>

    <div class="form-group">
      <label>Ý Tưởng được tạo bởi:</label>
      <br />
      <select class="custom-select" name="employee" value='<?php echo $user_id; ?>'>
        <option selected value="<?php echo $user_id; ?>">
          <?php echo $display_name ?>
        </option>
        <option value="cancel">Cho người khác</option>
      </select>
    </div>

    <div class="form-group">
      <label>Thực trạng hiện nay:</label>
      <textarea class="form-control" aria-label="With textarea" name="base" required=""></textarea>
    </div>

    <div class="form-group">
      <label>Tóm tắt ý tưởng:</label>
      <textarea class="form-control" aria-label="With textarea" name="issue" required=""></textarea>
    </div>

    <!-- <div class="form-group">
      <label>Nhân viên tham gia:</label>
      <div class="field_wrapper">
            <div>
            <input type="text" name="field_name[]" value="" placeholder="Bạn cần nhập mã nhân viên" required=""/>
            <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div> -->

    <input type="submit" class="btn btn-block btn-info" value="KHỞI TẠO" />
  </form>
</div>


<script type="text/javascript">

  $('#add_item').submit(function (event) {
    event.preventDefault();
    $.ajax({
      type: "POST",
      url: 'modun_project/project/project_add_handle.php',
      data: $(this).serializeArray(),
      beforeSend: function () {
        $('#exampleModal_loading').modal('show');
      },
      complete: function () {
        $('#exampleModal_loading').modal('hide');
      },
        success: function (response) {
        response = JSON.parse(response);
        console.log(response.status);
        if (response.status == 0) {
          
          alert(response.message);
        } else {
          window.location.href = response.url;
        }
      }
    })
  });

</script>

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
<script src="js/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
</script>
<?php 
require('connection.php');
$username = $_SESSION["username"];
$display_name = $_SESSION["display_name"];
$leve = $_SESSION["level"];
$email = $_SESSION["email"];
$username_id = $_SESSION["username_id"];
?>
<div class="container">
  <h2>TẠO ĐỀ ÁN, Ý TƯỞNG</h2>
  <form action = "modun_project/project/project_add_handle.php" method = "post">

    <div class="form-group">
      <label>Tên Đề Án:</label>
      <input type="text" name = "name" class="form-control" placeholder="Bạn cần nhập thông tin" required="" />
    </div>

    <div class="form-group">
        <label>Lĩnh Vực:</label>
        <br/>
        <select class="custom-select" name="field" required="">
            <option value = "">Chọn lĩnh vực</option>
            <?php
            $sql = "select *from category";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) 
            {
              while($row = mysqli_fetch_array($result)){
                ?>

              <option value="<?php echo $row["id"] ?>"><?php echo $row["name"] ?></option>

                <?php
              }
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label>Đề án được tạo bởi:</label>
        <br/>
        <select class="custom-select" name="employee" value = '<?php echo $username_id; ?>'>
            <option selected value="<?php echo $username_id; ?>"><?php echo $display_name ?></option>
            <option value="cancel">Cho người khác</option>
        </select>
    </div>
    
    <div class="form-group">
      <label>Cơ sở thực trạng:</label>
      <textarea class="form-control" aria-label="With textarea" name = "base" required=""></textarea>
    </div>

    <div class="form-group">
      <label>Ý tưởng, đề xuất:</label>
      <textarea class="form-control" aria-label="With textarea" name = "issue" required=""></textarea>
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

    <input type ="submit" class = "btn btn-block btn-info" value="KHỞI TẠO" />
  </form>
</div>





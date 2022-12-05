<script src="js/jquery-3.6.0.min.js"></script>
<!-- <script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = 
    '<div><input type="text" required="" placeholder="Bạn cần nhập mã nhân viên" name="field_name[]" value=""/> <a href="javascript:void(0);" class="remove_button"><i class="fa fa-minus style:"></i></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script> -->
<?php 
require('connection.php');
$username = $_SESSION["username"];
$display_name = $_SESSION["display_name"];
$leve = $_SESSION["level"];
$email = $_SESSION["email"];
?>
<div class="container">
  <h2>TẠO ĐỀ ÁN, Ý TƯỞNG</h2>
  <form action = "form/addproject_handle.php" method = "post">

    <div class="form-group">
      <label>Tên Đề Án:</label>
      <input type="text" name = "name" class="form-control" placeholder="Bạn cần nhập thông tin" required="" />
    </div>

    <div class="form-group">
        <label>Lĩnh Vực:</label>
        <br/>
        <select class="custom-select" name="status">
            <!-- <option value = "">Chọn lĩnh vực</option> -->
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

    <!-- <div class="form-group">
        <label>Trạng thái:</label>
        <br/>
        <select class="custom-select" name="status" value = 'Khởi Tạo' disabled>
            <option selected value="Khởi Tạo">Khởi Tạo</option>
            <option value="Chấp Thuận">Chấp Thuận</option>
            <option value="Từ Chối">Từ Chối</option>
        </select>
    </div> -->
    
    <div class="form-group">
      <label>Cơ sở thực trạng:</label>
      <textarea class="form-control" aria-label="With textarea" name = "base"></textarea>
    </div>

    <div class="form-group">
      <label>Ý tưởng, đề xuất:</label>
      <textarea class="form-control" aria-label="With textarea" name = "issue"></textarea>
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





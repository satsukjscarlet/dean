<script src="js/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
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
</script>
<?php 
$username = $_SESSION["username"];
$display_name = $_SESSION["display_name"];
$leve = $_SESSION["level"];
$email = $_SESSION["email"];
?>
<div class="container">
  <h2>TẠO ĐỀ ÁN, Ý TƯỞNG</h2>
  <form action = "form/addproject_handle.php" method = "post">

    <div class="form-group">
      <label>Được tạo bởi:</label>
      <input type="text" name = "create_by" class="form-control" placeholder="Username" <?php echo 'value = "'.$username.'"' ?> disabled/>
    </div>

    <div class="form-group">
      <label>Tên Đề Án:</label>
      <input type="text" name = "name" class="form-control" placeholder="Bạn cần nhập thông tin" required="" />
    </div>

    <div class="form-group">
        <label>Loại đề án:</label>
        <br/>
        <select class="custom-select" id="type" name="type" value = 'Ý Tưởng'>
        <option selected value="Ý Tưởng">Ý Tưởng</option>
            <option value="Cải Tiến">Cải Tiến</option>
            <option value="Sáng Kiến">Sáng Kiến</option>
            <option value="Đề Tài">Đề Tài</option>
        </select>
    </div>

    <div class="form-group">
        <label>Trạng thái:</label>
        <br/>
        <select class="custom-select" name="status" value = 'Khởi Tạo' disabled>
            <option selected value="Khởi Tạo">Khởi Tạo</option>
            <option value="Chấp Thuận">Chấp Thuận</option>
            <option value="Từ Chối">Từ Chối</option>
        </select>
    </div>
    
    <div class="form-group">
      <label>Cơ sở thực hiện:</label>
      <textarea class="form-control" aria-label="With textarea" name = "base"></textarea>
    </div>

    <div class="form-group">
      <label>Vấn đề còn tồn tại khi chưa áp dụng ý tưởng/cải tiến/Sáng Kiến/đề tài:</label>
      <textarea class="form-control" aria-label="With textarea" name = "issue"></textarea>
    </div>

    <div class="form-group">
      <label>Ghi chú:</label>
      <textarea class="form-control" aria-label="With textarea" name = "note"></textarea>
    </div>
    
    <div class="form-group">
      <label>Nhân viên tham gia:</label>
      <div class="field_wrapper">
            <div>
            <input type="text" name="field_name[]" value="" placeholder="Bạn cần nhập mã nhân viên" required=""/>
            <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>

    <input type ="submit" class = "btn btn-block btn-info" value="KHỞI TẠO" />
  </form>
</div>





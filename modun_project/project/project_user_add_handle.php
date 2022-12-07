<?php
include('../../connection.php');
$str = $_GET["sid"];
$employee_id = explode(",", $str)[0];
$item_id = explode(",", $str)[1];
echo $item_id;
echo $employee_id;

date_default_timezone_set("Asia/Ho_Chi_Minh");
$create_at = date("Y-m-d H:i:s");

$sql = "INSERT INTO user_item(employee_id, item_id, create_at) 
VALUES ('$employee_id','$item_id','$create_at')";

if(mysqli_query($con,$sql)){ 

    echo 'Thêm nhân viên vào đề án thành công';
    $url = "Location: http://localhost/dean/project_add_screen.php?sid=".$item_id;
    header($url);
    }
    else{
        $url = "http://localhost/dean/project_add_screen.php?sid=".$item_id;
        echo 'Thêm nhân viên thất bại';
        echo '<br/>';
        echo '<a class="login" href="'.$url.'">Trở lại đề án</a>';
    }
  

$con -> close();

?>
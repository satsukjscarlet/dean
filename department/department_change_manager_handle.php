<?php
include('../connection.php');

session_start();
$str = $_GET["sid"];
$employee_id = explode(",", $str)[0];
$id_department = explode(",", $str)[1];

// Lấy thông tin nhân viên được thêm
$sql_user = "SELECT * FROM users WHERE id='$employee_id' LIMIT 1";
$query_user = mysqli_query($con,$sql_user);
$row_user = mysqli_fetch_assoc($query_user);
$user_block = $row_user['block'];
$user_department = $row_user['department'];
$user_email = $row_user['email'];

$sql_update_user = "UPDATE users set level = 3 where id = $employee_id";
mysqli_query($con, $sql_update_user);

$sql = "UPDATE `department` SET manager = '$employee_id', email_manager = '$user_email' WHERE id = '$id_department'";

if(mysqli_query($con,$sql)){ 
    
    echo 'Thêm lãnh đạo thành công';
    $url = "Location: http://localhost/dean/department_add_screen.php?sid=".$id_department;
    header($url);
    }
    else{
        $url = "http://localhost/dean/department_add_screen.php?sid=".$id_department;
        echo 'Thêm lãnh đạo thất bại';
        echo '<br/>';
        echo '<a class="login" href="'.$url.'">Trở lại Phòng ban</a>';
    }
  

$con -> close();

?>
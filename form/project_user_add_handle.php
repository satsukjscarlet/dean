<?php
include('../connection.php');
$str = $_GET["sid"];
$employee_id = explode(",", $str)[0];
$item_id = explode(",", $str)[1];
echo $item_id;
echo $employee_id;
//lấy name item
$sql = "SELECT * FROM item WHERE id='$item_id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
$name = $row['name'];
//lấy employeeNumber user
$sql3 = "SELECT * FROM users WHERE id='$employee_id' LIMIT 1";
$query3 = mysqli_query($con,$sql3);
$row3 = mysqli_fetch_assoc($query3);
$employeeNumber = $row3['employeeNumber'];

date_default_timezone_set("Asia/Ho_Chi_Minh");
$create_at = date("Y-m-d H:i:s");

$sql2 = "INSERT INTO user_item(employeeNumber, item_name, create_at) 
VALUES ('$employeeNumber','$name','$create_at')";
echo $sql2;
if(mysqli_query($con,$sql2)){ 
    header("Location: http://10.2.2.11/dean/index.php");
    }
    else{
        echo 'Thêm nhân viên thất bại';
        echo '<a class="login" href="http://10.2.2.11/dean/index.php">Trở lại trang chủ</a>';
    }
$con -> close();

?>
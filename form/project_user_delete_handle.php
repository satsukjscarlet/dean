<?php
include('../connection.php');
$str = $_GET["item_id"];
$item_id = explode(",", $str)[0];
$employeeNumber = explode(",", $str)[1];
echo $item_id;
echo $employeeNumber;
$sql = "SELECT * FROM item WHERE id='$item_id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
$name = $row['name'];

$sql2 = "DELETE FROM user_item WHERE item_name='$name' And employeeNumber = '$employeeNumber' LIMIT 1";
if(mysqli_query($con,$sql2)){ 
    $url = "Location: http://localhost/dean/project_add.php?sid=".$item_id;
    header($url);
    }
    else{
        echo 'Xóa nhân viên thất bại';
    }
    $connect -> close();
// $row2 = mysqli_fetch_assoc($query2);
?>
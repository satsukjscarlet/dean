<?php
$connect = mysqli_connect("localhost", "root", "", "dean");
session_start();

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit(); 
  }
 var_dump($_POST);
if(isset($_POST["name"])){
    $create_by = $_SESSION["username"];
    $type = $_POST["type"];
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $base = mysqli_real_escape_string($connect, $_POST['base']);
    $issue = mysqli_real_escape_string($connect, $_POST['issue']);
    $status = 'Khởi Tạo';
    $note = mysqli_real_escape_string($connect, $_POST['note']);
    $field_values_array = $_POST['field_name'];
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $create_at = date("Y-m-d H:i:s");
    $query = "INSERT INTO item(create_by, type, 
    name, base, issue, status, note, create_at) 
    VALUES ('$create_by','$type', '$name',
    '$base','$issue','$status','$note','$create_at')";
    if(mysqli_query($connect,$query)){   
         foreach($field_values_array as $value){
           $query1 = "INSERT INTO user_item(employeeNumber, 
           item_name, create_at) 
           VALUES ('$value','$name','$create_at')";
           mysqli_query($connect,$query1);
        }
    header("Location: http://localhost/dean/index.php");
    }
    else{
        echo 'Thêm Đề Án thất bại';
    }
    $connect -> close();
}

?>
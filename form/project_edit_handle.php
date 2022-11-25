<?php
$connect = mysqli_connect("localhost", "root", "", "dean");
session_start();

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit(); 
  }
 var_dump($_POST);
if(isset($_POST["name"])){
    $id = $_POST["id"];
    $create_by = $_POST["create_by"];
    $type = $_POST["type"];
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $base = mysqli_real_escape_string($connect, $_POST['base']);
    $issue = mysqli_real_escape_string($connect, $_POST['issue']);
    if(isset($_POST["status"]))
    {
    $status = $_POST["status"];
    }else{
        $status = "Khởi Tạo";
    }
    $note = mysqli_real_escape_string($connect, $_POST['note']);
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $update_at = date("Y-m-d H:i:s");
    $query = "UPDATE item SET create_by='$create_by',type='$type',name='$name',base='$base',issue='$issue',status='$status',
    note='$note', update_at='$update_at' WHERE id = '$id'";
    if(mysqli_query($connect,$query)){ 
    header("Location: http://localhost/dean/index.php");
    }
    else{
        echo 'Cập nhập Đề Án thất bại';
    }
    $connect -> close();
}

?>
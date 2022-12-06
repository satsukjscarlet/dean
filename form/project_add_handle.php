<?php
require 'send_email.php';
include('../connection.php');
session_start();

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit(); 
  }
 var_dump($_POST);
if(isset($_POST["name"])){
    //Lấy dữ liệu từ session
    $email = $_SESSION["email"];
    $create_by = strtoupper($_SESSION["username"]);
    $jobTitle = $_SESSION["jobTitle"];
    $department = $_SESSION["department"];
    $block = $_SESSION["block"];
    $display_name = $_SESSION["display_name"];


    $type = $_POST["type"];
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $base = mysqli_real_escape_string($con, $_POST['base']);
    $issue = mysqli_real_escape_string($con, $_POST['issue']);
    $status = 'Khởi Tạo';
    $note = mysqli_real_escape_string($con, $_POST['note']);
    // $field_values_array = $_POST['field_name'];
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $create_at = date("Y-m-d H:i:s");
    $department_approve = 0;
    $query = "INSERT INTO item(create_by, display_name, block, department, jobTitle, department_approve, type, 
    name, base, issue, status, note, create_at) 
    VALUES ('$create_by',
    '$display_name','$block','$department','$jobTitle', '$department_approve',
    '$type', '$name',
    '$base','$issue',
    '$status','$note','
    $create_at')";
    $employee = "";
    if(mysqli_query($con,$query)){
        //Thêm nhân viên vào chuỗi
        //  foreach($field_values_array as $value){
        //    $employee = $employee."  ".$value;
        // }
        //Thêm nhân viên vào danh sách tham gia
        $query1 = "INSERT INTO user_item(employeeNumber, 
        item_name, create_at) 
        VALUES ('$create_by','$name','$create_at')";
        mysqli_query($con,$query1);

        //mail
        
        $sql3 = "SELECT * FROM item WHERE name='$name' LIMIT 1";
        $query3 = mysqli_query($con,$sql3);
        $row3 = mysqli_fetch_assoc($query3);
        $item_id = $row3['id'];
        
        $noidungthu = file_get_contents("mail_temp_addproject.txt");
        $noidungthu = str_replace(
            [ '{create_by}', '{tieu_de}','{type}','{base}','{issue}','{note}','{employee}','{thoigiankt}'],
            ["$create_by", "$name", "$type", 
            "$base",
            "$issue",
            "$note",                 
            "$create_by",
            "$create_at"],
            $noidungthu);


        GuiMail($email, $create_by, $noidungthu, "");
        // echo $email;
        if(mysqli_query($con,$sql3)){
        $url = "Location: http://localhost/dean/project_add.php?sid=".$item_id;
        header("$url");
        }else{
            header("Location: http://localhost/dean/index.php");
        }
    }
    else{
        echo $query;
        echo 'Thêm Đề Án thất bại';
        echo '<a class="login" href="http://localhost/dean/index.php">Trở lại trang chủ</a>';
    }
    $con -> close();
}

?>
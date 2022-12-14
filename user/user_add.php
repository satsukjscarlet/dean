<?php
include('../connection.php');
session_start();

//  var_dump($_POST);
if(isset($_POST["employeeNumber"])){
    $employeeNumber = mysqli_real_escape_string($con, $_POST['employeeNumber']);
    $username = mysqli_real_escape_string($con, $_POST['employeeNumber']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $display_name = mysqli_real_escape_string($con, $_POST['display_name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $level = $_POST['level'];
    $jobTitle = $_POST['jobTitle'];
    $department = $_POST['department'];
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $create_at = date("Y-m-d H:i:s");

    //Thêm khối
    if($department == 'NMPE' || $department == 'NMPVC'|| $department == 'NMPT1'|| $department == 'NMPT2' || $department == 'CNCL'){
        $block = "SX";
    }elseif($department == 'NCPT'|| $department == 'NMCK'){
        $block = "KT";
    }elseif($department == 'VPCT'|| $department == 'NSCL'){
        $block = "NC";
    }elseif($department == 'MKT'|| $department == 'PTTT1'|| $department == 'PTTT2'|| $department == 'DVKH'|| $department == 'VT'){
        $block = "KD";
    }else
    {
        $block = "TC";
    }

    $query = "INSERT INTO users (level, username, display_name, 
    password_hash, email, employeeNumber, jobTitle, 
    department, create_at, block) 
    VALUES ('$level', '$employeeNumber','$display_name',
    '$password', '$email', '$employeeNumber', '$jobTitle', '$department', '$create_at', '$block')";
    if(mysqli_query($con,$query)){
    header("Location: http://localhost/dean/user_list_screen.php");
    }
    else{
        echo 'Thêm thành viên thất bại';
        echo '<a class="login" href="http://localhost/dean/index.php">Trở lại trang chủ</a>';
    }
    $con -> close();
}
?>
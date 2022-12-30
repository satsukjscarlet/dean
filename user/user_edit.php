<?php
include('../connection.php');
session_start();

//  var_dump($_POST);
if(isset($_POST["employeeNumber"])){
    $id =$_POST['id'];


    $sql3 = "SELECT * FROM users WHERE id='$id' LIMIT 1";
    $query3 = mysqli_query($con,$sql3);
    $row3 = mysqli_fetch_assoc($query3);
    $employeeNumber_old = $row3['employeeNumber'];
    
    $employeeNumber = mysqli_real_escape_string($con, $_POST['employeeNumber']);
    $username = mysqli_real_escape_string($con, $_POST['employeeNumber']);
    $display_name = mysqli_real_escape_string($con, $_POST['display_name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $level = $_POST['level'];
    $jobTitle = $_POST['jobTitle'];
    $department = $_POST['department'];
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $update_at = date("Y-m-d H:i:s");
    $block = $_POST['block'];
    //Thêm khối
    // if($department == 'NMPE' || $department == 'NMPVC'|| $department == 'NMPT1'|| $department == 'NMPT2'){
    //     $block = "SX";
    // }elseif($department == 'NCPT'|| $department == 'NMCK'){
    //     $block = "KT";
    // }elseif($department == 'VPCT'|| $department == 'NSCL'){
    //     $block = "NC";
    // }elseif($department == 'MKT'|| $department == 'PTTT1'|| $department == 'PTTT2'|| $department == 'DVKH'|| $department == 'VT'){
    //     $block = "KD";
    // }else
    // {
    //     $block = "TC";
    // }

    if($_POST['password'] != ""){
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query = "UPDATE users SET level='$level',username='$username',password_hash='$password',display_name='$display_name', 
        email='$email',employeeNumber='$employeeNumber',jobTitle='$jobTitle',department='$department', block = '$block',
        update_at='$update_at' WHERE id = $id";
    }else{
        $query = "UPDATE users SET level='$level',username='$username',display_name='$display_name', 
        email='$email',employeeNumber='$employeeNumber',jobTitle='$jobTitle',department='$department',block = '$block',
        update_at='$update_at' WHERE id = $id";
    }

    if(mysqli_query($con,$query)){

        $query5 = "UPDATE user_item SET employeeNumber='$employeeNumber' WHERE employeeNumber = '$employeeNumber_old'";
        mysqli_query($con,$query5);
        

    header("Location: http://localhost/dean/user_list_screen.php");
    }
    else{
        echo 'Thêm thành viên thất bại';
        echo $query;
        echo '<a class="login" href="http://localhost/dean/index.php">Trở lại trang chủ</a>';
    }
    $con -> close();
}

?>
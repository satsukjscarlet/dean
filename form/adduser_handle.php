<?php
$connect = mysqli_connect("localhost", "root", "", "dean");
session_start();

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }
//  var_dump($_POST);
if(isset($_POST["employeeNumber"])){
    $employeeNumber = mysqli_real_escape_string($connect, $_POST['employeeNumber']);
    $username = mysqli_real_escape_string($connect, $_POST['employeeNumber']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $display_name = mysqli_real_escape_string($connect, $_POST['display_name']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $level = $_POST['level'];
    $jobTitle = $_POST['jobTitle'];
    $department = $_POST['department'];
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $create_at = date("Y-m-d H:i:s");
    // $create_at->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
    $query = "INSERT INTO users (level, username, display_name, 
    password_hash, email, employeeNumber, jobTitle, 
    department, create_at) 
    VALUES ('$level', '$employeeNumber','$display_name',
    '$password', '$email', '$employeeNumber', '$jobTitle', '$department', '$create_at')";
    if(mysqli_query($connect,$query)){
    header("Location: http://10.2.2.11/dean/index.php");
    }
    else{
        echo 'Thêm thành viên thất bại';
    }
    $connect -> close();
}
//  echo $username = $_POST['username'];
//  echo $password = $_POST['password'];
//  $str = md5($password);
//  $hashed_password = password_hash($str, PASSWORD_DEFAULT);
//  echo $hashed_password;
//  $connuser = new mysqli('10.2.2.11', 'root', '', 'datxe');

//  $sql = "Select *from mrbs_users where username = $username";
//  $result = $connuser->query($sql)->fetch_assoc();
// //  if($result['password'] == $password){
// if(password_verify($password, $hashed_password)) {
//     echo 'Đăng nhập thành công';
//  }
//  else{
//     echo 'Đăng nhập sai thông tin';
//  }


//  $connuser->close();
?>
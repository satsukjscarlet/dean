<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "dean");


if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
//  var_dump($_POST);
if(isset($_POST['username'])){   
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = $_POST['password'];
  
    $query = "SELECT *FROM users WHERE username = '$username'";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        if(password_verify($password, $row["password_hash"]))
            {
                $_SESSION["username"] = $username;
                $_SESSION["level"] = $row["level"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["display_name"] = $row["display_name"];
                header("Location: http://localhost/dean/index.php");
            } else {
                echo '<script>alert("Bạn nhập sai mật khẩu")</script>';
                echo 'Bạn nhập sai mật khẩu, Bạn cần đăng nhập lại ';
                echo '<a class="login" href="http://localhost/dean/login.php">Trở lại đăng nhập</a>';
            }
    }
    else{
        echo '<script>alert("Bạn nhập sai thông tin tài khoản")</script>';
        echo 'Bạn nhập sai thông tin tài khoản, Bạn cần đăng nhập lại ';
        echo '<a class="login" href="http://localhost/dean/login.php">Trở lại đăng nhập</a>';
    }
}else{
    header("Location: http://localhost/dean/login.php");
}

























//  $field_values_array = $_POST['field_name'];
// $str = join(",",$field_values_array);
// echo $str;
//  foreach($field_values_array as $value){
//    $str = $str.$value.",";
// }
//  echo $str;
//  echo $username = $_POST['username'];
//  echo $password = $_POST['password'];
//  $str = md5($password);
//  $hashed_password = password_hash($str, PASSWORD_DEFAULT);
//  echo $hashed_password;
//  $connuser = new mysqli('localhost', 'root', '', 'datxe');

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
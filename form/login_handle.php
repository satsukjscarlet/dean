<?php
include('../connection.php');
session_start();


if (mysqli_connect_errno()) {
    echo "Failed to con to MySQL: " . mysqli_connect_error();
    exit();
}
//  var_dump($_POST);
if(isset($_POST['username'])){   
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = $_POST['password'];
  
    $query = "SELECT *FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        if(password_verify($password, $row["password_hash"]))
            {
                $_SESSION["username"] = $username;
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["level"] = $row["level"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["display_name"] = $row["display_name"];
                $_SESSION["jobTitle"] = $row["jobTitle"];
                $_SESSION["department"] = $row["department"];
                $_SESSION["block"] = $row["block"];
                header("Location: http://localhost/dean/index.php");
            } else {
                echo '<script>alert("Bạn nhập sai mật khẩu")</script>';
                echo 'Bạn nhập sai mật khẩu, Bạn cần đăng nhập lại ';
                echo '<a class="login" href="http://localhost/dean/login.php">Trở lại đăng nhập</a>';
                header("Location: http://localhost/dean/login.php");
            }
    }
    else{
        echo '<script>alert("Bạn nhập sai thông tin tài khoản")</script>';
        echo 'Bạn nhập sai thông tin tài khoản, Bạn cần đăng nhập lại ';
        echo '<a class="login" href="http://localhost/dean/login.php">Trở lại đăng nhập</a>';
        header("Location: http://localhost/dean/login.php");
    }
}else{
    header("Location: http://localhost/dean/login.php");
}

?>
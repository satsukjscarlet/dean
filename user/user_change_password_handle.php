<?php
include('../connection.php');
session_start();


if (isset($_POST['password'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT *FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        if (password_verify($password, $row["password_hash"])) {
           $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
           $query_change_password = "UPDATE users set password_hash = '$new_password' where username = '$username'";
           if(mysqli_query($con, $query_change_password)){
            echo json_encode(
                array(
                    'status' => 1,
                    'message' => 'Đổi mật khẩu thành công'
                )       
            );
            session_destroy();
           }else{
            echo json_encode(
                array(
                    'status' => 0,
                    'message' => 'Có lỗi xảy ra, đổi mật khẩu thất bại 1'
                )       
            );
           }    
        } else {
            // echo '<script>alert("Bạn nhập sai mật khẩu")</script>';
            // echo 'Bạn nhập sai mật khẩu, Bạn cần đăng nhập lại ';
            // echo '<a class="login" href="http://localhost/dean/login.php">Trở lại đăng nhập</a>';
            // header("Location: http://localhost/dean/login.php");
            echo json_encode(
                array(
                    'status' => 0,
                    'message' => 'Mật khẩu cũ chưa đúng'
                )
            );
        }
    } else {
        echo json_encode(
            array(
                'status' => 0,
                'message' => 'Bạn nhập sai thông tin tài khoản'
            )
        );
    }
} else {
    echo json_encode(
        array(
            'status' => 0,
            'message' => 'Có lỗi xảy ra, đổi mật khẩu thất bại'
        )
    );
}

?>
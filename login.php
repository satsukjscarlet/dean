<?php
session_start();
session_destroy();
if(isset($_SESSION["username"]))
{
    header("location:http://localhost/dean/index.php");
}
?>


<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Đăng nhập</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">
    
    <H1 class="text-center">CÔNG TY CỔ PHẦN NHỰA THIẾU NIÊN TIỀN PHONG</H1>
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
         
            <form action = "form/login_handle.php" method = "post">
              <h1>ĐĂNG NHẬP</h1>
              <div>
                <input type="text" name = "username" class="form-control" placeholder="Tài Khoản" required="" />
              </div>
              <div>
                <input type="password" name = "password" class="form-control" placeholder="Mật Khẩu" required="" />
              </div>
              <div style ="padding-right: 180px;">
                <input type ="submit" class = "btn btn-block btn-info" value="Đăng nhập" />
              </div>  
              <div>
                <a class="reset_pass" href="#">Quên mật khẩu?</a>
              </div>
              <div class="clearfix"></div>
              <br/>
              <div class="separator">
                <!-- <p class="change_link">Bạn chưa có tài khoản?
                  <a href="#signup" class="to_register"> Tạo tài khoản </a>
                </p> -->              
                  <h1> HỆ THỐNG QUẢN LÝ ĐỀ ÁN</h1>
                 
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>

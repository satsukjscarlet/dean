<?php
session_start();
if(!isset($_SESSION["username"]))
{
    header("location: http://localhost/dean/login.php");  
}
$display_name = $_SESSION["display_name"];
$level = $_SESSION["level"];
?>

<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <!-- <link rel="icon" href="images/favicon.ico" type="image/ico" /> -->

    <title>QUẢN LÝ ĐỀ ÁN</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <!-- <link href="vendors/nprogress/nprogress.css" rel="stylesheet"> -->
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> -->
  <link rel="stylesheet" type="text/css" href="build/css/jquery.databases.min.css"/>
  <script src="js/jquery-3.6.0.min.js"></script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title">
                <span>QUẢN LÝ ĐỀ ÁN</span>
                <!-- <img class="img-fluid" src="https://dichvuvpct.nhuatienphong.vn/image/logo2.png" alt="logo"> -->
              </a>
            </div>

            <div class="clearfix"></div>          
            <br />
            <img class="img-fluid  ounded mx-auto d-block" src="https://dichvuvpct.nhuatienphong.vn/image/logo2.png" alt="logo" width="200" height="200" > 
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
             
                <ul class="nav side-menu">
                <li><a href="project_add.php"><i class="fa fa-pencil-square-o"></i> TẠO MỚI ĐỀ ÁN </a>
                  <li><a><i class="fa fa-home"></i> DANH SÁCH ĐỀ ÁN <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="project_list.php">Danh sách đề án</a></li>
                      <li><a href="project_list_chapthuan.php">Đề án đã được duyệt</a></li>
                      <li><a href="project_list_khoitao.php">Đề án đang chờ duyệt</a></li>
                      <li><a href="project_list_tuchoi.php">Đề án không được duyệt</a></li>
                    </ul>
                  </li>
                 
                  <li <?php 
                  if($level == 1){
                    echo "hidden";
                  } 
                  ?>>
                  
                  
                  <a><i class="fa fa-desktop"></i> QUẢN LÝ TÀI KHOẢN <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="user_list.php">Danh sách tài khoản</a></li>
                      <!-- <li><a href="general_elements.html">Tài khoản</a></li> -->
                      <li><a href="#">Đổi mật khẩu</a></li>
                    </ul>
                 
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <!-- <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a> -->
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
                <!-- Khung menu nhỏ -->
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
                <!-- Khung menu nhỏ -->

              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                <img class="img-fluid" src="https://dichvuvpct.nhuatienphong.vn/image/logo2.png" alt="logo" width="50" height="50"  />
                  <a><?php echo $display_name; ?></a>
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <!-- <a class="dropdown-item"  href="javascript:;"> Profile</a> -->
                      <!-- <a class="dropdown-item"  href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a> -->
                  <!-- <a class="dropdown-item"  href="javascript:;">Help</a> -->
                    <a class="dropdown-item"  href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </div>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
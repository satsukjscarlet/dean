<?php
require 'send_email_add.php';
include('../../connection.php');
session_start();

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit(); 
  }
 var_dump($_POST);

if(isset($_POST["name"])){
    //Lay du lieu dean
    $create_by = strtoupper($_SESSION["username"]);
    $email = $_SESSION["email"];
    $display_name = $_SESSION["display_name"];
    $block = "";
    $department = "";
    $type = "Ý Tưởng";
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $field = $_POST["field"];
    $base = mysqli_real_escape_string($con, $_POST['base']);
    $issue = mysqli_real_escape_string($con, $_POST['issue']);
    $status = 'Khởi Tạo';
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $create_at = date("Y-m-d H:i:s");
    $emailcc = array();     

    $query = "INSERT INTO item(create_by,display_name, block, department, type, name, 
    base, issue, status, create_at, field) 
    VALUES ('$create_by','$display_name', '$block', '$department','$type',
    '$name','$base','$issue','$status', '$create_at', '$field')";
    if (mysqli_query($con, $query)) {
        $lastId = mysqli_insert_id($con);
        echo 'Thêm Đề Án Thành Công';
        echo $lastId;
         //Neu nhap cho ban than
        if($_POST["employee"] != "cancel"){
            $department = $_SESSION["department"];
            $block = $_SESSION["block"];
            $employeeId = $_POST["employee"];
            
            //Cap nhap phong ban va khoi
            $sqlupdate = "Update item set department = '$department', block = '$block' where id = $lastId";
            if(mysqli_query($con, $sqlupdate)){
                echo 'Cập nhập block và department thành công';
            }else{
                echo 'Cập nhập block và department thất bại';
            }
            //Thêm nhân viên vào danh sách tham gia
            $query_insert_user_item = "INSERT INTO user_item(employee_id, 
            item_id, create_at) 
            VALUES ('$employeeId','$lastId','$create_at')";
            if(mysqli_query($con, $query_insert_user_item)){
                echo 'Cập nhập nhân viên vào đề án thành công';
            }else{
                echo 'Cập nhập nhân viên vào đề án thất bại';
            }          
        }   

        //Gui email tao moi dean         
        $all_display_name = array();    
        $all_department_new = array();
        $all_block_new = array();   
        //Lay danh sach nhan vien tham gia de an
        $sql_item_id = "select *from user_item where item_id = '$lastId'";
        $result_itemid = mysqli_query($con, $sql_item_id);
        if (mysqli_num_rows($result_itemid) > 0) 
        {
          while($row_user_item = mysqli_fetch_array($result_itemid))
          {
            $id_employee = $row_user_item['employee_id'];
            echo "Đây là số nhân viên".$row_user_item['employee_id'];
            //Lấy thông tin nhân viên tham gia
            $sql_checkinfo = "select *from users where id = '$id_employee' LIMIT 1";
            $result_user_info = mysqli_query($con, $sql_checkinfo);
            if (mysqli_num_rows($result_user_info) > 0)
            {
                while($row_user_info= mysqli_fetch_array($result_user_info)){
                    $emailcc[] = $row_user_info['email'];;
                    $all_display_name[] = $row_user_info['display_name'];
                    $all_department_new[] = $row_user_info['department'];
                    $all_block_new[] = $row_user_info['block'];
                }
            }
          }
        }
        //Lay mail truong phong ban
        $department_array_new = array_unique($all_department_new);
        if(!empty($department_array_new)){
            foreach($department_array_new as $value_department){
                $sql_department = "SELECT * FROM derpartment";
                $result_department = mysqli_query($con, $sql_department);
                if (mysqli_num_rows($result_department) > 0) {
                    while ($row_department = mysqli_fetch_array($result_department)) {
                        if($value_department == $row_department['name']){
                            $emailcc[] = $row_department['email_head_of_department'];
                        }
                    }
                }
            }
        }
       
        

        //end Lay danh sach nhan vien tham gia de an
        // $emailcc[] = "tuantt@nhuatienphong.net";
        var_dump($emailcc);
        $nguoithamgia = implode(", ", $all_display_name);
        $noidungthu = file_get_contents("mail_temp_add_project.txt");
        $noidungthu = str_replace(
            [ '{create_by}', '{sid}', '{status}','{tieu_de}','{type}','{base}','{issue}','{employee}','{thoigiankt}'],
            ["$create_by", "$lastId", "$status", "$name", "$type", 
            "$base",
            "$issue",              
            "$nguoithamgia",
            "$create_at"],
            $noidungthu);
        GuiMail($email, $create_by, $noidungthu, array_unique($emailcc));  
        $url = "Location: http://localhost/dean/project_add_screen.php?sid=".$lastId;
        header("$url");         
    }
    else{
        echo $query;
        echo 'Thêm Đề Án thất bại';
        echo '<a href="http://localhost/dean/index.php">Trở lại trang chủ</a>';
    }
    $con -> close();
}

?>
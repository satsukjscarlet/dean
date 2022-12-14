<?php
require 'send_email_add.php';
include('../../connection.php');
session_start();

//  var_dump($_POST);

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
    $status = 1;
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $create_at = date("Y-m-d H:i:s");
    $emailcc = array();     

    $query = "INSERT INTO item(create_by,display_name, block, department, type, name, 
    base, issue, status, create_at, field) 
    VALUES ('$create_by','$display_name', '$block', '$department','$type',
    '$name','$base','$issue','$status', '$create_at', '$field')";

    //check_name
    $sql_check_name = "Select * from item where name = '$name' AND field = '$field'";
    $query_check_name = mysqli_query($con,$sql_check_name);
    if(mysqli_fetch_assoc($query_check_name) > 0){
        echo json_encode(
            array(
                'status' => 0,
                'message' => 'Tên ý tưởng hiện đang trùng'
            )
        );
        exit();        
    }

    if (mysqli_query($con, $query)) {
        $lastId = mysqli_insert_id($con);
        // echo 'Thêm Ý Tưởng Thành Công';
        // echo $lastId;
         //Neu nhap cho ban than
        if($_POST["employee"] != "cancel"){
            //Lấy thông tin nhân viên từ sql
            $user_id = $_SESSION['user_id'];
            $sql_single_user = "SELECT * FROM users WHERE id='$user_id' LIMIT 1";
            $query_single_user = mysqli_query($con,$sql_single_user);
            $row_single_user = mysqli_fetch_assoc($query_single_user);

            $department = $row_single_user["department"];
            $block = $row_single_user["block"];
            $employeeId = $_POST["employee"];
            
            //Cap nhap phong ban va khoi
            $sqlupdate = "Update item set department = '$department', block = '$block' where id = $lastId";
            if(mysqli_query($con, $sqlupdate)){
                // echo 'Cập nhập block và department thành công';
            }else{
                // echo 'Cập nhập block và department thất bại';
            }
            //Thêm nhân viên vào danh sách tham gia
            $query_insert_user_item = "INSERT INTO user_item(employee_id, 
            item_id, create_at) 
            VALUES ('$employeeId','$lastId','$create_at')";
            if(mysqli_query($con, $query_insert_user_item)){
                // echo 'Cập nhập nhân viên vào Ý Tưởng thành công';
            }else{
                // echo 'Cập nhập nhân viên vào Ý Tưởng thất bại';
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
            // echo "Đây là số nhân viên".$row_user_item['employee_id'];
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
                $sql_department = "SELECT * FROM department";
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
        // var_dump($emailcc);
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
        $url = "http://localhost/dean/project_add_screen.php?sid=".$lastId;
        // header("$url");
        echo json_encode(
            array(
                'status' => 1,
                'url' => $url,
                'message' => 'Đã tạo mới ý tưởng'
            )
        );        
    }
    else{
        // echo $query;
        // echo 'Thêm Ý Tưởng thất bại';
        // echo '<a href="http://localhost/dean/index.php">Trở lại trang chủ</a>';
        echo json_encode(
            array(
                'status' => 0,
                'url' => $url,
                'message' => 'Đã có lỗi xảy ra thêm ý tưởng thất bại'
            )
        );    
    }
    $con -> close();
}

?>
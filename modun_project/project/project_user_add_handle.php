<?php
include('../../connection.php');
require 'send_email_add.php';
session_start();
$update_name = strtoupper($_SESSION["username"]);
$email = $_SESSION["email"];
$display_name = $_SESSION["display_name"];
$str = $_GET["sid"];
$employee_id = explode(",", $str)[0];
$item_id = explode(",", $str)[1];
echo $item_id;
echo $employee_id;

date_default_timezone_set("Asia/Ho_Chi_Minh");
$create_at = date("Y-m-d H:i:s");

//Lấy thông tin nhân viên được thêm
$sql_user = "SELECT * FROM users WHERE id='$employee_id' LIMIT 1";
$query_user = mysqli_query($con,$sql_user);
$row_user = mysqli_fetch_assoc($query_user);
$block_user = $row_user['block'];
$department_user = $row_user['department'];


//Lấy dữ liệu cũ
$sql_old = "SELECT * FROM item WHERE id='$item_id' LIMIT 1";
$query_old = mysqli_query($con,$sql_old);
$row_old = mysqli_fetch_assoc($query_old);
$create_by_old = $row_old['create_by'];
$name_old = $row_old['name'];
$status_old = $row_old['status'];
$type_old = $row_old['type'];
$base_old = $row_old['base'];
$issue_old = $row_old['issue'];
$note_old = $row_old['note'];
$update_at_old = $row_old['update_at'];
$all_display_name_old = array();       
    //Lay danh sach nhan vien tham gia de an cu
    $sql_item_id_old = "select *from user_item where item_id = '$item_id'";
    $result_itemid_old = mysqli_query($con, $sql_item_id_old);
    if (mysqli_num_rows($result_itemid_old) > 0) 
    {
      while($row_user_item_old = mysqli_fetch_array($result_itemid_old))
      {
        $id_employee_old = $row_user_item_old['employee_id'];
        // echo "Đây là số nhân viên".$id_employee_old['employee_id'];
        //Lấy thông tin nhân viên tham gia
        $sql_checkinfo_old = "select *from users where id = '$id_employee_old' LIMIT 1";
        $result_user_info_old = mysqli_query($con, $sql_checkinfo_old);
        if (mysqli_num_rows($result_user_info_old) > 0)
        {
            while($row_user_info_old= mysqli_fetch_array($result_user_info_old)){
                $all_display_name_old[] = $row_user_info_old['display_name'];
            }
        }
      }
    }
    //end Lay danh sach nhan vien tham gia de an cu
//end Lấy dữ liệu cũ
$sql = "INSERT INTO user_item(employee_id, item_id, create_at) 
VALUES ('$employee_id','$item_id','$create_at')";

if(mysqli_query($con,$sql)){ 
    
    
    
    //Gui email tao moi dean         
    $all_display_name_new = array();
    $all_department_new = array();
    $all_block_new = array();       
    $emailcc = array();     
    
    //Lay danh sach nhan vien tham gia de an
    $sql_item_id = "select *from user_item where item_id = '$item_id'";
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
                $emailcc[] = $row_user_info['email'];
                $all_display_name_new[] = $row_user_info['display_name'];
                $all_department_new[] = $row_user_info['department'];
                $all_block_new[] = $row_user_info['block'];
            }
        }
      }
    }
    //end Lay danh sach nhan vien tham gia de an
    // $emailcc[] = "tuantt@nhuatienphong.net";

    //lay du lieu moi
    $sql_new = "SELECT * FROM item WHERE id='$item_id' LIMIT 1";
    $query_new = mysqli_query($con,$sql_new);
    $row_new = mysqli_fetch_assoc($query_new);
    $create_by_new = $row_new['create_by'];
    $name_new = $row_new['name'];
    $status_new = $row_new['status'];
    $type_new = $row_new['type'];
    $base_new = $row_new['base'];
    $issue_new = $row_new['issue'];
    $note_new = $row_new['note'];
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $update_at_new = date("Y-m-d H:i:s");
    // $block = $row_new['block'];
    // $department = $row_new['department'];
    //update phong ban va khoi
    $block_array_new = array_unique($all_block_new);
    $department_array_new = array_unique($all_department_new);
    $block_new = implode(",", $block_array_new);
    $department_new = implode(",", $department_array_new);
    $sql_update_department_block = "UPDATE item SET department = '$department_new', block = '$block_new' WHERE id='$item_id'";
    mysqli_query($con,$sql_update_department_block);
    //lay danh sach phong ban hien tai
    // $explode_department = explode(',', $department);
    // $explode_block = explode(',', $block);
    // $check_department = 1;
    // $check_block = 1;
    // if(!empty($explode_department)){
    //   foreach($explode_department as $department_value)
    //   {
    //     if($department_user == $department_value){
    //     $check_department = 0;
    //     }
    //   }
    //   if($check_department==1){
    //     $update_department = $department . "," . $department_user;
        // $sql_department = "UPDATE item SET department = '$update_department' WHERE id='$item_id'";
        // $query_new = mysqli_query($con,$sql_department);
    //   }
    // }else{
    //     $sql_department = "UPDATE item SET department = '$department_user' WHERE id='$item_id'";
    //     $query_new = mysqli_query($con,$sql_department);
    // }


    // if(!empty($explode_block)){
    //   foreach($explode_block as $block_value)
    //   {
    //     if($block_user == $block_value){
    //     $check_block = 0;
    //     }
    //   }
    // echo "block".$check_block;
    //   if($check_block == 1){
    //     $update_block = $block . "," . $block_user;
    //     $sql_block = "UPDATE item SET block = '$update_block' WHERE id='$item_id'";
    //     $query_block = mysqli_query($con,$sql_block);
    //   }
    // }else{
    //   $sql_block = "UPDATE item SET block = '$block_user' WHERE id='$item_id'";
    //     $query_block = mysqli_query($con,$sql_block);
    // }

    // var_dump($explode_department);
    
    //Lay mail truong phong ban
    foreach($department_array_new as $value_department){
        if($value_department == "NMPE"){
            $emailcc[] = "longpvh@nhuatienphong.net";
        }
        if($value_department == "NSCL"){
            $emailcc[] = "locpd@nhuatienphong.net";
        }
    }

    $nguoithamgia_old = implode(", ", $all_display_name_old);
    $nguoithamgia_new = implode(", ", $all_display_name_new);

    $noidungthu = file_get_contents("mail_temp_add_user_project.txt");
    $noidungthu = str_replace(
        [ '{update_name}', '{sid}',
        '{create_by_new}','{status_new}', '{name_new}','{type_new}',
        '{base_new}','{issue_new}','{employee_new}','{update_at_new}',
        '{create_by_old}','{status_old}', '{name_old}','{type_old}',
        '{base_old}','{issue_old}','{employee_old}','{update_at_old}'
        ],
        [ "$update_name", "$item_id",
        "$create_by_new", "$status_new", "$name_new","$type_new",
        "$base_new", "$issue_new", "$nguoithamgia_new", "$update_at_new",
        "$create_by_old", "$status_old", "$name_old","$type_old",
        "$base_old", "$issue_old", "$nguoithamgia_old", "$update_at_old"],
        $noidungthu);
    GuiMail($email, $display_name, $noidungthu, $emailcc);
  var_dump($emailcc);
    echo 'Thêm nhân viên vào đề án thành công';
    $url = "Location: http://localhost/dean/project_add_screen.php?sid=".$item_id;
    header($url);
    }
    else{
        $url = "http://localhost/dean/project_add_screen.php?sid=".$item_id;
        echo 'Thêm nhân viên thất bại';
        echo '<br/>';
        echo '<a class="login" href="'.$url.'">Trở lại đề án</a>';
    }
  

$con -> close();

?>
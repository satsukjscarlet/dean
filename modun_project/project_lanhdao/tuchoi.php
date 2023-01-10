<?php 
include('../../connection.php');
require 'send_email_ld.php';
session_start();

$id = $_POST['id'];
$note = $_POST['note'];
$sql = "UPDATE item SET status = 5 WHERE id='$id'";
$XNQuery =mysqli_query($con,$sql);
if($XNQuery==true)
{

    $update_name = strtoupper($_SESSION["username"]);
    $email = $_SESSION["email"];
    $display_name = $_SESSION["display_name"];


     //Gui email       
     $all_display_name_new = array();
     $all_department_new = array();
     $all_block_new = array();       
     $emailcc = array();     
     
     //Lay danh sach nhan vien tham gia de an
     $sql_item_id = "select *from user_item where item_id = '$id'";
     $result_itemid = mysqli_query($con, $sql_item_id);
     if (mysqli_num_rows($result_itemid) > 0) 
     {
       while($row_user_item = mysqli_fetch_array($result_itemid))
       {
         $id_employee = $row_user_item['employee_id'];
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
 
     $department_array_new = array_unique($all_department_new);
     $department_new = implode(",", $department_array_new);
    
     //Lay mail truong phong ban và trưởng bộ phận
     if(!empty($department_array_new)){
         foreach($department_array_new as $value_department){
             $sql_department = "SELECT * FROM department";
             $result_department = mysqli_query($con, $sql_department);
             if (mysqli_num_rows($result_department) > 0) {
                 while ($row_department = mysqli_fetch_array($result_department)) {
                     if($value_department == $row_department['name']){
                         $emailcc[] = $row_department['email_head_of_department'];
                        //  $emailcc[] = $row_department['email_manager'];
                     }
                 }
             }
         }
     }
    $subject = "Ý Tưởng Id = ".$id." đã bị từ chối";
    $noidungthu = file_get_contents("mail_temp_tuchoi.txt");
    $noidungthu = str_replace(
        [ '{create_by}', '{sid}', '{tu_choi}'],
        ["$display_name", "$id", "$note"],
        $noidungthu);
    GuiMail($email, $update_name, $noidungthu, array_unique($emailcc),$subject); 

	 $data = array(
        'status'=>'success',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'failed',     
    );

    echo json_encode($data);
} 

?>
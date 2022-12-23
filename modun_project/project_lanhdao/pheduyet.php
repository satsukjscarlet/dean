<?php
include('../../connection.php');
require 'send_email_ld.php';
session_start();

date_default_timezone_set("Asia/Ho_Chi_Minh");
$end_at = date("Y-m-d H:i:s");

$id = $_POST['id'];
$sql_check_status = "SELECT * FROM item WHERE id='$id' LIMIT 1";
$query_check_status = mysqli_query($con, $sql_check_status);
$row_check_status = mysqli_fetch_assoc($query_check_status);

if ($row_check_status['status'] == 3) {
    $sql = "UPDATE item SET status = 4, end_at = '$end_at'  WHERE id='$id'";
    $XNQuery = mysqli_query($con, $sql);
    if ($XNQuery == true) {
        $update_name = strtoupper($_SESSION["username"]);
        $email = $_SESSION["email"];
        $display_name = $_SESSION["display_name"];
        $reward = 0;

        //Gui email       
        $all_display_name_new = array();
        $all_department_new = array();
        $all_block_new = array();
        $emailcc = array();

        //Lay danh sach nhan vien tham gia de an
        $sql_item_id = "select *from user_item where item_id = '$id'";
        $result_itemid = mysqli_query($con, $sql_item_id);
        //Số người tham gia dự án
        $total_user_join = mysqli_num_rows($result_itemid);
        if (mysqli_num_rows($result_itemid) > 0) {
            while ($row_user_item = mysqli_fetch_array($result_itemid)) {
                $id_employee = $row_user_item['employee_id'];
                //Cập nhập số tiền
                //Kiểm tra số lần tham gia dự án của 1 người
                $sql_check_user_join = "select * from user_item where employee_id = $id_employee;";
                $result_check_user_join = mysqli_query($con, $sql_check_user_join);
                $total_join = mysqli_num_rows($result_check_user_join);
                $reward_join = 100;
                if ($total_join == 2) {
                    $reward_join = 120;
                } elseif ($total_join == 3) {
                    $reward_join = 150;
                } elseif ($total_join == 4) {
                    $reward_join = 180;
                } elseif ($total_join > 4) {
                    $reward_join = 200;
                }
                $reward_user = round($reward_join / $total_user_join);
                $sql_update_reward = "update user_item set reward = '$reward_user' where employee_id = '$id_employee' and item_id = '$id';";
                mysqli_query($con, $sql_update_reward);

                //Lấy thông tin nhân viên tham gia
                $sql_checkinfo = "select *from users where id = '$id_employee' LIMIT 1";
                $result_user_info = mysqli_query($con, $sql_checkinfo);
                if (mysqli_num_rows($result_user_info) > 0) {
                    while ($row_user_info = mysqli_fetch_array($result_user_info)) {
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
        if (!empty($department_array_new)) {
            foreach ($department_array_new as $value_department) {
                $sql_department = "SELECT * FROM department";
                $result_department = mysqli_query($con, $sql_department);
                if (mysqli_num_rows($result_department) > 0) {
                    while ($row_department = mysqli_fetch_array($result_department)) {
                        if ($value_department == $row_department['name']) {
                            $emailcc[] = $row_department['email_head_of_department'];
                            $emailcc[] = $row_department['email_manager'];
                        }
                    }
                }
            }
        }

        $subject = "Đề án Id = " . $id . " đã được phê duyệt";
        $noidungthu = file_get_contents("mail_temp_pheduyet.txt");
        $noidungthu = str_replace(
            ['{create_by}', '{sid}'],
            ["$display_name", "$id"],
            $noidungthu
        );
        GuiMail($email, $update_name, $noidungthu, array_unique($emailcc), $subject);

        $data = array(
            'status' => 'success',

        );

        echo json_encode($data);
    } else {
        $data = array(
            'status' => 'failed',

        );

        echo json_encode($data);
    }
}else {
    $data = array(
        'status' => 'failed',

    );

    echo json_encode($data);

}



?>
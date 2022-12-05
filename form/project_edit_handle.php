<?php
require 'send_email.php';
include('../connection.php');
session_start();

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit(); 
  }
 var_dump($_POST);
if(isset($_POST["name"])){
    $create_by = $_POST["create_by"];
    $id = $_POST["id"];
    $email = $_SESSION["email"];
    $update_name = strtoupper($_SESSION["username"]);
    $update_display_name = $_SESSION["display_name"];

    $sql3 = "SELECT * FROM item WHERE id='$id' LIMIT 1";
    $query3 = mysqli_query($con,$sql3);
    $row3 = mysqli_fetch_assoc($query3);
    $create_by_old = $row3['create_by'];
    $name_old = $row3['name'];
    // $type_old = $row3['type'];
    $base_old = $row3['base'];
    $issue_old = $row3['issue'];
    $note_old = $row3['note'];
    $update_at_old = $row3['update_at'];

    $sql4 = "SELECT * FROM users WHERE username='$create_by' LIMIT 1";
    $query4 = mysqli_query($con,$sql4);
    $row4 = mysqli_fetch_assoc($query4);
    $email4 = $row4['email'];
    

    $create_by = $_POST["create_by"];
    // $type = $_POST["type"];
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $base = mysqli_real_escape_string($con, $_POST['base']);
    $issue = mysqli_real_escape_string($con, $_POST['issue']);
    if(isset($_POST["status"]))
    {
    $status = $_POST["status"];
    }else{
        $status = "Khởi Tạo";
    }
    $note = mysqli_real_escape_string($con, $_POST['note']);
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $update_at = date("Y-m-d H:i:s");
    if(isset($_POST["reward"]) && $_POST["reward"] != "")
    {
        $reward = $_POST["reward"];
        $query = "UPDATE item SET create_by='$create_by',name='$name',reward = '$reward',base='$base',issue='$issue',status='$status',
        note='$note', update_at='$update_at' WHERE id = '$id'";
    }else
    {
        $query = "UPDATE item SET create_by='$create_by',name='$name',base='$base',issue='$issue',status='$status',
        note='$note', update_at='$update_at' WHERE id = '$id'";
    }
  
    if(mysqli_query($con,$query)){ 
        
        $noidungthu = file_get_contents("mail_temp_editproject.txt");
        $noidungthu = str_replace(
            [ '{update_name}','{create_by}', '{tieu_de}','{base}','{issue}','{note}','{thoigiankt}'
            ,'{create_by_old}','{tieu_de_old}','{base_old}','{issue_old}','{note_old}', '{thoigiankt_old}'
            ],
            [ "$update_name", "$create_by", "$name", 
            "$base",
            "$issue",
            "$note",
            "$update_at",
            "$create_by_old", "$name_old", 
            "$base_old",
            "$issue_old",
            "$note_old",                 
            "$update_at_old"],
            $noidungthu);
        GuiMail($email, $update_display_name, $noidungthu, $email4);

        if($name != $name_old){
            $query5 = "UPDATE user_item SET item_name='$name' WHERE item_name = '$name_old'";
            mysqli_query($con,$query5);
        }


    header("Location: http://localhost/dean/index.php");
    }
    else{
        echo 'Cập nhập Đề Án thất bại';
    }
    $con -> close();
}

?>
<?php
require 'send_email.php';
$connect = mysqli_connect("localhost", "root", "", "dean");
session_start();

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit(); 
  }
 var_dump($_POST);
if(isset($_POST["name"])){
    $email = $_SESSION["email"];
    $create_by = strtoupper($_SESSION["username"]);
    $type = $_POST["type"];
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $base = mysqli_real_escape_string($connect, $_POST['base']);
    $issue = mysqli_real_escape_string($connect, $_POST['issue']);
    $status = 'Khởi Tạo';
    $note = mysqli_real_escape_string($connect, $_POST['note']);
    // $field_values_array = $_POST['field_name'];
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $create_at = date("Y-m-d H:i:s");
    $query = "INSERT INTO item(create_by, type, 
    name, base, issue, status, note, create_at) 
    VALUES ('$create_by','$type', '$name',
    '$base','$issue','$status','$note','$create_at')";
    $employee = "";
    if(mysqli_query($connect,$query)){
        //Thêm nhân viên vào chuỗi
        //  foreach($field_values_array as $value){
        //    $employee = $employee."  ".$value;
        // }
        //Thêm nhân viên vào danh sách tham gia
        $query1 = "INSERT INTO user_item(employeeNumber, 
        item_name, create_at) 
        VALUES ('$create_by','$name','$create_at')";
        mysqli_query($connect,$query1);

        //mail
        $kieu = "Bên ngoài";
        if($type == "I"){
            $kieu = "Nội bộ";
        }
        
        $sql3 = "SELECT * FROM item WHERE name='$name' LIMIT 1";
        $query3 = mysqli_query($con,$sql3);
        $row3 = mysqli_fetch_assoc($query3);
        $item_id = $row3['item_id'];
        
        $noidungthu = file_get_contents("mail_temp.txt");
        $noidungthu = str_replace(
            [ '{create_by}', '{tieu_de}','{type}','{base}','{issue}','{note}','{employee}','{thoigiankt}','{id}'],
            ["$create_by", "$name", "$type", 
            "$base",
            "$issue",
            "$note",                 
            "$create_by",
            "$create_at",
            "$item_id"],
            $noidungthu);


        GuiMail($email, $create_by, $noidungthu);
        echo $email;
        header("Location: http://10.2.2.11/dean/index.php");
    }
    else{
        echo 'Thêm Đề Án thất bại';
    }
    $connect -> close();
}

?>
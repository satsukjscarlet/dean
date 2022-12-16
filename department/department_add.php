<?php 
include('../connection.php');
$name = $_POST['name'];
$display_name = $_POST['display_name'];
$block = $_POST['block'];
$head_of_department = $_POST['head_of_department'];
$manager = $_POST['manager'];
$email_head_of_department = $_POST['email_head_of_department'];
$email_manager = $_POST['email_manager'];
$note = $_POST['note'];
$create_at = $_POST['create_at'];

$sql = "INSERT INTO `derpartment`(`name`, `display_name`, `block`, `head_of_department`, `manager`, `email_head_of_department`, `email_manager`, `note`, `create_at`) 
VALUES ('$name','$display_name','$block','$head_of_department','$manager','$email_head_of_department',
'$email_manager','$note','$create_at'))";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>
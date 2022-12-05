<?php 
include('../connection.php');
$name = $_POST['name'];
$note = $_POST['note'];
$create_by = $_POST['create_by'];

$sql = "INSERT INTO `category` (`name`,`note`,`create_by`) values ('$name', '$note', '$create_by' )";
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
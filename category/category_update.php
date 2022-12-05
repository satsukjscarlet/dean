<?php 
include('../connection.php');
$name = $_POST['name'];
$note = $_POST['note'];
$id = $_POST['id'];


$sql = "UPDATE `category` SET  `name`='$name' , `note`= '$note' WHERE id='$id' ";
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
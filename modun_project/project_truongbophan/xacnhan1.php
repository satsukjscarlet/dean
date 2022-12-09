<?php 
include('../../connection.php');

$id = $_POST['id'];
$sql = "UPDATE item SET status = 'Xác Nhận' WHERE id='$id'";
$XNQuery =mysqli_query($con,$sql);
if($XNQuery==true)
{
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
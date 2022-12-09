<?php 
include('../../connection.php');

$id = $_POST['id'];
$sql = "UPDATE item SET status = 'Từ chối' WHERE id='$id'";
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
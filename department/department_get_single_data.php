<?php 
include('../connection.php');
if(mysqli_connect_errno())
{
    echo 'Database Connection Error';
}

$id = $_POST['id'];
$sql = "SELECT * FROM category WHERE id='$id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>

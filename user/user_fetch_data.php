<?php include('../connection.php');

$output= array();
$sql = "SELECT * FROM users where status = 'NTP'";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id',
	1 => 'username',
	2 => 'display_name',
	3 => 'email',
	4 => 'jobTitle',
    5 => 'department',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " And username like '%".$search_value."%'";
	$sql .= " OR (display_name like '%".$search_value."%' and status = 'NTP')";
	$sql .= " OR (email like '%".$search_value."%' and status = 'NTP')";
	$sql .= " OR (jobTitle like '%".$search_value."%' and status = 'NTP')";
	$sql .= " OR (department like '%".$search_value."%' and status = 'NTP')";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY id desc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($con,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while($row = mysqli_fetch_assoc($query))
{
	$sub_array = array();
	$sub_array[] = $row['id'];
	$sub_array[] = $row['username'];
	$sub_array[] = $row['display_name'];
    $sub_array[] = $row['email'];
	$sub_array[] = $row['jobTitle'];
	$sub_array[] = $row['department'];
	$sub_array[] = '<a href="javascript:void();" data-id="'
	.$row['id'].'"  class="btn btn-info btn-sm editbtn" >Cập nhập</a>  <a href="javascript:void();" data-id="'
	.$row['id'].'"  class="btn btn-danger btn-sm deleteBtn" >Xóa</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);

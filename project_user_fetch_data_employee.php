<?php include('connection.php');

$output= array();
$sql = "SELECT users.id, users.username, users.display_name, users.email,users.jobTitle, users.department 
FROM users INNER JOIN user_item ON users.employeeNumber = user_item.employeeNumber 
where user_item.item_name = 'Đề án số 3';";

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
	// $search_value = $_POST['search']['value'];
	// $sql .= " WHERE username like '%".$search_value."%'";
	// $sql .= " OR email like '%".$search_value."%'";
	// $sql .= " OR mobile like '%".$search_value."%'";
	// $sql .= " OR city like '%".$search_value."%'";
}

// if(isset($_POST['order']))
// {
// 	$column_name = $_POST['order'][0]['column'];
// 	$order = $_POST['order'][0]['dir'];
// 	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
// }
// else
// {
// 	$sql .= " ORDER BY id desc";
// }

// if($_POST['length'] != -1)
// {
// 	$start = $_POST['start'];
// 	$length = $_POST['length'];
// 	$sql .= " LIMIT  ".$start.", ".$length;
// }	

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
	$sub_array[] = '';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);

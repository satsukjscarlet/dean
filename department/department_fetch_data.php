<?php include('../connection.php');

$output= array();
$sql = "SELECT * FROM department";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id',
	1 => 'name',
	2 => 'display_name',
	3 => 'block',
	4 => 'head_of_department',
	5 => 'manager',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE name like '%".$search_value."%'";
	$sql .= " OR display_name like '%".$search_value."%'";
	$sql .= " OR block like '%".$search_value."%'";
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
	$sub_array[] = $row['name'];
	$sub_array[] = $row['display_name'];
	$sub_array[] = $row['block'];
	
	//Lấy tên truong ban
	$id_head_of_department = $row['head_of_department'];
	$sql_head_of_department = "SELECT * FROM users WHERE id='$id_head_of_department' LIMIT 1";
	$query_head_of_department = mysqli_query($con,$sql_head_of_department);
	$row_head_of_department = mysqli_fetch_assoc($query_head_of_department);
	$sub_array[] = $row_head_of_department['display_name'];

	//Lấy tên lanhdao
	$id_manager = $row['manager'];
	$sql_manager = "SELECT * FROM users WHERE id='$id_manager' LIMIT 1";
	$query_manager = mysqli_query($con,$sql_manager);
	$row_manager = mysqli_fetch_assoc($query_manager);
	$sub_array[] = $row_manager['display_name'];

	$sub_array[] = 
	'<a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-info btn-sm editbtn" >Cập nhập</a> 
	 <a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-danger btn-sm deleteBtn" >Xóa</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);

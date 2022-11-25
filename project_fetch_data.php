<?php include('connection.php');
session_start();
$output= array();
$sql = "SELECT * FROM item ";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id',
	1 => 'create_by',
	2 => 'type',
	3 => 'name',
	4 => 'status',
    5 => 'note',
	6 => 'reward',
	7 => 'base',
	8 => 'issue',
	9 => 'create_at',
	10 => 'update_at',
	11 => 'end_at'
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE create_by like '%".$search_value."%'";
	$sql .= " OR type like '%".$search_value."%'";
	$sql .= " OR name like '%".$search_value."%'";
	$sql .= " OR status like '%".$search_value."%'";
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
	$sub_array[] = $row['create_by'];
	$sub_array[] = $row['type'];
    $sub_array[] = $row['name'];
	$sub_array[] = $row['status'];
	$sub_array[] = $row['note'];
	$sub_array[] = $row['reward'];
	$sub_array[] = 
	'<a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-info btn-sm editbtn" >Cập nhập</a>';
	// <a href="javascript:void();"data-id="'.$row['id'].'"  class="btn btn-danger btn-sm deleteBtn" >Xóa</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);

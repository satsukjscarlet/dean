<?php include('../connection.php');
session_start();
$username = strtoupper($_SESSION["username"]);
$email = $_SESSION["email"];
$display_name = $_SESSION["display_name"];
$level = $_SESSION["level"];


$output= array();
$sql = "SELECT * FROM item ";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id',
	1 => 'create_by',
	2 => 'name',
	3 => 'field',
	4 => 'issue',
	5 => 'status',
    6 => 'create_at',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE create_by like '%".$search_value."%'";
	$sql .= " OR name like '%".$search_value."%'";
	$sql .= " OR field like '%".$search_value."%'";
	$sql .= " OR issue like '%".$search_value."%'";
	$sql .= " OR status like '%".$search_value."%'";
	$sql .= " OR create_at like '%".$search_value."%'";
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
	$sub_array[] = $row['create_by'];

	//Lấy tên nv
	$name_search = $row['create_by'];
	$sql_get_display_name = "SELECT * FROM users WHERE username='$name_search' LIMIT 1";
	$query_get_display_name = mysqli_query($con,$sql_get_display_name);
	$row_get_display_name = mysqli_fetch_assoc($query_get_display_name);
	$sub_array[] = $row_get_display_name['display_name'];

	$sub_array[] = '<a style="word-wrap:break-word;" href="javascript:void();" data-id="'.$row['id'].'"  class= "editbtn" >'.$row['name'].'</a>';
    //Lay field truong phong ban
	$sql_field = "SELECT * FROM category WHERE id='".$row['field']."' LIMIT 1";
	$query_field = mysqli_query($con,$sql_field);
	$row_field = mysqli_fetch_assoc($query_field);
	$sub_array[] = $row_field['name'];
	//end Lay field truong phong ban
	$sub_array[] = $row['issue'];

	
	if($row['status'] == 1){
		$sub_array[] = '<a class="badge badge-secondary text-white">Khởi Tạo</a>';
	}elseif($row['status'] == 2){
		$sub_array[] = '<a class="badge badge-warning text-white">Chờ Bổ Sung</a>';
	}elseif($row['status'] == 3){
		$sub_array[] = '<a class="badge badge-primary text-white">Xác Nhận</a>';
	}elseif($row['status'] == 4){
		$sub_array[] = '<a class="badge badge-success text-white">Phê Duyệt</a>';
	}elseif($row['status'] == 5){
		$sub_array[] = '<a class="badge badge-danger text-white">Từ Chối</a>';
	}else{
		$sub_array[] = $row['status'];
	}
	$sub_array[] = $row['create_at'];
	if($username == $row['create_by'] && $row['status'] == 1){
		$sub_array[] =
			'<a href="javascript:void();" data-id="' . $row['id'] . '"  class="btn btn-info btn-sm editbtn fa fa-eye" data-toggle="tooltip" data-placement="top" title="Xem"></a>
	<a href="javascript:void();" data-id="' . $row['id'] . '"  class="btn btn-warning btn-sm editbtn fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Cập nhập"></a>';
	}else{
		$sub_array[] =
		'<a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-info btn-sm editbtn fa fa-eye" data-toggle="tooltip" data-placement="top" title="Xem"></a>';
	}
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);

<?php include('../../connection.php');
session_start();
$username = strtoupper($_SESSION["username"]);
$email = $_SESSION["email"];
$display_name = $_SESSION["display_name"];
$level = $_SESSION["level"];
$department = $_SESSION["department"];
$block = $_SESSION["block"];

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
	$sql .= " WHERE name like '%".$search_value."%'";
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
	$explode_block = explode(',', $row['block']);
	$check_block = 0;
	foreach($explode_block as $value_block){
		if($block == $value_block){
			$check_block = 1;
		}
	}
	if($level == 3 && $check_block == 1 && $row['status'] == 'Xác Nhận'){
		$sub_array = array();
		$sub_array[] = $row['create_by'];
		$sub_array[] = '<a style="word-wrap:break-word;" href="javascript:void();" data-id="'.$row['id'].'"  class= "editbtn" >'.$row['name'].'</a>';
		//doi id sang name field
		$sql_field = "SELECT * FROM category WHERE id='".$row['field']."' LIMIT 1";
		$query_field = mysqli_query($con,$sql_field);
		$row_field = mysqli_fetch_assoc($query_field);
		$sub_array[] = $row_field['name'];
		$sub_array[] = $row['issue'];
	
		
		if($row['status'] == "Chấp Thuận"){
			$sub_array[] = '<a class="bg-success text-white" >'.$row['status'].'</a>';
		}elseif($row['status'] == "Từ Chối"){
			$sub_array[] = '<a class="bg-danger text-white" >'.$row['status'].'</a>';
		}else{
			$sub_array[] = $row['status'];
		}
		$sub_array[] = $row['create_at'];
		$sub_array[] = 
				'<a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-success btn-sm pheduyetBtn fa fa-check" data-toggle="tooltip" data-placement="top" title="Phê duyệt"></a>
				<a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-danger btn-sm tuchoiBtn fa fa-times" data-toggle="tooltip" data-placement="top" title="Từ chối"></a>
				<a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-info btn-sm themthongtinBtn fa fa-search" data-toggle="tooltip" data-placement="top" title="Yêu cầu bổ sung thông tin"></a>';	
		$data[] = $sub_array; 
	}
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);

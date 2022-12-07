<?php include('connection.php');

//Lọc trùng cũ
$ssid = $_POST['id'];
$sql_check_user = "SELECT * from user_item where item_id = '$ssid'";
$alluser = array();
$result_check_user = mysqli_query($con, $sql_check_user);
if (mysqli_num_rows($result_check_user) > 0) {
	while ($row_user_item = mysqli_fetch_array($result_check_user)) {
		$alluser[] = $row_user_item['employee_id'];
	}
}


$id_nguoithamgia = implode(",", $alluser);
if(!empty($alluser)){
	$sql = "SELECT * FROM users Where id NOT IN ($id_nguoithamgia)";
}else{
	$sql = "SELECT * FROM users";
}


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
	if (!empty($alluser)) {
		$sql .= " AND username like '%" . $search_value . "%'";
		$sql .= " OR (email like '%".$search_value."%' and id NOT IN ($id_nguoithamgia))";
		$sql .= " OR (display_name like '%".$search_value."%' and id NOT IN ($id_nguoithamgia))";
		$sql .= " OR (jobTitle like '%".$search_value."%' and id NOT IN ($id_nguoithamgia))";
		$sql .= " OR (department like '%".$search_value."%' and id NOT IN ($id_nguoithamgia))";
	}else{
		$sql .= " Where username like '%".$search_value."%'";
		$sql .= " OR email like '%".$search_value."%'";
		$sql .= " OR display_name like '%".$search_value."%'";
		$sql .= " OR jobTitle like '%".$search_value."%'";
		$sql .= " OR department like '%".$search_value."%'";
	}
	
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
	// $sub_array[] = $id_nguoithamgia;
	$sub_array[] = $row['username'];
	$sub_array[] = $row['display_name'];
    $sub_array[] = $row['email'];
	$sub_array[] = $row['jobTitle'];
	$sub_array[] = $row['department'];
	$sub_array[] = '<a href="javascript:void();" data-id="'
	.$row['id'].'"  class="btn btn-info btn-sm editbtn" >Chọn</a>  <a href="javascript:void();" data-id="';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);

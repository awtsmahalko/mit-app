<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../../core/config.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->user_id) && !empty($data->user_id) ){
	
	$user_id = $mysqli_connect->real_escape_string($data->user_id);

	$response = array();

	$fetch_rows = $mysqli_connect->query("SELECT * from tbl_release_header ORDER BY release_date DESC ") or die(mysqli_error());
	while($row = $fetch_rows->fetch_array()){
		$list = array();

		$list['id'] = $row['release_id'];
		//$list['pr_no'] = getPRNum($row['pr_id']);
		$list['release_no'] = $row['release_no'];
		$list['release_date'] = date('M d, y', strtotime($row['release_date']));
		$list['release_status'] = $row['release_status'];
		$list['encoded_by'] = getUser($row['user_id']);
		$list['release_days_consume'] = $row['release_days_consume'];

		array_push($response, $list);
	}

	echo json_encode($response);
	
}

?>
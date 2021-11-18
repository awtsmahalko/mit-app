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

	$fetch_rows = $mysqli_connect->query("SELECT * from tbl_purchase_request_header ORDER BY pr_date DESC ") or die(mysqli_error());
	while($row = $fetch_rows->fetch_array()){
		$list = array();

		$list['id'] = $row['pr_id'];
		$list['pr_no'] = $row['pr_no'];
		$list['pr_batch'] = $row['pr_batch'];
		$list['pr_date'] = date('M d, y', strtotime($row['pr_date']));
		$list['pr_purpose'] = $row['pr_purpose'];
		$list['pr_status'] = $row['pr_status'];
		$list['requested_by'] = getUser($row['user_id']);
		$list['approved_by'] = getUser($row['approved_by']);

		array_push($response, $list);
	}

	echo json_encode($response);
	
}

?>
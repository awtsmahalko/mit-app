<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../../core/config.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->id) && !empty($data->id) ){
	
	$release_id = $mysqli_connect->real_escape_string($data->id);

	$response = array();

	$fetch_rows = $mysqli_connect->query("SELECT * from tbl_release_details where release_id='$release_id' ") or die($mysqli_connect->error);
	while($row = $fetch_rows->fetch_array()){
		$list = array();

		$list['id'] = $row['release_detail_id'];
		$list['item'] = getItem($row['item_id']);
		$list['packaging'] = getPackaging($row['packaging_id']);
		$list['qty'] = $row['qty'];
		//$list['cost'] = $row['cost'];

		array_push($response, $list);
	}

	echo json_encode($response);
	
}

<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../../core/config.php';

$data = json_decode(file_get_contents("php://input"));

$response = array();

$fetch_rows = $mysqli_connect->query("SELECT * from `tbl_suppliers` ORDER BY supplier_name ASC") or die(mysqli_error());
while($row = $fetch_rows->fetch_array()){
	$list = array();

	$list['supplier_id'] = $row['supplier_id'];
	$list['supplier_name'] = $row['supplier_name'];

	array_push($response, $list);
}

echo json_encode($response);

?>
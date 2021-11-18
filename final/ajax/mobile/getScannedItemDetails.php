<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../../core/config.php';

$data = json_decode(file_get_contents("php://input"));

$response = array();


if(isset($data->barcode) && !empty($data->barcode) ){

	$barcode = $mysqli_connect->real_escape_string($data->barcode);
	$data = explode("-",$barcode);
	$item_id = $data[0];
	$packaging_id = $data[1];


	$fetch_item = $mysqli_connect->query("SELECT * FROM tbl_items WHERE item_id = '$item_id' ") or die($mysqli_connect->error);
	$item_row = $fetch_item->fetch_array();

	$fetch_packaging = $mysqli_connect->query("SELECT packaging_id, packaging_name FROM tbl_packaging WHERE packaging_id = '$packaging_id' ") or die($mysqli_connect->error);
	$packaging_row = $fetch_packaging->fetch_array();

	$fetch_item_packaging = $mysqli_connect->query("SELECT ip_id FROM tbl_items_packaging WHERE item_id = '$item_id' and packaging_id='$packaging_id' ") or die($mysqli_connect->error);
	$item_packaging_row = $fetch_item_packaging->fetch_array();
	
	$response['ip_id'] = $item_packaging_row['ip_id'];
	$response['item'] = $item_row['item_name'];
	$response['item_desc'] = $item_row['item_desc'];
	$response['item_serial_no'] = $item_row['item_serial_no'];
	$response['packaging'] = $packaging_row['packaging_name'];
	$response['packaging_id'] = $packaging_row['packaging_id'];
	$response['item_id'] = $item_row['item_id'];

	$response['item_details'] = "Item name: " . $item_row['item_name'] . "(". $packaging_row['packaging_name'] .")" . "<br>"
					. "Serial #: " . $item_row['item_serial_no'] . "<br>"
					. "Description: " . $item_row['item_desc'] . "<br>";

	echo json_encode($response);

}

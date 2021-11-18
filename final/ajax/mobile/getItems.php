<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../../core/config.php';

$data = json_decode(file_get_contents("php://input"));

$response = array();

$fetch_rows = $mysqli_connect->query("SELECT ip.ip_id, i.item_name, p.packaging_name, p.packaging_id, i.item_id FROM tbl_items i LEFT JOIN `tbl_items_packaging` ip ON ip.item_id=i.item_id LEFT JOIN tbl_packaging p ON ip.packaging_id=p.packaging_id WHERE ip.ip_id > 0 ORDER BY i.item_name ASC") or die(mysqli_error());
while($row = $fetch_rows->fetch_array()){
	$list = array();

	$list['id'] = $row['ip_id'];
	$list['item'] = $row['item_name'];
	$list['packaging'] = $row['packaging_name'];
	$list['packaging_id'] = $row['packaging_id'];
	$list['item_id'] = $row['item_id'];

	array_push($response, $list);
}

echo json_encode($response);

?>
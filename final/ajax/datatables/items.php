<?php
require_once '../../core/config.php';

$fetch = $mysqli_connect->query("SELECT * from tbl_items ORDER BY item_name ASC") or die($mysqli_connect->error);

$response['data'] = array();

while ($row = $fetch->fetch_array()) {
	$list = array();

	$list['id'] = $row['item_id'];
	$list['item_name'] = $row["item_name"];
	$list['item_desc'] = ""; //$row['item_desc'];
	$list['item_serial_no'] = ""; // $row['item_serial_no'];
	$list['date_modified'] = ""; //date('M d, Y h:i A', strtotime($row['date_modified']));

	array_push($response['data'], $list);
}

echo json_encode($response);

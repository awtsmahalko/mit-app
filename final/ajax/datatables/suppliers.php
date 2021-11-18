<?php
require_once '../../core/config.php';

$fetch = $mysqli_connect->query("SELECT * from tbl_suppliers ORDER BY supplier_name ASC") or die($mysqli_connect->error);

$response['data'] = array();

while ($row = $fetch->fetch_array()) {
	$list = array();

	$list['id'] = $row['supplier_id'];
	$list['supplier_name'] = $row['supplier_name'];
	$list['supplier_owner'] = $row['supplier_owner'];
	$list['supplier_address'] = $row['supplier_address'];
	$list['supplier_contact_no'] = $row['supplier_contact_no'];
	$list['supplier_email'] = $row['supplier_email'];
	$list['supplier_tin'] = $row['supplier_tin'];
	$list['remarks'] = $row['remarks'];
	$list['date_modified'] = date('M d, Y h:i A', strtotime($row['date_modified']));

	array_push($response['data'], $list);
}

echo json_encode($response);

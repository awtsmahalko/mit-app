<?php
require_once '../../core/config.php';

$fetch = $mysqli_connect->query("SELECT * from tbl_packaging ORDER BY packaging_name ASC") or die(mysqli_error());

$response['data'] = array();

while( $row = $fetch->fetch_array() ){
	$list = array();
	
	$list['id'] = $row['packaging_id'];
	$list['packaging_name'] = $row['packaging_name'];
	$list['actual_qty'] = $row['actual_qty'];
	$list['date_modified'] = date('M d, Y h:i A', strtotime($row['date_modified']));

	array_push($response['data'], $list);
}

echo json_encode($response);

?>
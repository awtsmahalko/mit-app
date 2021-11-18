<?php
require_once '../../core/config.php';

$fetch = $mysqli_connect->query("SELECT * from tbl_users ORDER BY user_fname ASC") or die($mysqli_connect->error);

$response['data'] = array();
$pc_badges = array(
	'ELEM' => "<span class='badge badge-warning'>ELEMENTARY</span>",
	'JHS' => "<span class='badge badge-success'>JUNIOR HIGH SCHOOL</span>",
	'SHS' => "<span class='badge badge-primary'>SENIOR HIGH SCHOOL</span>"
);
while ($row = $fetch->fetch_array()) {
	$list = array();

	$list['id'] = $row['user_id'];
	$list['user_name'] = ucfirst($row['user_fname']) . ' ' . ucfirst($row['user_mname']) . ' ' . ucfirst($row['user_lname']);
	if ($row['user_category'] == 'AA') {
		$category = 'Administrative Assistant';
	} else if ($row['user_category'] == 'BAC') {
		$category = 'BAC';
	} else if ($row['user_category'] == 'IO') {
		$category = 'Inspection Officer';
	} else if ($row['user_category'] == 'PC') {
		$category = 'Property Custodian' . ($row['pc_designation'] != '' ? $pc_badges[$row['pc_designation']] : "");
	} else {
		$category = '';
	}

	$list['user_category'] = $category;
	$list['username'] = $row['username'];
	$list['user_email'] = $row['user_email'];
	$list['user_contact_no'] = $row['user_contact_no'];
	$list['date_modified'] = date('M d, Y h:i A', strtotime($row['date_modified']));

	array_push($response['data'], $list);
}

echo json_encode($response);

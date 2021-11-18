<?php
require_once '../core/config.php';

if (isset($_POST['hidden_id'])) {
	$user_id = $_POST['hidden_id'];
	$user_fname = $mysqli_connect->real_escape_string($_POST['user_fname']);
	$user_mname = $mysqli_connect->real_escape_string($_POST['user_mname']);
	$user_lname = $mysqli_connect->real_escape_string($_POST['user_lname']);
	$user_category = $mysqli_connect->real_escape_string($_POST['user_category']);
	$user_email = $mysqli_connect->real_escape_string($_POST['user_email']);
	$user_contact_no = $mysqli_connect->real_escape_string($_POST['user_contact_no']);

	$username = $mysqli_connect->real_escape_string($_POST['username']);
	$password = $mysqli_connect->real_escape_string($_POST['password']);
	$module = $mysqli_connect->real_escape_string($_POST['module']);
	$date = getCurrentDate();

	if ($module == 'add') {
		$fetch_rows = $mysqli_connect->query("SELECT count(user_id) from tbl_users where username='$username' ") or die($mysqli_connect->error);
		$count_rows = $fetch_rows->fetch_array();

		if ($count_rows[0] > 0) {
			echo 2;
		} else {
			$sql = $mysqli_connect->query("INSERT INTO `tbl_users`(`user_fname`, `user_mname`, `user_lname`, `username`, `password`, `user_category`,`user_email`,`user_contact_no`, `date_modified`) VALUES ('$user_fname','$user_mname','$user_lname','$username',md5('$password'),'$user_category','$user_email','$user_contact_no','$date')");

			if ($sql) {
				echo 1;
			} else {
				echo 0;
			}
		}
	} else {
		$fetch_count_rows = $mysqli_connect->query("SELECT count(user_id) from tbl_users where username='$username' and user_id != '$user_id' ") or die($mysqli_connect->error);
		$count_rows = $fetch_count_rows->fetch_array();

		if ($count_rows[0] > 0) {
			echo 2;
		} else {
			$sql = $mysqli_connect->query("UPDATE `tbl_users` SET `user_fname`='$user_fname',`user_mname`='$user_mname',`user_lname`='$user_lname',`username`='$username',`user_category`='$user_category',`user_email`='$user_email',`user_contact_no`='$user_contact_no',`date_modified`='$date' WHERE user_id='$user_id'") or die($mysqli_connect->error);

			if ($sql) {
				echo 1;
			} else {
				echo 0;
			}
		}
	}
}

if ($_POST['module'] == 'fetch-pc') {
	$fetch_pc = $mysqli_connect->query("SELECT * FROM tbl_users WHERE user_category = 'PC'") or die($mysqli_connect->error);
	$select_elem = "<option value=''> &mdash; Please Select &mdash; </option>";
	$select_jhs = "<option value=''> &mdash; Please Select &mdash; </option>";
	$select_shs = "<option value=''> &mdash; Please Select &mdash; </option>";
	while ($row = $fetch_pc->fetch_array()) {

		$is_selected_elem = $row['pc_designation'] == 'ELEM' ? "selected" : "";
		$is_selected_jhs = $row['pc_designation'] == 'JHS' ? "selected" : "";
		$is_selected_shs = $row['pc_designation'] == 'SHS' ? "selected" : "";

		$select_elem .= "<option $is_selected_elem value='$row[user_id]'> $row[user_fname] $row[user_mname] $row[user_lname] </option>";
		$select_jhs .= "<option $is_selected_jhs value='$row[user_id]'> $row[user_fname] $row[user_mname] $row[user_lname] </option>";
		$select_shs .= "<option $is_selected_shs value='$row[user_id]'> $row[user_fname] $row[user_mname] $row[user_lname] </option>";
	}

	$response['elem'] = $select_elem;
	$response['jhs'] = $select_jhs;
	$response['shs'] = $select_shs;

	echo json_encode($response);
}

if ($_POST['module'] == 'assign-pc') {
	$cats = $_POST['cat'];

	if (count(array_unique($cats, SORT_REGULAR)) < count($cats)) {
		echo 2;
	} else {
		$mysqli_connect->query("UPDATE `tbl_users` SET `pc_designation`=NULL") or die($mysqli_connect->error);
		foreach ($cats as $pc_designation => $user_id) {
			$mysqli_connect->query("UPDATE `tbl_users` SET `pc_designation`='$pc_designation' WHERE user_id='$user_id'") or die($mysqli_connect->error);
		}
		echo 1;
	}
}

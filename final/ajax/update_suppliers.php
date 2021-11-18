<?php
require_once '../core/config.php';

if (isset($_POST['hidden_id'])) {
	$supplier_id = $_POST['hidden_id'];
	$supplier_name = $mysqli_connect->real_escape_string($_POST['supplier_name']);
	$supplier_owner = strtoupper($mysqli_connect->real_escape_string($_POST['supplier_owner']));
	$supplier_address = $mysqli_connect->real_escape_string($_POST['supplier_address']);
	$supplier_contact_no = $mysqli_connect->real_escape_string($_POST['supplier_contact_no']);
	$supplier_email = $mysqli_connect->real_escape_string($_POST['supplier_email']);
	$supplier_tin = $mysqli_connect->real_escape_string($_POST['supplier_tin']);
	$remarks = $mysqli_connect->real_escape_string($_POST['remarks']);
	$module = $mysqli_connect->real_escape_string($_POST['module']);
	$date = getCurrentDate();

	if ($module == 'add') {
		$fetch_rows = $mysqli_connect->query("SELECT count(supplier_id) from tbl_suppliers where supplier_name='$supplier_name' and supplier_address='$supplier_address' ") or die($mysqli_connect->error);
		$count_rows = $fetch_rows->fetch_array();

		if ($count_rows[0] > 0) {
			echo 2;
		} else {
			$sql = $mysqli_connect->query("INSERT INTO `tbl_suppliers`(`supplier_name`, `supplier_owner`, `supplier_address`, `supplier_contact_no`,`supplier_email`, `supplier_tin`, `remarks`, `date_modified`) VALUES ('$supplier_name','$supplier_owner','$supplier_address','$supplier_contact_no','$supplier_email','$supplier_tin','$remarks','$date')");

			if ($sql) {
				echo 1;
			} else {
				echo 0;
			}
		}
	} else {
		$fetch_count_rows = $mysqli_connect->query("SELECT count(supplier_id) from tbl_suppliers where supplier_name='$supplier_name' and supplier_address='$supplier_address' and supplier_id != '$supplier_id' ") or die($mysqli_connect->error);
		$count_rows = $fetch_count_rows->fetch_array();

		if ($count_rows[0] > 0) {
			echo 2;
		} else {
			$sql = $mysqli_connect->query("UPDATE `tbl_suppliers` SET `supplier_name`='$supplier_name',`supplier_owner`='$supplier_owner',`supplier_address`='$supplier_address',`supplier_contact_no`='$supplier_contact_no',`supplier_email`='$supplier_email',`supplier_tin` = '$supplier_tin',`remarks`='$remarks',`date_modified`='$date' WHERE supplier_id='$supplier_id'") or die($mysqli_connect->error);

			if ($sql) {
				echo 1;
			} else {
				echo 0;
			}
		}
	}
}

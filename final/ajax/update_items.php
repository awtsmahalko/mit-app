<?php
require_once '../core/config.php';

if(isset($_POST['hidden_id'])){
	$item_id = $_POST['hidden_id'];
	$item_name = $mysqli_connect->real_escape_string($_POST['item_name']);
	$item_desc = $mysqli_connect->real_escape_string($_POST['item_desc']);
    $item_serial_no = $mysqli_connect->real_escape_string($_POST['item_serial_no']);
	$module = $mysqli_connect->real_escape_string($_POST['module']);
	$date = getCurrentDate();

	if($module == 'add'){
		$fetch_rows = $mysqli_connect->query("SELECT count(item_id) from tbl_items where item_name='$item_name'") or die(mysqli_error());
		$count_rows = $fetch_rows->fetch_array();

		if($count_rows[0] > 0){
			echo 2;
		}else{
			$sql= $mysqli_connect->query("INSERT INTO `tbl_items`(`item_name`, `item_desc`, `item_serial_no`, `date_modified`) VALUES ('$item_name','$item_desc','$item_serial_no','$date')");
				
			if($sql){
				echo 1;
			}else{
				echo 0;
			}
			
		}
	}else{
		$fetch_count_rows = $mysqli_connect->query("SELECT count(item_id) from tbl_items where item_name='$item_name' and item_id != '$item_id' ") or die(mysqli_error());
		$count_rows = $fetch_count_rows->fetch_array();

		if($count_rows[0] > 0){
			echo 2;
		}else{
			$sql = $mysqli_connect->query("UPDATE `tbl_items` SET `item_name`='$item_name',`item_desc`='$item_desc',`item_serial_no`='$item_serial_no',`date_modified`='$date' WHERE item_id='$item_id'") or die(mysqli_error());

			if($sql){
				echo 1;
			}else{
				echo 0;
			}
		}
	}
	
}

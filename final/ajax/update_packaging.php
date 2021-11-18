<?php
require_once '../core/config.php';

if(isset($_POST['hidden_id'])){
	$packaging_id = $_POST['hidden_id'];
	$packaging_name = $mysqli_connect->real_escape_string($_POST['packaging_name']);
	$actual_qty = $mysqli_connect->real_escape_string($_POST['actual_qty']);
	$module = $mysqli_connect->real_escape_string($_POST['module']);
	$date = getCurrentDate();

	if($module == 'add'){
		$fetch_rows = $mysqli_connect->query("SELECT count(packaging_id) from tbl_packaging where packaging_name='$packaging_name' ") or die($mysqli_connect->error);
		$count_rows = $fetch_rows->fetch_array();

		if($count_rows[0] > 0){
			echo 2;
		}else{
			$sql= $mysqli_connect->query("INSERT INTO `tbl_packaging`(`packaging_name`, `actual_qty`, `date_modified`) VALUES ('$packaging_name','$actual_qty','$date')");
				
			if($sql){
				echo 1;
			}else{
				echo 0;
			}
			
		}
	}else{
		$fetch_count_rows = $mysqli_connect->query("SELECT count(packaging_id) from tbl_packaging where packaging_name='$packaging_name' and packaging_id != '$packaging_id' ") or die($mysqli_connect->error);
		$count_rows = $fetch_count_rows->fetch_array();

		if($count_rows[0] > 0){
			echo 2;
		}else{
			$sql = $mysqli_connect->query("UPDATE `tbl_packaging` SET `packaging_name`='$packaging_name',`actual_qty`='$actual_qty',`date_modified`='$date' WHERE packaging_id='$packaging_id'") or die($mysqli_connect->error);

			if($sql){
				echo 1;
			}else{
				echo 0;
			}
		}
	}
	
}

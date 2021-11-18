<?php
require_once '../core/config.php';

if(isset($_POST['old_password'])){
	$user_id = $_SESSION['user_id'];
	$old_password = $mysqli_connect->real_escape_string($_POST['old_password']);
	$new_password = $mysqli_connect->real_escape_string($_POST['new_password']);
	$confirm_new_password = $mysqli_connect->real_escape_string($_POST['confirm_new_password']);
	$date = getCurrentDate();
	
	$fetch_user = $mysqli_connect->query("SELECT password from tbl_users where user_id = '$user_id' ") or die($mysqli_connect->error);
	$user_row = $fetch_user->fetch_array();

	if(md5($old_password) != $user_row[0]){
		echo 2; // old pw dont match
	}else if($new_password != $confirm_new_password){
		echo 3; // pw dont match
	}else{
		$sql = $mysqli_connect->query("UPDATE `tbl_users` SET password=md5('$new_password') ,`date_modified`='$date' WHERE user_id='$user_id'") or die($mysqli_connect->error);

		if($sql){
			echo 1;
		}else{
			echo 0;
		}
	}

	$mysqli_connect->close();
	
}

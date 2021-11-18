<?php
require_once '../core/config.php';

if(isset($_POST['user_fname'])){
	$user_id = $_SESSION['user_id'];
	$user_fname = $mysqli_connect->real_escape_string($_POST['user_fname']);
	$user_mname = $mysqli_connect->real_escape_string($_POST['user_mname']);
	$user_lname = $mysqli_connect->real_escape_string($_POST['user_lname']);
	$username = $mysqli_connect->real_escape_string($_POST['username']);
	$date = getCurrentDate();
	
	$fetch_count_rows = $mysqli_connect->query("SELECT count(user_id) from tbl_users where user_fname='$user_fname' and user_mname='$user_mname' and user_lname = '$user_lname' and user_id != '$user_id' ") or die(mysqli_error());
	$count_rows = $fetch_count_rows->fetch_array();

	if($count_rows[0] > 0){
		echo 2;
	}else{
		$sql = $mysqli_connect->query("UPDATE `tbl_users` SET `user_fname`='$user_fname',`user_mname`='$user_mname',`user_lname`='$user_lname',`username`='$username',`date_modified`='$date' WHERE user_id='$user_id'") or die(mysqli_error());

		if($sql){
			echo 1;
			$_SESSION['username'] = $username;
			$_SESSION['user_fname'] = $user_fname;
			$_SESSION['user_mname'] = $user_mname;
			$_SESSION['user_lname'] = $user_lname;

		}else{
			echo 0;
		}
	}

	$mysqli_connect->close();
	
}

?>
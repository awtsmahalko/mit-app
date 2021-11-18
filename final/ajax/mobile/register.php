<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../../core/config.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->username) && !empty($data->username) ){
	$user_fname = $mysqli_connect->real_escape_string($data->user_fname);
	$user_mname = "";//$mysqli_connect->real_escape_string($_POST['user_mname']);
    $user_lname = $mysqli_connect->real_escape_string($data->user_lname);
    $category = "U";//$mysqli_connect->real_escape_string($_POST['category']);
	
	$username = $mysqli_connect->real_escape_string($data->username);
	$password = $mysqli_connect->real_escape_string($data->password);

	$date = getCurrentDate();

	$fetch_rows = $mysqli_connect->query("SELECT count(user_id) from tbl_users where username='$username' ") or die($mysqli_connect->error);
	$count_rows = $fetch_rows->fetch_array();

	if($count_rows[0] > 0){
		echo -1;
	}else{
		$sql= $mysqli_connect->query("INSERT INTO `tbl_users`(`user_fname`, `user_mname`, `user_lname`, `username`, `password`, `category`, `date_added`) VALUES ('$user_fname','$user_mname','$user_lname','$username',md5('$password'),'$category','$date')");
			
		if($sql){
			$user_id = $mysqli_connect->insert_id;
			echo $user_id;
		}else{
			echo 0;
		}
		
	}
	
}

<?php
require_once '../core/config.php';

$userlogin = $_POST['userlogin'];
$userpassword = $_POST['userpassword'];

/*if(passwordHashing == true)
		{
			$userpassword =  clean($_POST['userpassword']);
		}else
		{
			$userpassword = clean($_POST['userpassword']);
		}*/

$host 	  = host;
$username = username;
$password = password;
$database = database;
$user_connect = new mysqli($host, $username, $password, $database);

$query = "SELECT * FROM ";
$query .= table;
$query .= " WHERE username = '$userlogin' AND password = md5('$userpassword')";

$result = $user_connect->query($query) or die($user_connect->error);

if ($result->num_rows == 1) {


	$row = $result->fetch_assoc();
	$_SESSION['user_id'] = $row['user_id'];
	$_SESSION['username'] = $row['username'];
	$_SESSION['user_fname'] = $row['user_fname'];
	$_SESSION['user_mname'] = $row['user_mname'];
	$_SESSION['user_lname'] = $row['user_lname'];
	$_SESSION['category'] = $row['user_category'];
	$_SESSION['pc_designation'] = $row['pc_designation'];
	//$_SESSION['session_school_year'] = "";

	if ($row['user_category'] == 'A') {
		$_SESSION['sidebar_priv'] = 1;
	} else if ($row['user_category'] == 'G') {
		$_SESSION['sidebar_priv'] = 0;
	} else {
		$_SESSION['sidebar_priv'] = 0;
	}

	echo 1;

	//header("Location:../index.php");

	exit;

	$user_connect->close();
} else {
	$_SESSION['error']  = error_message;
	echo 0;
	//header("Location:../auth/login.php");
	exit;
}

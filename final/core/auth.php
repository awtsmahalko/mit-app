<?php

function checkLoginStatus(){
if (!isset($_SESSION['user_id'])){
		header("Location: auth/login.php");
		exit;
	}

}

function clean($str) {
        $str = @trim($str);
        if(get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }
        return mysql_real_escape_string($str);
}

function encryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}

function decryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );
}

function processLogin(){

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
	$query .=" WHERE username = '$userlogin' AND password = md5('$userpassword')";

	$result = $user_connect->query($query) or die (mysqli_error());

	if($result->num_rows == 1){
	

		$row = $result->fetch_assoc();
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['username'] = $row['username'];
		$_SESSION['user_fname'] = $row['user_fname'];
		$_SESSION['user_mname'] = $row['user_mname'];
		$_SESSION['user_lname'] = $row['user_lname'];
		$_SESSION['user_categ'] = $row['category'];
		
		header("Location:../index.php");
		exit;

		$user_connect->close();
	}else {
		$_SESSION['error']  = error_message;
		header("Location:../auth/login.php");
		exit;
	}

}

<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../../core/config.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->user_id) && !empty($data->user_id) ){
	
	$user_id = $mysqli_connect->real_escape_string($data->user_id);
	$barcode = $mysqli_connect->real_escape_string($data->barcode);
	$str = explode('-',$barcode);
    $ticket_id = $str[0]*1;
    $ticket_number = $str[1]*1;

	$date = getCurrentDate();

	$sql = $mysqli_connect->query("UPDATE tbl_parkings set user_id='$user_id' where user_id='0' and ticket_id='$ticket_id' and ticket_number='$ticket_number' ") or die(mysqli_error());

	if($sql){
		echo 1;
	}else{
		echo 0;
	}
	
}

?>
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../../core/config.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->pr_id) && $data->pr_id > 0){
	$pr_id = $mysqli_connect->real_escape_string($data->pr_id);
	$date = getCurrentDate();

	$sql = $mysqli_connect->query("UPDATE `tbl_purchase_request_header` SET pr_status = 'P' WHERE pr_id = '$pr_id'");
    if ($sql) {
        echo 1;

        // SEND SMS AND EMAIL NOTIFY BAC

        /*$email_message = include '../../print/forms/purchase_request_email.php';

        $fetch_bac = $mysqli_connect->query("SELECT * FROM tbl_users WHERE user_category = 'BAC'") or die(mysqli_error());
        while ($row = $fetch_bac->fetch_array()) {
            $message = "New PR No. " . getPRNum($pr_id);
            sendSms($row['user_contact_no'], $message);
            sendEmail($email_message, "New Purchase Request", $row['user_email']);
        }*/

    }else{
    	echo 0;
    }

}

?>
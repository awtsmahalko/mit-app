<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../../core/config.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->pr_id) && $data->pr_id > 0){
	$pr_id      = $mysqli_connect->real_escape_string($data->pr_id);
    $pr_mode    = $mysqli_connect->real_escape_string($data->pr_mode);
    $pr_expense = $mysqli_connect->real_escape_string($data->pr_expense);

    $pr_suppliers = $data->pr_suppliers;
    $pr_suppliers = str_replace("[","",$pr_suppliers);
    $pr_suppliers = str_replace("]","",$pr_suppliers);
    $imploded_supplier = implode(",", $pr_suppliers);

    $user_id = $mysqli_connect->real_escape_string($data->user_id);

    $sql = $mysqli_connect->query("UPDATE `tbl_purchase_request_header` SET pr_mode = '$pr_mode', pr_expense = '$pr_expense', pr_suppliers = '$imploded_supplier', pr_status = 'A', approved_by = '$user_id' WHERE pr_id = '$pr_id'");

    if ($sql) {
        echo 1;

        /*$email_message = include '../../print/forms/request_for_quotation_email.php';
        $pr_no = getPRNum($pr_id);
        // SEND SMS AND EMAIL NOTIF TO SUPPLIERS
        foreach ($pr_suppliers as $supplier_id) {
            $supplier_contact_no = getSupplierContactNo($supplier_id);
            $supplier_email = getSupplierEmail($supplier_id);

            $message = "New RFQ No. " . $pr_no;
            sendSms($supplier_contact_no, $message);
            $response['email_' . $supplier_id] = sendEmail($email_message, "New Request for Quotation : " . $pr_no, $supplier_email);
        }

        // SEND SMS AND EMAIL NOTIF TO ADAS
        $user_id = getData("user_id", "tbl_purchase_request_header", "pr_id", $pr_id);
        $user_contact_no = getUserContactNo($user_id);
        $user_email = getUserEmail($user_id);

        $message = "Approved PR No. " . $pr_no;
        sendSms($user_contact_no, $message);

        $email_message = include '../print/forms/purchase_request_email.php';
        sendEmail($email_message, $message, $user_email);*/
    }else{
        echo 0;
    }

}

?>
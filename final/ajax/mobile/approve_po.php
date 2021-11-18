<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../../core/config.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->po_id) && $data->po_id > 0){
	$po_id      = $mysqli_connect->real_escape_string($data->po_id);
    $user_id = $mysqli_connect->real_escape_string($data->user_id);

    // pc = per dept
    // io = any

    // get user details
    $fetch_user = $mysqli_connect->query("SELECT user_category, pc_designation from tbl_users where user_id='$user_id' ");
    $user_row = $fetch_user->fetch_array();

    // get po details
    $fetch_po = $mysqli_connect->query("SELECT po_id, pr_id, io_id, pc_id from tbl_purchase_order_header where po_id='$po_id' ");
    $po_row = $fetch_po->fetch_array();

    // get pr details
    $fetch_pr = $mysqli_connect->query("SELECT pr_department from tbl_purchase_request_header where pr_id='$po_row[pr_id]' ");
    $pr_row = $fetch_pr->fetch_array();

    if($user_row['user_category'] == 'PC'){

        if($po_row['pc_id'] > 0){
            echo "No updated data. This purchase order is already approved.";
        }else if($user_row['pc_designation'] != $pr_row['pr_department']){
            echo "You don't have privilege to approve purchase order of other department.";
        }else{
            $sql = $mysqli_connect->query("UPDATE `tbl_purchase_order_header` SET `pc_id` = '$user_id' WHERE po_id = '$po_id'");
            if($sql){
                echo 1;
            }else{
                echo "Error in executing query.";
            }
        }
        
    }else if($user_row['user_category'] == 'IO'){
        if($po_row['io_id'] > 0){
            echo "No updated data. This purchase order is already approved.";
        }else{
            $sql = $mysqli_connect->query("UPDATE `tbl_purchase_order_header` SET `io_id` = '$user_id' WHERE po_id = '$po_id'");
            if($sql){
                echo 1;
            }else{
                echo "Error in executing query.";
            }
        }
        
    }else{
        echo "You don't have privilege to approve purchase order.";
    }

}

?>
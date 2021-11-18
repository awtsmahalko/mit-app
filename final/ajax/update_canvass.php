<?php
require_once '../core/config.php';

if (isset($_POST['hidden_id'])) {
    $tbl_header = "tbl_canvass_header";
    $tbl_detail = "tbl_canvass_details";
    $tbl_pr_det = "tbl_purchase_request_details";
    $tbl_pr_hd  = "tbl_purchase_request_header";
    $tbl_assign = "tbl_canvass_suppliers";
    $canvass_id = $_POST['hidden_id'];
    $module     = $mysqli_connect->real_escape_string($_POST['module']);
    $date       = getCurrentDate();

    $response['data'] = 0;
    $response['module'] = $module;
    if ($module == 'add') {
        $pr_id          = $_POST['pr_id'];
        $canvass_date   = date("Y-m-d", strtotime($mysqli_connect->real_escape_string($_POST['canvass_date'])));
        $supplier_ids   = $_POST['supplier_id'];
        $user_id        = $_SESSION['user_id'];
        $canvass_status = 'S';

        $fetch_rows = $mysqli_connect->query("SELECT count(pr_id) from $tbl_header where pr_id='$pr_id'") or die($mysqli_connect->error);
        $count_rows = $fetch_rows->fetch_array();

        if ($count_rows[0] > 0) {
            $response['data'] = 2;
        } else {
            $sql = $mysqli_connect->query("INSERT INTO `$tbl_header`(`pr_id`, `canvass_date`, `user_id`, `canvass_status`, `date_modified`) VALUES ('$pr_id','$canvass_date','$user_id', '$canvass_status', '$date')");

            if ($sql) {
                $canvass_id         = $mysqli_connect->insert_id;
                $response['data']   = 1;
                $response['id']     = $canvass_id;

                // START ADD ASSIGN SUPPLIER TO CANVASS
                if (count($supplier_ids) > 0) {
                    foreach ($supplier_ids as $supplier_id) {
                        $mysqli_connect->query("INSERT INTO `$tbl_assign`(`canvass_id`, `supplier_id`) VALUES ('$canvass_id','$supplier_id')");
                    }
                }
                //END ADD ASSIGN SUPPLIER TO CANVASS
            }
        }
    } else if ($module == 'fetch-canvass') {

        $fetch = $mysqli_connect->query("SELECT item_id,packaging_id,qty,h.pr_id,canvass_status from $tbl_pr_det AS d,$tbl_header AS h WHERE h.pr_id = d.pr_id AND h.canvass_id = '$canvass_id'") or die($mysqli_connect->error);
        $response['item'] = array();
        while ($row = $fetch->fetch_array()) {
            $list = array();

            $list['id'] = $row['item_id'];
            $list['name'] = getData("item_name", "tbl_items", "item_id", $row['item_id']);
            $list['qty'] = $row['qty'];
            $list['packaging_id'] = $row['packaging_id'];
            $list['unit'] = getData("packaging_name", "tbl_packaging", "packaging_id", $row['packaging_id']);

            $pr_id = $row['pr_id'];
            $canvass_status = $row['canvass_status'];
            array_push($response['item'], $list);
        }
        $response['costs'] = array();


        $sql_with_data = "SELECT supplier_id,SUM(qty * cost) AS amt FROM `tbl_canvass_details` WHERE canvass_id = '$canvass_id' GROUP BY supplier_id ORDER BY amt ASC";
        $sql_no_data = "SELECT supplier_id from tbl_canvass_suppliers WHERE canvass_id = '$canvass_id'";

        $query_sup = $canvass_status == 'F' ? $sql_with_data : $sql_no_data;
        $fetch = $mysqli_connect->query($query_sup) or die($mysqli_connect->error);
        $response['supplier'] = array();
        while ($row = $fetch->fetch_array()) {
            $list = array();

            $list['id'] = $row['supplier_id'];
            $list['name'] = getSupplier($row['supplier_id']); //$row['supplier_name'];

            array_push($response['supplier'], $list);
        }

        if ($canvass_status == 'F') {
            $fetch = $mysqli_connect->query("SELECT * from $tbl_detail WHERE canvass_id = '$canvass_id' ORDER BY item_id,packaging_id,supplier_id ASC") or die($mysqli_connect->error);
            while ($row = $fetch->fetch_array()) {
                $response['costs'][$row['item_id']][$row['packaging_id']][$row['supplier_id']] = $row['cost'];
            }
        }
        $response['canvass_status'] = $canvass_status;
        $response['pr_no'] = getData("pr_no", "tbl_purchase_request_header", "pr_id", $pr_id);
    } else if ($module == 'save-canvass') {
        $costs = $_POST['costs'];
        $pr_id = getData("pr_id", "tbl_canvass_header", "canvass_id", $canvass_id);
        foreach ($costs as $item_id => $pkgs) {
            foreach ($pkgs as $packaging_id => $suppliers) {
                foreach ($suppliers as $supplier_id => $cost) {
                    $qty = getPrQty($pr_id, $item_id, $packaging_id);
                    $mysqli_connect->query("INSERT INTO `$tbl_detail`(`canvass_id`, `supplier_id`, `item_id`, `packaging_id`, `qty`, `cost`) VALUES ('$canvass_id','$supplier_id','$item_id','$packaging_id','$qty','$cost')");
                }
            }
        }
        $sql = $mysqli_connect->query("UPDATE $tbl_header SET canvass_status = 'F' WHERE canvass_id = '$canvass_id'");
        if ($sql) {
            $response['data'] = 1;

            // SMS AND EMAIL NOTIF TO BAC
            $pr_no_ = getPRNum($pr_id);
            $message_email = include '../print/forms/bac_resolution_2_email.php';

            $fetch_bac = $mysqli_connect->query("SELECT * FROM tbl_users WHERE user_category = 'BAC'") or die($mysqli_connect->error);
            while ($row = $fetch_bac->fetch_array()) {
                $message_sms = "Abstract of Canvass of PR No. $pr_no_ is ready";
                sendSms($row['user_contact_no'], $message_sms);
                $response[$row['user_id']] = sendEmail($message_email, "AOC of PR No. $pr_no_", $row['user_email']);
            }
        }
    } else {
    }
    echo json_encode($response);
    $mysqli_connect->close();
}

function getPrQty($pr_id, $item_id, $packaging_id)
{
    global $mysqli_connect;

    $fetch_rows = $mysqli_connect->query("SELECT qty from tbl_purchase_request_details where pr_id='$pr_id' AND item_id = '$item_id' AND packaging_id = '$packaging_id'") or die($mysqli_connect->error);
    $count_rows = $fetch_rows->fetch_array();
    return $count_rows['qty'];
}

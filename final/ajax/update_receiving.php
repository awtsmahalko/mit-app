<?php
require_once '../core/config.php';

if (isset($_POST['hidden_id'])) {
    $user_id = $_SESSION['user_id'];
    $rr_id = $_POST['hidden_id'];
    $module = $mysqli_connect->real_escape_string($_POST['module']);
    $date = getCurrentDate();

    $response['module'] = $module;
    if ($module == 'fetch-po') {
        $po_id = $_POST['po_id'];
        $table = $rr_id > 0  ? "tbl_receiving_details" : "tbl_purchase_order_details";
        $param = $rr_id > 0  ? "rr_id = '$rr_id'" : "po_id = '$po_id' AND serve_status = 0";

        $fetch = $mysqli_connect->query("SELECT * from $table WHERE $param") or die($mysqli_connect->error);
        $response['item'] = array();
        while ($row = $fetch->fetch_array()) {
            $list = array();

            $list['id']             = $row['item_id'];
            $list['name']           = getData("item_name", "tbl_items", "item_id", $row['item_id']);
            $list['orig_qty']       = $rr_id > 0 ? $row['orig_qty'] : $row['qty'];
            $list['qty']            = $row['qty'];
            $list['cost']           = $row['cost'];
            $list['packaging_id']   = $row['packaging_id'];
            $list['unit']           = getData("packaging_name", "tbl_packaging", "packaging_id", $row['packaging_id']);
            if ($rr_id == 0) {
                $list['remain_qty'] = $row['qty'] - getReceived($po_id, $row['item_id'], $row['packaging_id']);
            }
            array_push($response['item'], $list);
        }
    } else if ($module == 'fetch-rr-data') {
        $fetch = $mysqli_connect->query("SELECT * from tbl_receiving_header WHERE rr_id = '$rr_id'") or die($mysqli_connect->error);
        $row = $fetch->fetch_array();

        $supplier_id            = getData("supplier_id", "tbl_purchase_order_header", "pr_id", $row['pr_id']);
        $response['pr_no']      = getData("pr_no", "tbl_purchase_request_header", "pr_id", $row['pr_id']);
        $response['date']       = date("M d, Y", strtotime($row['rr_date']));
        $response['invoice']    = $row['rr_invoice'];
        $response['invoice_d']  = date("M d, Y", strtotime($row['rr_invoice_date']));
        $response['supplier']   = getData("supplier_name", "tbl_suppliers", "supplier_id", $supplier_id);
        $response['encoder']    = strtoupper(getUser($row['user_id']));
        $response['status']     = $row['rr_status'] == 'FS' ? "FULLY SERVED" : "PARTIAL";
    } else if ($module == 'save-rr') {
        $po_id              = $_POST['po_id'];
        $rr_date            = $_POST['rr_date'];
        $rr_invoice         = $_POST['rr_invoice'];
        $rr_invoice_date    = $_POST['rr_invoice_date'];
        $rrqty              = $_POST['rr_qty'];
        $origqty            = $_POST['orig_qty'];
        $remainqty          = $_POST['remain_qty'];
        $costs              = $_POST['costs'];

        $pr_id = getData("pr_id", "tbl_purchase_order_header", "po_id", $po_id);

        $sql = $mysqli_connect->query("INSERT INTO tbl_receiving_header (`po_id`,`pr_id`,`rr_date`,`rr_invoice`,`rr_invoice_date`,`user_id`,`date_modified`) VALUES ('$po_id','$pr_id','$rr_date','$rr_invoice','$rr_invoice_date','$user_id','$date')");
        $rr_id = $mysqli_connect->insert_id;
        if ($sql) {
            $response['data'] = 1;
            $status_update = 0;
            $rr_status = 0;
            foreach ($rrqty as $item_id => $loop_pkg) {
                foreach ($loop_pkg as $packaging_id => $rr_qty) {
                    $orig_qty   = $origqty[$item_id][$packaging_id];
                    $remain_qty = $remainqty[$item_id][$packaging_id];
                    $cost       = $costs[$item_id][$packaging_id];

                    $rr_qty == $remain_qty ? updatePoDetail($po_id, $item_id, $packaging_id) : $status_update++;
                    ($rr_qty != $remain_qty || $orig_qty != $remain_qty) ? $rr_status++ : '';
                    $mysqli_connect->query("INSERT INTO tbl_receiving_details (`rr_id`,`item_id`,`packaging_id`,`orig_qty`, `qty`,`cost`) VALUES ('$rr_id','$item_id','$packaging_id','$orig_qty','$rr_qty','$cost')");
                }
            }
            updatePoStatus($po_id, $status_update);
            updateRRStatus($rr_id, $rr_status);
        }
    } else {
    }
    echo json_encode($response);
    $mysqli_connect->close();
}


function getReceived($po_id, $item_id, $packaging_id)
{
    global $mysqli_connect;
    $fetch_rr = $mysqli_connect->query("SELECT SUM(qty) FROM tbl_receiving_header AS h, tbl_receiving_details AS d WHERE h.rr_id = d.rr_id AND po_id = '$po_id' AND item_id = '$item_id' AND packaging_id = '$packaging_id'") or die($mysqli_connect->error);
    $row_rr = $fetch_rr->fetch_array();
    return $row_rr[0];
}

function updatePoDetail($po_id, $item_id, $packaging_id)
{
    global $mysqli_connect;
    $mysqli_connect->query("UPDATE tbl_purchase_order_details SET serve_status = 1 WHERE po_id = '$po_id' AND item_id = '$item_id' AND packaging_id = '$packaging_id'") or die($mysqli_connect->error);
}
function updatePoStatus($po_id, $me)
{
    global $mysqli_connect;
    $po_status = $me > 0 ? "P" : "FS";
    $mysqli_connect->query("UPDATE tbl_purchase_order_header SET po_status = '$po_status' WHERE po_id = '$po_id'") or die($mysqli_connect->error);
}
function updateRRStatus($rr_id, $me)
{
    global $mysqli_connect;
    $rr_status = $me > 0 ? "F" : "FS";
    $mysqli_connect->query("UPDATE tbl_receiving_header SET rr_status = '$rr_status' WHERE rr_id = '$rr_id'") or die($mysqli_connect->error);
}

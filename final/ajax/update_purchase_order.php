<?php
require_once '../core/config.php';

if (isset($_POST['hidden_id'])) {
    $po_id = $_POST['hidden_id'];
    $user_id = $_SESSION['user_id'];
    $module = $mysqli_connect->real_escape_string($_POST['module']);
    $date = getCurrentDate();

    $response['module'] = $module;
    if ($module == 'fetch-supplier') {
        $canvass_id = $_POST['canvass_id'];

        $fetch_rows = $mysqli_connect->query("SELECT supplier_id,SUM(qty * cost) AS amt FROM `tbl_canvass_details` WHERE canvass_id = '$canvass_id' GROUP BY supplier_id ORDER BY amt ASC") or die($mysqli_connect->error);

        $options = "";
        while ($row = $fetch_rows->fetch_array()) {
            $options .= "<option value='$row[supplier_id]'> " . getData('supplier_name', 'tbl_suppliers', 'supplier_id', $row['supplier_id']) . " " . number_format($row['amt'], 2) . "</option>";
        }
        $response['options'] = $options;
    } else if ($module == 'fetch-po-data') {
        $status = array(
            'FS' => "FULLY SERVED",
            'P' => "PARTIAL",
            "S" => "SAVED"
        );

        $fetch = $mysqli_connect->query("SELECT * from tbl_purchase_order_header WHERE po_id = '$po_id'") or die($mysqli_connect->error);
        $row = $fetch->fetch_array();

        $response['pr_no']      = getData("pr_no", "tbl_purchase_request_header", "pr_id", $row['pr_id']);
        $response['date']       = date("M d, Y", strtotime($row['po_date']));
        $response['supplier']   = getData("supplier_name", "tbl_suppliers", "supplier_id", $row['supplier_id']);
        $response['encoder']    = strtoupper(getUser($row['user_id']));
        $response['status']     = $status[$row['po_status']];
        $response['po_status']  = $row['po_status'];
        $response['io_id']      = $row['io_id'];
        $response['pc_id']      = $row['pc_id'];
    } else if ($module == 'dt-canvass') {
        $canvass_id = $_POST['canvass_id'];
        $supplier_id = $_POST['supplier_id'];

        $table = $po_id > 0 ? "tbl_purchase_order_details" : "tbl_canvass_details";
        $param = $po_id > 0 ? "po_id = '$po_id'" : "canvass_id = '$canvass_id' AND supplier_id = '$supplier_id'";
        $fetch = $mysqli_connect->query("SELECT * from $table WHERE $param") or die($mysqli_connect->error);
        $response['data'] = array();
        $count = 1;
        while ($row = $fetch->fetch_array()) {
            $list = array();
            $list['count'] = $count++;
            $list['item'] = getData("item_name", "tbl_items", "item_id", $row['item_id']);
            $list['unit'] = getData("packaging_name", "tbl_packaging", "packaging_id", $row['packaging_id']);
            $list['qty'] = $row['qty'];
            $list['cost'] = $row['cost'];
            $list['amount'] = $row['qty'] * $row['cost'];

            array_push($response['data'], $list);
        }
    } else if ($module == 'save-po') {
        $canvass_id = $_POST['canvass_id'];
        $po_date = $_POST['po_date'];
        $supplier_id = $_POST['supplier_id'];
        $pr_id = getData("pr_id", "tbl_canvass_header", "canvass_id", $canvass_id);
        $fetch = $mysqli_connect->query("SELECT COUNT(po_id) from tbl_purchase_order_header WHERE canvass_id = '$canvass_id'") or die($mysqli_connect->error);
        $count = $fetch->fetch_array();
        $po_status = "S";
        if ($count[0] > 0) {
            $response['data'] = 2;
        } else {
            $sql = $mysqli_connect->query("INSERT INTO `tbl_purchase_order_header` (`pr_id`, `canvass_id`, `po_date`, `supplier_id`, `date_modified`, `po_status`, `user_id`) VALUES ('$pr_id', '$canvass_id', '$po_date', '$supplier_id', '$date', '$po_status', '$user_id')");
            $po_id = $mysqli_connect->insert_id;
            if ($sql) {
                $response['data'] = 1;
                $mysqli_connect->query("INSERT INTO tbl_purchase_order_details (po_id,item_id,packaging_id,qty,cost) SELECT $po_id AS po_id, item_id,packaging_id,qty,cost FROM tbl_canvass_details WHERE canvass_id = '$canvass_id' AND supplier_id = '$supplier_id'");
            }
        }
        $response['po_date'] = $_POST['po_date'];
        $response['canvass_id'] = $_POST['canvass_id'];
        $response['supplier_id'] = $_POST['supplier_id'];
    } else if ($module == 'inspect-po') {
        $sql = $mysqli_connect->query("UPDATE `tbl_purchase_order_header` SET `io_id` = '$user_id',`date_inspected` = '$date' WHERE po_id = '$po_id'");
        if ($sql) {
            $response['data'] = 1;
        }
    } else if ($module == 'accept-po') {
        $sql = $mysqli_connect->query("UPDATE `tbl_purchase_order_header` SET `pc_id` = '$user_id',`date_received` = '$date' WHERE po_id = '$po_id'");
        if ($sql) {
            $response['data'] = 1;
        }
    } else {
    }
    echo json_encode($response);
}

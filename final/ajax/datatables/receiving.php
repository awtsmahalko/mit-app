<?php
require_once '../../core/config.php';

$fetch = $mysqli_connect->query("SELECT * from tbl_receiving_header ORDER BY date_modified ASC") or die($mysqli_connect->error);

$response['data'] = array();

while ($row = $fetch->fetch_array()) {
    $list = array();

    $supplier_id = getData("supplier_id", "tbl_purchase_order_header", "po_id", $row['po_id']);
    $list['id'] = $row['rr_id'];
    $list['pr_no'] = getData("pr_no", "tbl_purchase_request_header", "pr_id", $row['pr_id']);
    $list['supplier'] = getData("supplier_name", "tbl_suppliers", "supplier_id", $supplier_id);

    $amount = getData("SUM(qty*cost)", "tbl_receiving_details", "rr_id", $row['rr_id']);

    $list['amount'] = number_format($amount, 2);
    $list['rr_status'] = $row['rr_status'];
    $list['invoice'] = $row['rr_invoice'];
    $list['by'] = getUser($row['user_id']);
    $list['status'] = $row['rr_status'] == 'S' ? 'Saved' : ($row['rr_status'] == 'FS' ? "Fully Served" : "Partial");
    $list['rr_date'] = date('M d, Y', strtotime($row['rr_date']));
    $list['rr_invoice_date'] = date('M d, Y', strtotime($row['rr_invoice_date']));
    $list['date_modified'] = date('M d, Y h:i A', strtotime($row['date_modified']));

    array_push($response['data'], $list);
}

echo json_encode($response);

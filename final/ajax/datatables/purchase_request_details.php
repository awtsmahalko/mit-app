<?php
require_once '../../core/config.php';
$pr_id = $_REQUEST['id'];
$fetch = $mysqli_connect->query("SELECT * from tbl_purchase_request_details WHERE pr_id = '$pr_id'") or die($mysqli_connect->error);

$response['data'] = array();

while ($row = $fetch->fetch_array()) {
    $list = array();

    $list['id'] = $row['pr_detail_id'];
    $list['pr_id'] = $row['pr_id'];
    $list['unit'] = getData("packaging_name", "tbl_packaging", "packaging_id", $row['packaging_id']);
    $list['item'] = getData("item_name", "tbl_items", "item_id", $row['item_id']);
    $list['qty'] = $row['qty'];
    $list['cost'] = $row['cost'];
    $list['amount'] = $row['qty'] * $row['cost'];

    array_push($response['data'], $list);
}

echo json_encode($response);

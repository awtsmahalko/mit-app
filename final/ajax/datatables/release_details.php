<?php
require_once '../../core/config.php';
$release_id = $_REQUEST['id'];
$fetch = $mysqli_connect->query("SELECT * from tbl_release_details WHERE release_id = '$release_id'") or die($mysqli_connect->error);

$response['data'] = array();

while ($row = $fetch->fetch_array()) {
    $list = array();

    $list['id'] = $row['release_detail_id'];
    $list['unit'] = getData("packaging_name", "tbl_packaging", "packaging_id", $row['packaging_id']);
    $list['item'] = getData("item_name", "tbl_items", "item_id", $row['item_id']);
    $list['qty'] = $row['qty'];

    array_push($response['data'], $list);
}

echo json_encode($response);

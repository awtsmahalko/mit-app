<?php
require_once '../core/config.php';

$response['categories'] = array();
$response['series'] = array();

$inventory_date = date("Y-m-d");
$department = $_REQUEST['department'];

$fetch = $mysqli_connect->query("SELECT i.item_id,item_name,p.packaging_id, packaging_name from tbl_items AS i, tbl_items_packaging AS ip,tbl_packaging AS p WHERE ip.item_id = i.item_id AND ip.packaging_id = p.packaging_id ORDER BY item_name ASC") or die($mysqli_connect->error);

$purchased = array();
$released = array();
$inventory = array();
while ($row = $fetch->fetch_array()) {
    $response['categories'][] = "$row[item_name] <br>($row[packaging_name])";

    $in = getInventoryIn($row['item_id'], $row['packaging_id'], $inventory_date, $department);
    $out = getInventoryOut($row['item_id'], $row['packaging_id'], $inventory_date, $department);
    $purchased[] = $in;
    $released[] = $out;
    $inventory[] = $in - $out;
}

// PURCHASE SERIES
$purchased_series['name'] = "Purchased";
$purchased_series['data'] = $purchased;
array_push($response['series'], $purchased_series);


// RELEASED SERIES
$released_series['name'] = "Released";
$released_series['data'] = $released;
array_push($response['series'], $released_series);


// INVENTORY SERIES
$inventory_series['name'] = "Inventory";
$inventory_series['data'] = $inventory;
array_push($response['series'], $inventory_series);


echo json_encode($response);

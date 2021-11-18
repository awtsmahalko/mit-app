<?php
require_once '../../core/config.php';

$fetch = $mysqli_connect->query("SELECT * from tbl_canvass_header ORDER BY date_modified ASC") or die(mysqli_error());

$response['data'] = array();

while ($row = $fetch->fetch_array()) {
    $list = array();

    $list['id'] = $row['canvass_id'];
    $list['canvass_status'] = $row['canvass_status'];
    $list['pr_no'] = getData("pr_no", "tbl_purchase_request_header", "pr_id", $row['pr_id']);
    $list['dates'] = $row['canvass_date'] == '1970-01-01'?"":$row['canvass_date'];
    $list['supplier'] = fetchAssignSupplier($row['canvass_id']);
    $list['by'] = getUser($row['user_id']);
    $list['status'] = $row['canvass_status'] == 'S' ? "<span class='badge badge-danger'>Saved</span>" : "<span class='badge badge-success'>Finished</span>";
    $list['date_modified'] = date('M d, Y h:i A', strtotime($row['date_modified']));

    array_push($response['data'], $list);
}

echo json_encode($response);

function fetchAssignSupplier($canvass_id)
{
    global $mysqli_connect;
    $supplier = array();
    $fetch = $mysqli_connect->query("SELECT supplier_name from tbl_canvass_suppliers AS c,tbl_suppliers AS s where c.supplier_id = s.supplier_id AND c.canvass_id = '$canvass_id'");
    while ($row = $fetch->fetch_array()) {
        $supplier[] = $row['supplier_name'];
    }

    return "<ul><li>" . implode("</li><li>", $supplier) . "</li></u>";
}

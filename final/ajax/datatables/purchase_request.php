<?php
require_once '../../core/config.php';

$inject = $_SESSION['category'] == 'BAC' ? "WHERE pr_status != 'S'" : "";

$fetch = $mysqli_connect->query("SELECT * from tbl_purchase_request_header $inject ORDER BY date_modified ASC") or die($mysqli_connect->error);

$response['data'] = array();

while ($row = $fetch->fetch_array()) {
    $list = array();

    $list['id'] = $row['pr_id'];
    $list['status'] = $row['pr_status'];
    $list['pr_no'] = $row['pr_no'];
    $list['pr_department'] = $row['pr_department'];
    $list['pr_purpose'] = $row['pr_purpose'];
    $list['pr_status'] = $row['pr_status'] == 'S' ? "<span class='badge badge-danger'>Saved</span>" : ($row['pr_status'] == 'P' ? "<span class='badge badge-info'>Pending</span>" : "<span class='badge badge-success'>Approved</span>");
    $list['pr_date'] = date('M d, Y', strtotime($row['pr_date']));
    $list['date_modified'] = date('M d, Y h:i A', strtotime($row['date_modified']));

    array_push($response['data'], $list);
}

echo json_encode($response);

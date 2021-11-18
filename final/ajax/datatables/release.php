<?php
require_once '../../core/config.php';

$fetch = $mysqli_connect->query("SELECT * from tbl_release_header ORDER BY date_modified ASC") or die(mysqli_error());

$response['data'] = array();

while ($row = $fetch->fetch_array()) {
    $list = array();

    $list['id'] = $row['release_id'];
    $list['release_status'] = $row['release_status'];
    $list['release_no'] = $row['release_no'];
    $list['department'] = $row['department'];
    $list['remarks'] = $row['remarks'];
    $list['release_days_consume'] = $row['release_days_consume'];
    $list['status'] = $row['release_status'] == 'S' ? 'Saved' : "Finished";
    $list['release_date'] = date('M d, Y', strtotime($row['release_date']));
    $list['date_modified'] = date('M d, Y h:i A', strtotime($row['date_modified']));

    array_push($response['data'], $list);
}

echo json_encode($response);

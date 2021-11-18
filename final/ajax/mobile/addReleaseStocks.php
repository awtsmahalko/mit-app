<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../../core/config.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->user_id) && !empty($data->user_id) ){
	$user_id = $mysqli_connect->real_escape_string($data->user_id);
	$department = $mysqli_connect->real_escape_string($data->department);
    $release_date = date("Y-m-d", strtotime($data->release_date));
    $remarks = $mysqli_connect->real_escape_string($data->remarks);
    $release_days_consume = $mysqli_connect->real_escape_string($data->release_days_consume);
    $release_status = 'S';

    $release_year   = date('Y', strtotime($release_date));
    $release_ym     = date('Y-m', strtotime($release_date));
    $fetch_batch    = $mysqli_connect->query("SELECT MAX(release_batch) from tbl_release_header where YEAR(release_date) = '$release_year'") or die($mysqli_connect->error);
    $release_batch_row  = $fetch_batch->fetch_array();
    $release_batch  = $release_batch_row[0] + 1;

    $release_no = $release_ym . "-" . sprintf("%03d", $release_batch) . "-" . $department . "-ISSUE";

    $fetch_rows = $mysqli_connect->query("SELECT count(release_id) from tbl_release_header where release_no='$release_no'") or die($mysqli_connect->error);
    $count_rows = $fetch_rows->fetch_array();
    if ($count_rows[0] > 0) {
        $response['data'] = 2;
    } else {
        $sql = $mysqli_connect->query("INSERT INTO `tbl_release_header`(`release_batch`, `release_no`, `department`, `release_date`, `remarks`, `release_status`,`release_days_consume`, `user_id`, `date_modified`) VALUES ('$release_batch','$release_no','$department', '$release_date', '$remarks', '$release_status','$release_days_consume', '$user_id', '$date')");

        if ($sql) {
            $response['data'] = 1;
            $response['id'] = $mysqli_connect->insert_id;
            $response['release_no'] = $release_no;
            $response['release_date'] = $release_date;
            $response['release_days_consume'] = $release_days_consume;
            $response['release_status'] = $release_status;
        }
    }

    echo json_encode($response);
	
}

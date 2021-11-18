<?php
require_once '../core/config.php';

$yearly_pr = $_REQUEST['yearly_pr'];
$current_year = date("Y");
$past_year = $current_year - 3;

$response['series'] = array();
$response['categories'] = array();

$past = array();

for ($year = $past_year; $year <= $current_year; $year++) {
    $response['categories'][] = (string) $year;
    $past[] = periodCastingPast($year, $yearly_pr);
}

// PAST SERIES
$past_series['name'] = $yearly_pr == 'P' ? "Purchased" : "Released";
$past_series['data'] = $past;
array_push($response['series'], $past_series);

echo json_encode($response);
function periodCastingPast($year, $yearly_pr)
{
    global $mysqli_connect;

    if ($yearly_pr == 'P') {
        $fetch_past = $mysqli_connect->query("SELECT SUM(pod.qty * pod.cost) FROM tbl_purchase_request_header AS pr,tbl_purchase_order_header AS poh,tbl_purchase_order_details AS pod WHERE pr.pr_id = poh.pr_id AND poh.po_id = pod.po_id AND pod.serve_status = '1' AND pr.pr_year = '$year'") or die($mysqli_connect->error);
        $row_past = $fetch_past->fetch_array();
        return $row_past[0] * 1;
    } else {
        $fetch_past = $mysqli_connect->query("SELECT SUM(rd.qty * rd.cost) FROM tbl_release_header AS rh,tbl_release_details AS rd WHERE rh.release_id = rd.release_id AND YEAR(release_date) = '$year'") or die($mysqli_connect->error);

        $row_past = $fetch_past->fetch_array();
        return $row_past[0] * 1;
    }
}

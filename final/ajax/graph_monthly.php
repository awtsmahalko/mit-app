<?php
require_once '../core/config.php';

$monthly_pr = $_REQUEST['monthly_pr'];
$current_year = date("Y");
$past_year = $current_year - 3;


$response['series'] = array();

$past = array();
$current = array();

for ($i = 1; $i < 13; $i++) {
    $past[] = periodCastingPast($i, $current_year, $past_year, $monthly_pr);
    $current[] = periodCastingCurrent($i, $current_year, $monthly_pr);
}

// PAST SERIES
$past_series['name'] = "Past 3 years";
$past_series['data'] = $past;
array_push($response['series'], $past_series);


// CURRENT SERIES
$current_series['name'] = "Current Year";
$current_series['data'] = $current;
array_push($response['series'], $current_series);

echo json_encode($response);
function periodCastingPast($i, $current_year, $past_year, $monthly_pr)
{
    global $mysqli_connect;
    if ($monthly_pr == 'P') {
        $fetch_past = $mysqli_connect->query("SELECT SUM(pod.qty * pod.cost) FROM tbl_purchase_request_header AS pr,tbl_purchase_order_header AS poh,tbl_purchase_order_details AS pod WHERE pr.pr_id = poh.pr_id AND poh.po_id = pod.po_id AND pod.serve_status = '1' AND pr.pr_mo = '$i' AND pr.pr_year < '$current_year' AND pr.pr_year >= '$past_year' GROUP BY pr_year") or die($mysqli_connect->error);

        $amount = array();
        while ($row_past = $fetch_past->fetch_array()) {
            $amount[] = $row_past[0] * 1;
        }

        $amount = array_filter($amount);
        if (count($amount)) {
            return array_sum($amount) / count($amount);
        } else {
            return 0;
        }
    } else {
        $fetch_past = $mysqli_connect->query("SELECT SUM(rd.qty * rd.cost) FROM tbl_release_header AS rh,tbl_release_details AS rd WHERE rh.release_id = rd.release_id AND MONTH(release_date) = '$i' AND YEAR(release_date) >= '$past_year' AND YEAR(release_date) < '$current_year' GROUP BY YEAR(release_date)") or die($mysqli_connect->error);

        $amount = array();
        while ($row_past = $fetch_past->fetch_array()) {
            $amount[] = $row_past[0] * 1;
        }

        $amount = array_filter($amount);
        if (count($amount)) {
            return array_sum($amount) / count($amount);
        } else {
            return 0;
        }
    }
}

function periodCastingCurrent($i, $current_year, $monthly_pr)
{
    global $mysqli_connect;
    if ($monthly_pr == 'P') {
        $fetch_current = $mysqli_connect->query("SELECT SUM(pod.qty * pod.cost) FROM tbl_purchase_request_header AS pr,tbl_purchase_order_header AS poh,tbl_purchase_order_details AS pod WHERE pr.pr_id = poh.pr_id AND poh.po_id = pod.po_id AND pod.serve_status = '1' AND pr.pr_mo = '$i' AND pr.pr_year = '$current_year'") or die($mysqli_connect->error);
        $row_current = $fetch_current->fetch_array();
        return $row_current[0] * 1;
    } else {
        $fetch_current = $mysqli_connect->query("SELECT SUM(rd.qty * rd.cost) FROM tbl_release_header AS rh,tbl_release_details AS rd WHERE rh.release_id = rd.release_id AND MONTH(release_date) = '$i' AND YEAR(release_date) = '$current_year'") or die($mysqli_connect->error);
        $row_current = $fetch_current->fetch_array();
        return $row_current[0] * 1;
    }
}

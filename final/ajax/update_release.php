<?php
require_once '../core/config.php';

if (isset($_POST['hidden_id'])) {
    $release_id = $_POST['hidden_id'];
    $module     = $_POST['module'];
    $date       = getCurrentDate();
    $user_id    = $_SESSION['user_id'];

    $response['data'] = 0;
    $response['module'] = $module;
    if ($module == 'save-header') {
        $department = $mysqli_connect->real_escape_string($_POST['department']);
        $release_date = date("Y-m-d", strtotime($_POST['release_date']));
        $remarks = $mysqli_connect->real_escape_string($_POST['remarks']);
        $release_days_consume = $mysqli_connect->real_escape_string($_POST['release_days_consume']);
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
            }
        }
    } else if ($module == 'add-detail') {
        $item_pack = explode("-", $_POST['item_id']);
        $item_id = $item_pack[0];
        $packaging_id = $item_pack[1];
        $qty = $_POST['qty'];
        if ($qty > 0) {
            $cost = getAverageCost($item_id, $packaging_id);



            $fetch_rows = $mysqli_connect->query("SELECT count(release_id) from tbl_release_details where release_id='$release_id' AND item_id = '$item_id' AND packaging_id = '$packaging_id'") or die($mysqli_connect->error);
            $count_rows = $fetch_rows->fetch_array();
            if ($count_rows[0] > 0) {
                $response['data'] = 2;
            } else {
                $sql = $mysqli_connect->query("INSERT INTO `tbl_release_details`(`release_id`, `item_id`, `packaging_id`, `qty`, `cost`) VALUES ('$release_id', '$item_id', '$packaging_id', '$qty','$cost')");

                if ($sql) {
                    $response['data'] = 1;
                    $response['id'] = $release_id;
                }
            }
        } else {
            $response['data'] = -1;
        }
    } else if ($module == 'finish') {
        $sql = $mysqli_connect->query("UPDATE `tbl_release_header` SET release_status = 'F' WHERE release_id = '$release_id'");
        if ($sql) {
            $response['data'] = 1;
        }
    } else if ($module == 'fetch-qty') {
        $item_pack      = explode("-", $_POST['item_pack']);
        $item_id        = $item_pack[0];
        $packaging_id   = $item_pack[1];
        $inventory_date = date("Y-m-d");
        $department     = $_POST['department'];
        $response['data'] = getInventory($item_id, $packaging_id, $inventory_date, $department);
    } else {
    }

    echo json_encode($response);
}

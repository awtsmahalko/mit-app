<?php
require_once '../../core/config.php';

$fetch = $mysqli_connect->query("SELECT * from tbl_purchase_order_header ORDER BY date_modified ASC") or die($mysqli_connect->error);

$response['data'] = array();

$status = array(
    'FS' => "<span class='badge badge-success'>Fully Served</span>",
    'P' => "<span class='badge badge-warning'>Partial</span>",
    "S" => "<span class='badge badge-danger'>Saved</span>"
);

while ($row = $fetch->fetch_array()) {
    $list = array();

    $list['id'] = $row['po_id'];
    $list['is_iar'] = ($row['io_id'] == 0 || $row['pc_id'] == 0) ? 0 : 1;
    $list['pr_no'] = getPRNum($row['pr_id']);
    $list['supplier'] = getData("supplier_name", "tbl_suppliers", "supplier_id", $row['supplier_id']);
    $list['amount'] = getData("SUM(qty * cost)", "tbl_purchase_order_details", "po_id", $row['po_id']);
    $list['po_status'] = $row['po_status'];
    $list['io_id'] = ioStat($row['po_id'], $row['pr_id'], $row['po_status'], $row['io_id']);
    $list['pc_id'] = pcStat($row['po_id'], $row['po_status'], $row['pc_id'], $row['pr_id']);
    $list['by'] = getUser($row['user_id']);
    $list['status'] = $status[$row['po_status']];
    $list['po_date'] = date('M d, Y', strtotime($row['po_date']));
    $list['date_modified'] = date('M d, Y h:i A', strtotime($row['date_modified']));

    array_push($response['data'], $list);
}

echo json_encode($response);
function ioStat($po_id, $pr_id, $status, $user_id)
{
    if ($status == 'FS') {
        if ($user_id > 0) {
            return "<span class='badge badge-success'>" . getUser($user_id) . "</span>";
        } else {
            $pr_no = getPRNum($pr_id);
            return $_SESSION['category'] == 'IO' ? "<center><button onclick=\"approvePo($po_id,'$pr_no')\" class='btn btn-primary btn-circle btn-sm' onclick=''><span class='fa fa-plus'></span></button></center>" : "-";
        }
    } else {
        return '-';
    }
}
function pcStat($po_id, $status, $user_id, $pr_id)
{
    if ($status == 'FS') {
        if ($user_id > 0) {
            return "<span class='badge badge-success'>" . getUser($user_id) . "</span>";
        } else {
            $dept = getPRDepartment($pr_id);
            $pr_no = getPRNum($pr_id);
            return $dept == $_SESSION['pc_designation'] ? "<center><button onclick=\"acceptPo($po_id,'$pr_no')\" class='btn btn-primary btn-circle btn-sm' onclick=''><span class='fa fa-plus'></span></button></center>" : '';
        }
    } else {
        return '';
    }
}

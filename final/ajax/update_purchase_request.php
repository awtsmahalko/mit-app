<?php
require_once '../core/config.php';

if (isset($_POST['hidden_id'])) {
    $pr_id  = $_POST['hidden_id'];
    $module = $mysqli_connect->real_escape_string($_POST['module']);
    $date   = getCurrentDate();

    $response['data'] = 0;
    $response['module'] = $module;
    if ($module == 'add') {

        $pr_department  = $mysqli_connect->real_escape_string($_POST['pr_department']);
        $pr_date        = date("Y-m-d", strtotime($mysqli_connect->real_escape_string($_POST['pr_date'])));
        $pr_purpose     = $mysqli_connect->real_escape_string($_POST['pr_purpose']);
        $pr_year        = $mysqli_connect->real_escape_string($_POST['pr_year']);
        $pr_mo          = $mysqli_connect->real_escape_string($_POST['pr_mo']);
        $pr_batch       = $mysqli_connect->real_escape_string($_POST['pr_batch']);

        $user_id        = $_SESSION['user_id'];

        $pr_ym          = date('Y-m', strtotime($pr_year . "-" . $pr_mo . "-01"));
        $pr_no          = $pr_ym . "-" . sprintf("%03d", $pr_batch) . "-" . $pr_department;

        $fetch_rows = $mysqli_connect->query("SELECT count(pr_id) from tbl_purchase_request_header where pr_no='$pr_no'") or die($mysqli_connect->error);
        $count_rows = $fetch_rows->fetch_array();

        if ($count_rows[0] > 0) {
            $response['data'] = 2;
        } else {
            $sql = $mysqli_connect->query("INSERT INTO `tbl_purchase_request_header`(`pr_batch`, `pr_year`, `pr_mo`, `pr_no`, `pr_department`, `pr_date`, `pr_purpose`, `user_id`, `date_modified`) VALUES ('$pr_batch','$pr_year','$pr_mo','$pr_no','$pr_department', '$pr_date', '$pr_purpose', '$user_id', '$date')");

            if ($sql) {
                $response['data'] = 1;
                $response['id'] = $mysqli_connect->insert_id;
            }
        }
    } else if ($module == 'approve-pr') {
        $pr_id      = $mysqli_connect->real_escape_string($_POST['pr_id']);
        $pr_mode    = $mysqli_connect->real_escape_string($_POST['pr_mode']);
        $pr_expense = $mysqli_connect->real_escape_string($_POST['pr_expense']);

        $pr_suppliers = $_POST['pr_suppliers'];
        $imploded_supplier = implode(",", $pr_suppliers);

        $user_id = $_SESSION['user_id'];

        $sql = $mysqli_connect->query("UPDATE `tbl_purchase_request_header` SET pr_mode = '$pr_mode', pr_expense = '$pr_expense', pr_suppliers = '$imploded_supplier', pr_status = 'A', approved_by = '$user_id' WHERE pr_id = '$pr_id'");

        if ($sql) {
            $response['data'] = 1;
            $response['id'] = $pr_id;

            $email_message = include '../print/forms/request_for_quotation_email.php';
            $pr_no = getPRNum($pr_id);
            // SEND SMS AND EMAIL NOTIF TO SUPPLIERS
            foreach ($pr_suppliers as $supplier_id) {
                $supplier_contact_no = getSupplierContactNo($supplier_id);
                $supplier_email = getSupplierEmail($supplier_id);

                $message = "New RFQ No. " . $pr_no;
                sendSms($supplier_contact_no, $message);
                $response['email_' . $supplier_id] = sendEmail($email_message, "New Request for Quotation : " . $pr_no, $supplier_email);
            }

            // SEND SMS AND EMAIL NOTIF TO ADAS
            $user_id = getData("user_id", "tbl_purchase_request_header", "pr_id", $pr_id);
            $user_contact_no = getUserContactNo($user_id);
            $user_email = getUserEmail($user_id);

            $message = "Approved PR No. " . $pr_no;
            sendSms($user_contact_no, $message);

            $email_message = include '../print/forms/purchase_request_email.php';
            sendEmail($email_message, $message, $user_email);
        }
    } else if ($module == 'fetch-packaging') {
        $item_id = $_POST['item_id'];
        $fetch = $mysqli_connect->query("SELECT a.packaging_id,packaging_name from tbl_items_packaging AS a,tbl_packaging AS p WHERE a.packaging_id = p.packaging_id AND a.item_id = '$item_id' ORDER BY actual_qty ASC") or die($mysqli_connect->error);
        $data = "<option value=''>&mdash; Select &mdash;</option>";
        while ($row = $fetch->fetch_array()) {
            $data .= '<option value="' . $row['packaging_id'] . '">' . $row['packaging_name'] . '</option>';
        }
        $response['data'] = $data;
    } else if ($module == 'fetch-pending-pr') {
        $fetch = $mysqli_connect->query("SELECT * FROM tbl_purchase_request_header WHERE pr_status = 'P' ORDER BY date_modified DESC") or die($mysqli_connect->error);
        $data = "<option value=''>&mdash; Select &mdash;</option>";
        while ($row = $fetch->fetch_array()) {
            $data .= '<option value="' . $row['pr_id'] . '">' . $row['pr_no'] . '</option>';
        }
        $response['data'] = $data;
    } else if ($module == 'fetch-supplier') {
        if ($pr_id > 0) {
            $pr_suppliers = getData("pr_suppliers", "tbl_purchase_request_header", "pr_id", $pr_id);
            $sup_group = explode(",", $pr_suppliers);
            $data = "";
        } else {
            $sup_group = array();
            $data = "";
        }
        $fetch = $mysqli_connect->query("SELECT * FROM tbl_suppliers ORDER BY supplier_name ASC") or die($mysqli_connect->error);
        while ($row = $fetch->fetch_array()) {
            $selected = in_array($row['supplier_id'], $sup_group) ? "selected" : '';
            $data .= '<option ' . $selected . ' value="' . $row['supplier_id'] . '">' . $row['supplier_name'] . '</option>';
        }
        $response['data'] = $data;
    } else if ($module == 'add-detail') {
        $item_id = $_POST['item_id'];
        $packaging_id = $_POST['packaging_id'];
        $qty = $_POST['qty'];
        $cost = $_POST['cost'];

        $fetch_rows = $mysqli_connect->query("SELECT count(pr_id) from tbl_purchase_request_details where pr_id='$pr_id' AND item_id = '$item_id' AND packaging_id = '$packaging_id'") or die($mysqli_connect->error);
        $count_rows = $fetch_rows->fetch_array();
        if ($count_rows[0] > 0) {
            $response['data'] = 2;
        } else {
            $sql = $mysqli_connect->query("INSERT INTO `tbl_purchase_request_details`(`pr_id`, `item_id`, `packaging_id`, `qty`, `cost`) VALUES ('$pr_id', '$item_id', '$packaging_id', '$qty', '$cost')");

            if ($sql) {
                $response['data'] = 1;
                $response['id'] = $pr_id;
            }
        }
    } else if ($module == 'finish') {
        $sql = $mysqli_connect->query("UPDATE `tbl_purchase_request_header` SET pr_status = 'P' WHERE pr_id = '$pr_id'");
        if ($sql) {
            $response['data'] = 1;

            // SEND SMS AND EMAIL NOTIFY BAC

            $email_message = include '../print/forms/purchase_request_email.php';

            $fetch_bac = $mysqli_connect->query("SELECT * FROM tbl_users WHERE user_category = 'BAC'") or die($mysqli_connect->error);
            while ($row = $fetch_bac->fetch_array()) {
                $message = "New PR No. " . getPRNum($pr_id);
                sendSms($row['user_contact_no'], $message);
                sendEmail($email_message, "New Purchase Request", $row['user_email']);
            }
        }
    } else {
    }
    echo json_encode($response);
    $mysqli_connect->close();
}

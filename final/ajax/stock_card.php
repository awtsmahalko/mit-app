<?php
require_once '../core/config.php';
$item_id = $_POST['item_id'];
$packaging_id = $_POST['packaging_id'];

$fetch_item = $mysqli_connect->query("SELECT * from tbl_items where item_id = '$item_id'") or die($mysqli_connect->error);
$item_row = $fetch_item->fetch_array();


$fetch_det = $mysqli_connect->query("SELECT rr_date AS date,pr_id,qty AS receipt_qty,0 AS issue_qty,'' AS issue_office,'IN' AS module,'' AS consume FROM tbl_receiving_details AS d, tbl_receiving_header AS h WHERE h.rr_id = d.rr_id AND item_id = '$item_id' AND packaging_id = '$packaging_id' UNION ALL SELECT release_date AS date,release_no AS pr_id,0 AS receipt_qty,qty AS issue_qty,department AS issue_office,'OUT' AS module,release_days_consume AS consume from tbl_release_details AS d,tbl_release_header AS h where h.release_id = d.release_id AND item_id = '$item_id' AND packaging_id = '$packaging_id' AND release_status = 'F' ORDER BY date ASC") or die($mysqli_connect->error);
?>
<table style="width:100%;">
    <tr>
        <td colspan="4">&nbsp;</td>
    </tr>
    <tr align="center">
        <td colspan="4" style="font-size: 14pt;"><b>STOCK CARD</b></td>
    </tr>
    <tr>
        <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
        <td>Entity Name</td>
        <td></td>
        <td>Fund Cluster</td>
        <td></td>
    </tr>
    <tr>
        <td colspan="4">&nbsp;</td>
    </tr>
</table>
<table style="width:100%;font-size:12pt;" border="1px solid">
    <tr>
        <td colspan="5">Item: <b><u><i><?= $item_row['item_name'] ?></i></u></b></td>
        <td colspan="2">Stock No. :<b><u><i><?= $item_row['item_serial_no'] ?></i></u></b></td>
    </tr>
    <tr>
        <td colspan="5">Description: <b><u><i><?= $item_row['item_desc'] ?></i></u></b></td>
        <td colspan="2">Re-order Point :</td>
    </tr>
    <tr>
        <td colspan="5">Unit of Measurement: <b><u><i><?= getData("packaging_name", "tbl_packaging", "packaging_id", $packaging_id) ?></i></u></b></td>
        <td colspan="2"></td>
    </tr>
    <tr align="center">
        <td rowspan="2">Date</td>
        <td rowspan="2">Reference</td>
        <td>Receipt</td>
        <td colspan="2">Issue</td>
        <td>Balance</td>
        <td rowspan="2">No. of Days to Consume</td>
    </tr>
    <tr align="center">
        <td>Qty</td>
        <td>Qty</td>
        <td>Office</td>
        <td>Qty</td>
    </tr>
    <?php
    $balance_qty = 0;
    while ($row_det = $fetch_det->fetch_array()) {
        $balance = $row_det['receipt_qty'] - $row_det['issue_qty'];
        $balance_qty += $balance;

        $reference = $row_det['module'] == 'IN' ? getPRNum($row_det['pr_id']) : $row_det['pr_id'];
    ?>
        <tr align="center">
            <td><?= $row_det['date'] ?></td>
            <td><?= $reference ?></td>
            <td><?= $row_det['receipt_qty'] ?></td>
            <td><?= $row_det['issue_qty'] ?></td>
            <td><?= $row_det['issue_office'] ?></td>
            <td><?= number_format($balance_qty, 2) ?></td>
            <td><?= $row_det['consume'] ?></td>
        </tr>
    <?php
    }
    ?>
</table>
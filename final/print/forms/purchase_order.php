<?php
require_once '../../core/config.php';
$po_id = $_REQUEST['po_id'];

$fetch = $mysqli_connect->query("SELECT * from tbl_purchase_order_header WHERE po_id = '$po_id'") or die($mysqli_connect->error);
$po_header = $fetch->fetch_array();

$fetch_supplier = $mysqli_connect->query("SELECT * from tbl_suppliers WHERE supplier_id = '$po_header[supplier_id]'") or die($mysqli_connect->error);
$sup_data = $fetch_supplier->fetch_array();

$fetch_det = $mysqli_connect->query("SELECT * from tbl_purchase_order_details WHERE po_id = '$po_id'") or die($mysqli_connect->error);
$count_details = $fetch_det->num_rows;

?>
<style>
    @font-face {
        font-family: 'Times New Roman';
        src: url("<?= base_url ?>/css/fonts/Times-New-Roman/times-new-roman.ttf");
    }

    @font-face {
        font-family: 'Times New Roman Bold';
        src: url("<?= base_url ?>/css/fonts/Times-New-Roman/times-new-roman-bold.ttf");
    }

    @font-face {
        font-family: 'Arial';
        src: url("<?= base_url ?>/css/fonts/ARIAL.TTF");
    }

    @font-face {
        font-family: 'Arial Bold';
        src: url("<?= base_url ?>/css/fonts/Arial-Bold.ttf");
    }
</style>
<table width="100%" style="font-family: 'Times New Roman Bold', Times, serif;">
    <tr>
        <td align="center" style="font-size: 15pt;font-weight:bold;">&nbsp;</td>
    </tr>
    <tr>
        <td align="center" style="font-size: 14pt;font-weight:bold;">PURCHASE ORDER</td>
    </tr>
    <tr>
        <td align="center" style="font-size: 18pt;font-weight:bold;">DEPARTMENT OF EDUCATION</td>
    </tr>
    <tr>
        <td align="center" style="font-size: 12pt;font-weight:bold;">HIMOGA-AN BAYBAY INTEGRATED SCHOOL</td>
    </tr>
    <tr>
        <td align="center" style="font-size: 15pt;font-weight:bold;">&nbsp;</td>
    </tr>
</table>
<table width="100%" border='1px' style="font-size:11pt;border-collapse:collapse;font-family: 'Times New Roman', Times, serif;">
    <tr style="border-bottom: none;">
        <td style="border-right: unset;">Supplier:</td>
        <td colspan="2" style="border-left: none;font-family: 'Times New Roman Bold'"><b><?= strtoupper($sup_data['supplier_name']) ?></b></td>
        <td style="border-right: unset;">PO No.: </td>
        <td colspan="2" style="border-left: none;font-family: 'Times New Roman Bold'"><u><?= getPRNum($po_header['pr_id']) ?></u></td>
    </tr>
    <tr style="border-bottom: none;">
        <td style="border-right: unset;">Address:</td>
        <td colspan="2" style="border-left: none;font-family: 'Times New Roman Bold'"><b><?= strtoupper($sup_data['supplier_address']) ?></b></td>
        <td style="border-right: unset;">Date: </td>
        <td colspan="2" style="border-left: none;font-family: 'Times New Roman Bold'"><u><?= date('M d, Y', strtotime($po_header['po_date'])) ?></u></td>
    </tr>
    <tr>
        <td style="border-right: unset;">TIN:</td>
        <td colspan="2" style="border-left: none;font-family: 'Times New Roman Bold'"><b><u><?= strtoupper($sup_data['supplier_tin']) ?></u></b></td>
        <td style="border-right: unset;">Mode of Procurement:</td>
        <td colspan="2" style="border-left: none;font-family: 'Times New Roman Bold'"><u><?= getData("pr_mode", "tbl_purchase_request_header", "pr_id", $po_header['pr_id']) ?></u></td>
    </tr>
    <tr style="border-bottom: none;">
        <td colspan="6">Gentlemen:</td>
    </tr>
    <tr style="border-bottom: none;">
        <td colspan="6"> Please furnish this Office the following articles subject to the terms and conditions contained herein:</td>
    </tr>
    <tr>
        <td colspan="6">&nbsp;</td>
    </tr>
    <tr style="border-bottom: none;">
        <td style="border-right: unset;">Place of Delivery:</td>
        <td colspan="2" style="border-left: none;"></td>
        <td style="border-right: unset;">Delivery Term: </td>
        <td colspan="2" style="border-left: none;"></td>
    </tr>
    <tr>
        <td style="border-right: unset;">Date of Delivery:</td>
        <td colspan="2" style="border-left: none;"></td>
        <td style="border-right: unset;">Payment Term:</td>
        <td colspan="2" style="border-left: none;"></td>
    </tr>
    <tr style="text-align:center;font-weight:bold;font-family: 'Times New Roman Bold'">
        <td>Stock / Property No.</td>
        <td>Unit</td>
        <td>Description</td>
        <td>Quantity</td>
        <td>Unit Cost</td>
        <td>Amount</td>
    </tr>
    <?php
    $tr_no = 20;

    $left_tr = $tr_no - $count_details;
    $total_amount = 0;
    while ($row_det = $fetch_det->fetch_array()) {
        $amount = $row_det['qty'] * $row_det['cost'];
        $total_amount += $amount;
    ?>
        <tr style="border-bottom:none;font-family: 'Arial';font-size:9pt;">
            <td></td>
            <td><?= getPackaging($row_det['packaging_id']) ?></td>
            <td style="font-size:10pt;"><?= getItem($row_det['item_id']) ?></td>
            <td align="center"><?= $row_det['qty'] ?></td>
            <td align="right"><?= number_format($row_det['cost'], 2) ?></td>
            <td align="right" style="font-family: 'Arial Bold';"><b><?= number_format($amount, 2) ?></b></td>
        </tr>
    <?php } ?>
    <?php
    for ($i = 0; $i < $left_tr; $i++) {
        echo "<tr style='border-bottom:none;'><td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td></tr>";
    }
    ?>
    <tr style="border-top:unset;">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td align="right" style="font-size: 10pt;">Total</td>
        <td align="right" style="font-weight:bold;border-top:double;font-family: 'Arial Bold';"><?= number_format($total_amount, 2) ?></td>
    </tr>
    <tr style="border-top:1px solid;font-weight:bold;font-family: 'Times New Roman Bold';">
        <td style="border-right: unset;" colspan="2"> (Total Amount in Words)</td>
        <td style="border-left: unset;" colspan="4">
            <?php $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
            echo strtoupper($f->format($total_amount) . " pesos only"); ?>
        </td>
    </tr>
    <tr style="border: none;">
        <td colspan="6">&nbsp;</td>
    </tr>
    <tr style="border:none;">
        <td colspan="6"><span style="margin-left: 5%;"></span> In case of failure to make the full delivery within the time specified above, a penalty of one-tenth (1/10) of one percent for every day of delay shall be imposed on the undelivered item/s.</td>
    </tr>
    <tr style="border: none;">
        <td colspan="6">&nbsp;</td>
    </tr>
    <tr style="border: none;">
        <td colspan="3">Conforme:</td>
        <td colspan="3">Very truly yours,</td>
    </tr>
    <tr style="border:none;font-weight:bold;font-family: 'Times New Roman Bold';" align="center">
        <td colspan="3"><?= $sup_data['supplier_owner'] ?></td>
        <td colspan="3"><?= school_head ?></td>
    </tr>
    <tr style="border:none;" align="center">
        <td colspan="3">Signature over Printed Name of Supplier</td>
        <td colspan="3">Signature over Printed Name of Authorized Official</td>
    </tr>
    <tr style="border:none;font-weight:bold;font-family: 'Times New Roman Bold';" align="center">
        <td colspan="3"></td>
        <td colspan="3">Principal I</td>
    </tr>
    <tr style="border:none;" align="center">
        <td colspan="3">Date:</td>
        <td colspan="3">Designation</td>
    </tr>
    <tr style="border:none;">
        <td colspan="6">&nbsp;</td>
    </tr>
    <tr style="border-top: 2px solid;border-bottom: none;font-weight:bold;font-family: 'Times New Roman Bold';">
        <td colspan='3' style="border-left: 2px solid;">Fund Cluster: 01</td>
        <td colspan='3' style="border-left: 2px solid;border-right:2px solid;">ORS/BURS No:</td>
    </tr>
    <tr style="border-bottom: none;font-weight:bold;font-family: 'Times New Roman Bold';">
        <td colspan='3' style="border-left: 2px solid;">Fund Available:</td>
        <td colspan='3' style="border-left: 2px solid;border-right:2px solid;">Date of the ORS/BURS:</td>
    </tr>
    <tr style="border-bottom: none;font-weight:bold;font-family: 'Times New Roman Bold';">
        <td colspan='3' style="border-left: 2px solid;"></td>
        <td colspan='3' style="border-left: 2px solid;border-right:2px solid;">Amount:</td>
    </tr>
    <tr align="center" style="border-bottom: none;font-weight:bold;font-family: 'Times New Roman Bold';">
        <td colspan='3' style="border-left: 2px solid;"><u><b><?= school_treasurer ?></b></u></td>
        <td colspan='3' style="border-left: 2px solid;border-right:2px solid;"></td>
    </tr>
    <tr align="center" style="border-bottom: 2px solid;">
        <td colspan='3' style="border-left: 2px solid;">Signature over Printed Name of School Treasurer</td>
        <td colspan='3' style="border-left: 2px solid;border-right:2px solid;"></td>
    </tr>
</table>
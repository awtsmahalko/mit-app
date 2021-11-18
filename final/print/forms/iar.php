<?php
require_once '../../core/config.php';
$po_id = $_REQUEST['po_id'];

$fetch_head = $mysqli_connect->query("SELECT * from tbl_purchase_order_header WHERE po_id = '$po_id'") or die($mysqli_connect->error);

$po_data = $fetch_head->fetch_array();

$supplier_name  = getSupplier($po_data['supplier_id']);
$pr_no          = getPRNum($po_data['pr_id']);
$invoices       = getIarInvoices($po_id);
$invoices_date  = getIarInvoicesDate($po_id);
$date_inspected = date("F d, Y", strtotime($po_data['date_inspected']));
$date_received  = date("F d, Y", strtotime($po_data['date_received']));


$fetch_det = $mysqli_connect->query("SELECT po.*,item_name from tbl_purchase_order_details AS po,tbl_items AS i WHERE po.item_id = i.item_id AND po.po_id = '$po_id' ORDER BY item_name ASC") or die($mysqli_connect->error);
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
<table width="100%" style="margin-bottom: 5px;border-collapse:collapse;font-weight:bold;font-family: 'Times New Roman Bold', Times, serif;">
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr align="center">
        <td colspan="3" style="font-size: 14pt;">INSPECTION AND ACCEPTANCE REPORT</td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2" style="font-size: 11pt;">Entity Name: DEPARTMENT OF EDUCATION</td>
        <td style="font-size: 11pt;">Fund Cluster: 01</td>
    </tr>
</table>
<table width="100%" border='2px' style="font-size:11pt;border-collapse:collapse;">
    <tr style="border-bottom: none;">
        <td style="border-right: unset;">Supplier:</td>
        <td style="border-left: none;font-size:10pt;font-family: 'Times New Roman Bold'"><b><?= strtoupper($supplier_name) ?></b></td>
        <td style="border-right: unset;">IAR No.: </td>
        <td style="border-left: none;font-family: 'Times New Roman Bold'"><b><u><?= $pr_no ?></u></b></td>
    </tr>
    <tr style="border-bottom: none;">
        <td style="border-right: unset;">PO No./Date:</td>
        <td style="border-left: none;font-size:10pt;font-family: 'Times New Roman Bold'"><b><?= $pr_no ?></b></td>
        <td style="border-right: unset;">Date: </td>
        <td style="border-left: none;font-family: 'Times New Roman Bold'"><b><u><?= date("F d, Y", strtotime($po_data['po_date'])) ?></u></b></td>
    </tr>
    <tr style="border-bottom: none;">
        <td style="border-right: unset;">Requisitioning Office/Dept.:</td>
        <td style="border-left: none;font-size:10pt;"></td>
        <td style="border-right: unset;">Invoice No: </td>
        <td style="border-left: none;font-family: 'Times New Roman Bold'"><b><u><?= $invoices ?></u></b></td>
    </tr>
    <tr style="border-bottom: none;">
        <td style="border-right: unset;">Requisitioning Center Code:</td>
        <td style="border-left: none;font-size:10pt;"></td>
        <td style="border-right: unset;">Date: </td>
        <td style="border-left: none;font-family: 'Times New Roman Bold'"><b><u><?= $invoices_date ?></u></b></td>
    </tr>
</table>
<table width="100%" border='2px' style="font-size:11pt;border-collapse:collapse;">
    <tr style="border-top: none;text-align:center;font-weight:bold;font-style:italic;font-family: 'Times New Roman Bold'">
        <td>Stock / Property No.</td>
        <td colspan="3">Description</td>
        <td>Unit</td>
        <td>Quantity</td>
    </tr>
    <?php
    $tr_no = 20;

    $left_tr = $tr_no - $count_details;
    $total_amount = 0;
    while ($row_det = $fetch_det->fetch_array()) {
        $amount = $row_det['qty'] * $row_det['cost'];
        $total_amount += $amount;
    ?>
        <tr style="font-size: 9pt;font-family: 'Arial'">
            <td width="10%"></td>
            <td colspan="3"><?= $row_det['item_name'] ?></td>
            <td align="center"><?= getData("packaging_name", "tbl_packaging", "packaging_id", $row_det['packaging_id']) ?></td>
            <td align="center" style="font-family: 'Arial Bold'"><b><?= $row_det['qty'] ?></b></td>
        </tr>
    <?php } ?>
    <?php
    for ($i = 0; $i < $left_tr; $i++) {
        echo "<tr><td>&nbsp;</td><td colspan='3'></td><td></td><td></td></tr>";
    }
    ?>
    <tr style="font-weight:bold;font-style:italic;text-align:center;font-family: 'Times New Roman Bold'">
        <td colspan="3" width="50%">INSPECTION</td>
        <td colspan="3" width="50%">ACCEPTANCE</td>
    </tr>
    <tr style="border-bottom:none;height: 40px;font-weight:bold;font-family: 'Times New Roman Bold'">
        <td colspan="3">Date Inspected: <u><?= $date_inspected ?></u></td>
        <td colspan="3">Date Received: <u><?= $date_received ?></u></td>
    </tr>
    <tr style="border-bottom:none;font-size:12pt;">
        <td colspan="3">
            <div style="margin:5px;border:1px solid;height:25px;width: 25px;font-size: 25px;float:left">&#10003; </div> Inspected, verified and found in order as to quantity and specifications
        </td>
        <td colspan="3">
            <div style="margin:5px;border:1px solid;height:25px;width: 25px;font-size: 25px;float:left">&#10003; </div> Complete
        </td>
    </tr>
    <tr style="border-bottom:none;font-size:12pt;">
        <td colspan="3"></td>
        <td colspan="3">
            <div style="margin:5px;border:1px solid;height:25px;width: 25px;font-size: 25px;float:left"> </div>Partial (pls. specify quantity)
        </td>
    </tr>
    <tr style="border-bottom: none;">
        <td colspan="3">&nbsp;</td>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr style="border-bottom: none;">
        <td colspan="3">&nbsp;</td>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr style="border-bottom:none;font-weight:bold;font-family: 'Times New Roman Bold'" align="center">
        <td colspan="3"><?= strtoupper(getUser($po_data['io_id'])) ?></td>
        <td colspan="3"><?= strtoupper(getUser($po_data['pc_id'])) ?></td>
    </tr>
    <tr style="border-bottom:none;" align="center">
        <td colspan="3">Inspection Officer/Inspection Committee</td>
        <td colspan="3">Supply and/or Property Custodian</td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
        <td colspan="3">&nbsp;</td>
    </tr>
</table>
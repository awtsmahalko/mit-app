<?php
$fetch = $mysqli_connect->query("SELECT * from tbl_purchase_request_header WHERE pr_id = '$pr_id'") or die(mysqli_error());
$pr_row = $fetch->fetch_array();


$fetch_details = $mysqli_connect->query("SELECT * from tbl_purchase_request_details WHERE pr_id = '$pr_id'") or die(mysqli_error());
$count_details = $fetch_details->num_rows;

$return = "
<table width='100%' style='border-collapse: collapse;''>
    <tr>
        <td colspan='6' align='center' style='font-size: 15pt;font-weight:bold;'>&nbsp;</td>
    </tr>
    <tr>
        <td colspan='6' align='center' style='font-size: 15pt;font-weight:bold;'>PURCHASE REQUEST</td>
    </tr>
    <tr>
        <td colspan='6' align='center' style='font-size: 15pt;font-weight:bold;'>&nbsp;</td>
    </tr>
    <tr style='font-size: 11pt;font-weight:bold;''>
        <td>Entity Name : </td>
        <td colspan='2'>HIMOGAAN BAYBAY INTEGRATED SCHOOL</td>
        <td colspan='3'>Fund Cluster : 01</td>
    </tr>
</table>
<table width='100%' border='1px' style='font-size:11pt;border-collapse: collapse;'>
    <tr>
        <td rowspan='2' colspan='2' style='vertical-align:baseline;'>Office/Section:</td>
        <td colspan='2'>PR No.: <b>$pr_row[pr_no]</b></td>
        <td rowspan='2' style='vertical-align:baseline;'>Date</td>
        <td rowspan='2' style='vertical-align:baseline;'>$pr_row[pr_date]</td>
    </tr>
    <tr>
        <td>Responsibility Center Code: ______________</td>
    </tr>
    <tr style='text-align:center;font-weight:bold;'>
        <td>Stock / Property No.</td>
        <td>Unit</td>
        <td>Item Description</td>
        <td>Quantity</td>
        <td>Unit Cost</td>
        <td>Total Cost</td>
    </tr>";

$tr_no = 20;

$left_tr = $tr_no - $count_details;
$total_amount = 0;
while ($row_det = $fetch_details->fetch_array()) {
    $total_amount += $row_det['qty'] * $row_det['cost'];

    $return .= "<tr style='border-bottom:none;'>
            <td></td>
            <td>" . getPackaging($row_det['packaging_id']) . "</td>
            <td>" . getItem($row_det['item_id']) . "</td>
            <td align='center'>$row_det[qty]</td>
            <td align='right'>" . number_format($row_det['cost'], 2) . "</td>
            <td align='right'>" . number_format($row_det['qty'] * $row_det['cost'], 2) . "</td>
        </tr>";
}

for ($i = 0; $i < $left_tr; $i++) {
    $return .=  "<tr style='border-bottom:none;'><td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td></tr>";
}
$return .= "
<tr style='border-top:1px solid;'>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align='right' style='font-weight:bold;'>" . number_format($total_amount, 2) . "</td>
</tr>
<tr style='border-bottom:none;'>
    <td colspan='6'>Purpose: </td>
</tr>
<tr style='border-bottom:none;'>
    <td colspan='6'>" . $pr_row['pr_purpose'] . "</td>
</tr>
<tr style='border-bottom:none;'>
    <td colspan='6'>&nbsp;</td>
</tr>
<tr>
    <td colspan='6'>&nbsp;</td>
</tr>
<tr style='border:none;border-left:1px solid;border-right:1px solid;'>
    <td></td>
    <td colspan='2'>Requested by:</td>
    <td colspan='3'>Approved by:</td>
</tr>
<tr style='border:none;border-left:1px solid;border-right:1px solid;'>
    <td>Signature: </td>
    <td colspan='2'></td>
    <td colspan='3'></td>
</tr>
<tr style='border:none;border-left:1px solid;border-right:1px solid;'>
    <td>Printed Name: </td>
    <td colspan='2' align='center'>STEPHANIE DANE S. SALVADOR</td>
    <td colspan='3' align='center'>" . school_head . "</td>
</tr>
<tr style='border:none;border-left:1px solid;border-right:1px solid;border-bottom:1px solid;'>
    <td>Designation: </td>
    <td colspan='2' align='center'>Admin Assistant II</td>
    <td colspan='3' align='center'>Head of Procuring Entity</td>
</tr>
</table>";
return $return;

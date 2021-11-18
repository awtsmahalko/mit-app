<?php


$fetch = $mysqli_connect->query("SELECT * from tbl_canvass_header WHERE canvass_id = '$canvass_id'") or die($mysqli_connect->error);
$head_row = $fetch->fetch_array();


$fetch_pr_data = $mysqli_connect->query("SELECT * from tbl_purchase_request_header WHERE pr_id = '$head_row[pr_id]'") or die($mysqli_connect->error);
$pr_data = $fetch_pr_data->fetch_array();


$pr_no = getData("pr_no", "tbl_purchase_request_header", "pr_id", $head_row['pr_id']);
$explode_pr_no = explode("-", $pr_no);

$fetch_rows = $mysqli_connect->query("SELECT supplier_id,SUM(qty * cost) AS amt FROM `tbl_canvass_details` WHERE canvass_id = '$canvass_id' GROUP BY supplier_id ORDER BY amt ASC LIMIT 1") or die($mysqli_connect->error);
$supplier_row = $fetch_rows->fetch_array();
$supplier = getSupplier($supplier_row['supplier_id']);

return '<table width="100%" style="font-size: 10pt;border-collapse:collapse;">
    <tr align="center">
        <td colspan="7"><img src="https://juancoder.com/PIMS/img/deped.png" style="height: 73px;"></td>
    </tr>
    <tr align="center">
        <td colspan="7" style="font-size: 11pt;">Republic of the Philippines</td>
    </tr>
    <tr align="center">
        <td colspan="7" style="font-size: 16pt;font-weight:bold;">Department of Education</td>
    </tr>
    <tr align="center">
        <td colspan="7">Region VI-Western Visayas</td>
    </tr>
    <tr align="center">
        <td colspan="7">Division of Sagay City</td>
    </tr>
    <tr align="center">
        <td colspan="7">HIMOGA-AN BAYBAY INTEGRATED SCHOOL</td>
    </tr>
    <tr align="center">
        <td colspan="7" style="font-weight:bold;">BIDS AND AWARDS COMMITTEE</td>
    </tr>
    <tr style="border-top: 1px solid;">
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr style="border-bottom: 1px solid;">
        <td colspan="7" style="text-align:center;"><b>BAC RESOLUTION DECLARING THE LOWEST CALCULATED & RESPONSIVE BID (LCRB) AND RECOMMENDING APPROVAL</b></td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr align="center">
        <td colspan="7" style="font-weight: bold;">BAC RESOLUTION FOR MODE OF PROCUREMENT AND RECOMMENDING APPROVAL</td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr align="center">
        <td colspan="7" style="font-weight: bold;">RESOLUTION # <span style="text-decoration:underline;">' . $explode_pr_no[1] . "-" . $explode_pr_no[2] . '</span>, S. ' . $explode_pr_no[0] . '</td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="7"><span style="font-weight: bold;margin-left:10%;">WHEREAS</span>, the Himoga-an Baybay Integrated School distributed the Request for Quotation for the <b>' . $pr_data['pr_mode'] . ' </b> to three (3) prospective suppliers;</td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="7"><span style="font-weight: bold;margin-left:10%;">WHEREAS</span>, in response to the said quotation, three (3) prospective supplier submitted the quotation;</td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="7"><span style="font-weight: bold;margin-left:10%;">WHEREAS</span>, after all bids were tabulated and ranked, the BAC identified the Lowest Calculated Bid (LCB) for each item shown in the attached Abstract of Quotation with the highlighted bid price/offer getting the LCB;</td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="7"><span style="font-weight: bold;margin-left:10%;">NOW, THEREFORE, </span> based on the above premises, we the Members of the Bids and Awards Committee, hereby RESOLVE as it is <b>RESOLVED</b></td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3" align="right">a. </td>
        <td colspan="4">To declare <b>' . $supplier . '</b> as the Bidder with the Lowest Calculated & Responsive Bid for the <b>' . $pr_data['pr_mode'] . '</b>.</td>
    </tr>
    <tr>
        <td colspan="3" align="right">e. </td>
        <td colspan="4">To recommend for approval by the Principal / School Head of Himoga-an Baybay Integrated School</td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr align="center" style="font-weight: bold;">
        <td>JUMBO Y. CAÑETE</td>
        <td></td>
        <td colspan="2">CHRIS C. GABANA</td>
        <td></td>
        <td colspan="2">MARY ANN B. ESTELLOSO</td>
    </tr>
    <tr align="center">
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr align="center" style="font-weight: bold;">
        <td>RUJIE VELASCO</td>
        <td></td>
        <td colspan="2">MA. RHODA A. ODELMO</td>
        <td></td>
        <td colspan="2"></td>
    </tr>
    <tr align="center">
        <td>Vice-Chair</td>
        <td></td>
        <td colspan="2">Chairperson</td>
        <td></td>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr align="center" style="font-weight: bold;">
        <td></td>
        <td></td>
        <td colspan="2">MARLON L. SOLIVIO, PhD.</td>
        <td></td>
        <td colspan="2"></td>
    </tr>
    <tr align="center">
        <td></td>
        <td></td>
        <td colspan="2">Principal I / Head of Procuring Entity</td>
        <td></td>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="7">Date approved: </td>
    </tr>
</table>';

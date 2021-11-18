<?php
$fetch = $mysqli_connect->query("SELECT * from tbl_purchase_request_header WHERE pr_id = '$pr_id'") or die(mysqli_error());
$pr_row = $fetch->fetch_array();


$fetch_details = $mysqli_connect->query("SELECT * from tbl_purchase_request_details WHERE pr_id = '$pr_id'") or die(mysqli_error());
$count_details = $fetch_details->num_rows;

$explode_pr_no = explode("-", $pr_row['pr_no']);
$quot_no = $explode_pr_no[0] . "-" . $explode_pr_no[1] . "-" . $explode_pr_no[2];
$html_message = " 
<table width='100%' style='font-size:10pt;border-collapse: collapse;'>
    <tr>
        <td colspan='4'>Republic of the Philippines</td>
        <td colspan='2'>Project Reference No :</td>
        <td colspan='4' style='border-bottom:1px solid;'></td>
    </tr>
    <tr>
        <td colspan='4'>Department of Education</td>
        <td colspan='2'>Name of Project :</td>
        <td colspan='4' style='border-bottom:1px solid;'>".strtoupper($pr_row['pr_mode'])."</td>
    </tr>
    <tr>
        <td colspan='4'>Region VI - Western Visayas</td>
        <td colspan='2'></td>
        <td colspan='4' style='border-bottom:1px solid;'>HBIS - ".strtoupper($pr_row['pr_department']) ."</td>
    </tr>
    <tr>
        <td colspan='4'>DIVISION OF SAGAY CITY</td>
        <td colspan='2'>Location of the Project </td>
        <td colspan='4' style='border-bottom:1px solid;'></td>
    </tr>
    <tr>
        <td colspan='4' style='font-weight:bold;'>OFFICE OF BIDS AND AWARDS COMMITTEE</td>
        <td colspan='2'>Fund: </td>
        <td colspan='4' style='border-bottom:1px solid;'></td>
    </tr>
    <tr align='center'>
        <td colspan='10' style='font-size: 14pt;font-weight:bold;'>REQUEST FOR QUOTATION</td>
    </tr>
    <tr>
        <td colspan='3' style='border-bottom:1px solid;'></td>
        <td colspan='5'></td>
        <td align='right'>Date :</td>
        <td style='font-size: 8pt;border-bottom:1px solid;text-align:center;'>".date('F d, Y',strtotime("$pr_row[pr_date] + 1 day"))."</td>
    </tr>
    <tr>
        <td colspan='3' style='border-bottom:1px solid;'></td>
        <td colspan='3'></td>
        <td colspan='3' align='right'>Quotation No :</td>
        <td style='font-size: 8pt;border-bottom:1px solid;text-align:center;'>$quot_no</td>
    </tr>
    <tr>
        <td colspan='3' style='border-bottom:1px solid;'></td>
        <td colspan='7'>&nbsp;</td>
    </tr>
    <tr>
        <td colspan='10'> <span style='margin-left: 5%;'></span> Please quote your lowest price on the item/s listed below subject to the General Condition on the last page stating the shortest time of delivery. Submit your quotation duly signed by your representative not later than ____________ <span style='font-size:8pt;'>(time)</span> to the return envelope attached herewith.</td>
    </tr>
    <tr>
        <td colspan='10'>&nbsp;</td>
    </tr>
    <tr align='center'>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td colspan='4'><b>MA. RHODA A. ODELMO</b></td>
    </tr>
    <tr>
        <td width='5% '>NOTE:</td>
        <td width='10%'></td>
        <td width='10%'></td>
        <td width='15%'></td>
        <td width='10%'></td>
        <td width='10%'></td>
        <td colspan='4' align='center'>(BAC Chairman)</td>
    </tr>
    <tr>
        <td align='right'>1 &nbsp;</td>
        <td colspan='9'>All entries must be typewritten.</td>
    </tr>
    <tr>
        <td align='right'>2 &nbsp;</td>
        <td colspan='9'>Delivery period within ______ calendar days after receipt of Purchase Order.</td>
    </tr>
    <tr>
        <td align='right'>3 &nbsp;</td>
        <td colspan='9'>Warranty shall be for a period of six (6) months for supplies and materials. One (1) year for equipment from date of acceptance by the procuring entity.</td>
    </tr>
    <tr>
        <td align='right'>4 &nbsp;</td>
        <td colspan='9'>Price validity shall be for a period of ________ calendar days after issuance of Request for Quotation.</td>
    </tr>
    <tr>
        <td align='right'>5 &nbsp;</td>
        <td colspan='9'>PhilGeps Registration Certificate shall be attached upon submission of the quotation.</td>
    </tr>
    <tr>
        <td align='right'>6 &nbsp;</td>
        <td colspan='9'>Bidders shall submit original brochures showing certifications of the product being offered.</td>
    </tr>
    <tr align='center' style='font-weight:bold;'>
        <td style='border:1px solid;'>Item No.</td>
        <td style='border:1px solid;' colspan='5'>Name & Description</td>
        <td style='border:1px solid;'>Quantity</td>
        <td style='border:1px solid;'>Unit</td>
        <td style='border:1px solid;'>Unit Price</td>
        <td style='border:1px solid;'>Total Price</td>
    </tr>";

    $count_det = 1;
    while ($row_det = $fetch_details->fetch_array()) {
        $html_message .= '<tr align="center">
                    <td style="border:1px solid;">' . $count_det++ . '</td>
                    <td style="border:1px solid;text-align:left;" colspan="5">' . getItem($row_det['item_id']) . '</td>
                    <td style="border:1px solid;">' . $row_det['qty'] . '</td>
                    <td style="border:1px solid;">' . getPackaging($row_det['packaging_id']) . '</td>
                    <td style="border:1px solid;"></td>
                    <td style="border:1px solid;"></td>
                </tr>';
    }

    $tr_no = 20;
    $tr_after = 6;
    $left_tr = $tr_no - $count_details;
    for ($i = 0; $i < $left_tr; $i++) {
        $html_message .= '<tr align="center">
                    <td style="border:1px solid;">&nbsp;</td>
                    <td style="border:1px solid;text-align:left;" colspan="5"></td>
                    <td style="border:1px solid;"></td>
                    <td style="border:1px solid;"></td>
                    <td style="border:1px solid;"></td>
                    <td style="border:1px solid;"></td>
                </tr>';
    }
    for ($i = 0; $i < $tr_after; $i++) {
        $html_message .= '<tr align="center">
                    <td style="border:1px solid;">&nbsp;</td>
                    <td style="border:1px solid;text-align:left;" colspan="5"></td>
                    <td style="border:1px solid;" colspan="3"></td>
                    <td style="border:1px solid;"></td>
                </tr>';
    }
    $html_message .= "
    <tr align='center' style='border:1px solid;border-bottom:2px solid;'>
        <td colspan='10'>&nbsp;</td>
    </tr>
    <tr>
        <td></td>
        <td align='right'>Brand Model : </td>
        <td colspan='3' style='border-bottom: 1px solid;'></td>
        <td></td>
        <td colspan='3' align='right'>Warranty:</td>
        <td style='border-bottom: 1px solid;'></td>
    </tr>
    <tr>
        <td></td>
        <td align='right'>Delivery Period : </td>
        <td colspan='3' style='border-bottom: 1px solid;'></td>
        <td></td>
        <td colspan='3' align='right'>Price Validity:</td>
        <td style='border-bottom: 1px solid;'></td>
    </tr>
    <tr>
        <td colspan='10'> <span style='margin-left: 5%;'></span> After having carefully read and accepted your General Condition. I/We quote you the item/s at prices noted above.</td>
    </tr>
    <tr>
        <td colspan='10'>&nbsp;</td>
    </tr>
    <tr align='center'>
        <td colspan='6'></td>
        <td colspan='4' style='border-top: 1px solid;'>Printed Name/Signature</td>
    </tr>
    <tr>
        <td colspan='10'>&nbsp;</td>
    </tr>
    <tr align='center'>
        <td colspan='6'></td>
        <td colspan='4' style='border-top: 1px solid;'>Tel./Cellphone No./Email Address</td>
    </tr>
    <tr>
        <td colspan='10'>&nbsp;</td>
    </tr>
    <tr align='center'>
        <td colspan='6'></td>
        <td colspan='4' style='border-top: 1px solid;'>Date</td>
    </tr>
</table>";
 return $html_message;
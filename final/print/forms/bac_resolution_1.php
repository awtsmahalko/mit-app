<?php
require_once '../../core/config.php';

$pr_id = $_REQUEST['pr_id'];
$fetch = $mysqli_connect->query("SELECT * from tbl_purchase_request_header WHERE pr_id = '$pr_id'") or die($mysqli_connect->error);
$pr_row = $fetch->fetch_array();

$explode_pr_no = explode("-", $pr_row['pr_no']);
?>
<style>
    @font-face {
        font-family: 'Old English Text MT';
        src: url("<?= base_url ?>/css/fonts/Old-English-Text-MT_33641.ttf");
    }

    @font-face {
        font-family: 'Trajan Pro';
        src: url("<?= base_url ?>/css/fonts/Trajan-Pro-Regular.ttf");
    }

    @font-face {
        font-family: 'Trajan Pro Bold';
        src: url("<?= base_url ?>/css/fonts/TrajanPro-Bold.otf");
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
<table width="100%" style="border-collapse: collapse;font-family:'Arial'">
    <tr align="center">
        <td colspan="7"><img src="<?= base_url ?>/img/deped.png" style="height: 73px;"></td>
    </tr>
    <tr align="center">
        <td colspan="7" style="font-size: 11pt;font-family:'Old English Text MT'">Republic of the Philippines</td>
    </tr>
    <tr align="center">
        <td colspan="7" style="font-size: 16pt;font-weight:bold;font-family:'Old English Text MT'">Department of Education</td>
    </tr>
    <tr align="center">
        <td colspan="7" style="font-size: 10pt;font-family:'Trajan Pro Bold'">Region VI-Western Visayas</td>
    </tr>
    <tr align="center">
        <td colspan="7" style="font-size: 10pt;font-family:'Trajan Pro Bold'">Division of Sagay City</td>
    </tr>
    <tr align="center">
        <td colspan="7" style="font-size: 10pt;font-family:'Trajan Pro Bold'"><?= school_name ?></td>
    </tr>
    <tr align="center">
        <td colspan="7" style="font-size: 10pt;font-weight:bold;font-family:'Trajan Pro Bold'">BIDS AND AWARDS COMMITTEE</td>
    </tr>
    <tr style="border-top: 1px solid;">
        <td colspan="7" style="font-size: 10pt;">Present:</td>
    </tr>
    <tr>
        <td colspan="3" style="font-size: 10pt;"> MA. RHODA A. ODELMO - Chairperson</td>
        <td></td>
        <td colspan="3" style="font-size: 10pt;"> MARY ANN B. ESTELLOSO - Member</td>
    </tr>
    <tr>
        <td colspan="3" style="font-size: 10pt;"> RUJIE VELASCO - Vice - Chair</td>
        <td></td>
        <td colspan="3" style="font-size: 10pt;"> JUMBO CAÑETE - Member</td>
    </tr>
    <tr style="border-bottom: 1px solid;">
        <td colspan="3" style="font-size: 10pt;"> CHRIS C. GABANA - Member</td>
        <td></td>
        <td colspan="3" style="font-size: 10pt;"></td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr align="center">
        <td colspan="7" style="font-weight: bold;font-family:'Arial Bold'">BAC RESOLUTION FOR MODE OF PROCUREMENT AND RECOMMENDING APPROVAL</td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr align="center">
        <td colspan="7" style="font-weight: bold;font-family:'Arial Bold'">RESOLUTION # <span style="text-decoration:underline;"><?= $explode_pr_no[1] . "-" . $explode_pr_no[2] ?></span></td>
    </tr>
    <tr align="center">
        <td colspan="7">Series of <?= $pr_row['pr_year'] ?></td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="7"><span style="font-weight: bold;margin-left:10%;font-family:'Arial Bold'">WHEREAS</span>, APPROVED Purchased Request/s was/were submitted to the members of the Committee for their appropiate action on mode of procurement to wit:</td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr style="text-align:center;">
        <td colspan="2" style="border:1px solid;" rowspan="2">TITLE/DESCRIPTION:</td>
        <td colspan="5" style="border:1px solid;font-weight: bold;font-family:'Arial Bold'">PROCUREMENT OF <?= strtoupper($pr_row['pr_mode']) ?></td>
    </tr>
    <tr style="border:1px solid;text-align:center;">
        <td colspan="5" style="border:1px solid;">&nbsp;</td>
    </tr>
    <tr style="text-align:center;">
        <td style="border:1px solid;" colspan="2">REQUESTING DEPT./OFFICE</td>
        <td style="border:1px solid;" colspan="2">PURCHASE REQUEST NO.</td>
        <td style="border:1px solid;">DATE</td>
        <td style="border:1px solid;" colspan="2">AMOUNT</td>
    </tr>
    <tr style="text-align:center;">
        <td colspan="2" style="border:1px solid;border-bottom:none;">&nbsp;</td>
        <td colspan="2" style="border:1px solid;border-bottom:none;"></td>
        <td style="border:1px solid;border-bottom:none;"></td>
        <td colspan="2" style="border:1px solid;border-bottom:none;text-align:right;"></td>
    </tr>
    <tr style="text-align:center;">
        <td colspan="2" style="border-left:1px solid;">ADMIN OFFICE</td>
        <td colspan="2" style="border-left:1px solid;"><?= $pr_row['pr_no'] ?></td>
        <td style="border-left:1px solid;"><?= $pr_row['pr_date'] ?></td>
        <td colspan="2" style="border-left:1px solid;border-right:1px solid;text-align:right;"><?= number_format(getData("SUM(qty*cost)", "tbl_purchase_request_details", "pr_id", $pr_id), 2) ?></td>
    </tr>
    <tr>
        <td colspan="2" style="border:none;border-left:1px solid;">&nbsp;</td>
        <td colspan="2" style="border:none;border-left:1px solid;"></td>
        <td style="border:none;border-left:1px solid;"></td>
        <td colspan="2" style="border:none;border-left:1px solid;border-right:1px solid;text-align:right;"></td>
    </tr>
    <tr>
        <td colspan="2" style="border:1px solid;border-top:none;">&nbsp;</td>
        <td colspan="2" style="border:1px solid;border-top:none;"></td>
        <td style="border:1px solid;border-top:none;"></td>
        <td colspan="2" style="border:1px solid;text-align:right" rowspan="1"><?= number_format(getData("SUM(qty*cost)", "tbl_purchase_request_details", "pr_id", $pr_id), 2) ?></td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="7"><span style="font-weight: bold;margin-left:10%;font-family:'Arial Bold'">WHEREAS</span>, Section 53.9 of the Revised IRR of RA 9184 otherwise known as The Government Procurement Reform Act states that Small Value Procurement is a procurement of (a) goods not covered by Shopping under Section 52 IRR RA 9184 (b) infrastructure projects, and (c) consulting services, where the amount does not exceed the threshold of One Million Pesos (P1,000,000.00);</td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="7"><span style="font-weight: bold;margin-left:10%;font-family:'Arial Bold'">WHEREAS</span>, considering the urgency of the services and/or the items requisitioned, it is hereby resolved by all members of the Committee that the procurement of said item/s or service/s based in the approved Purchased Request will be through Small Value Procurement with the supplier who could offer the most advantageous price to the Government;</td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="7"><span style="font-weight: bold;margin-left:10%;font-family:'Arial Bold'">NOW, THEREFORE</span>, on motion of Mr/Ms. <b><?= getUser($pr_row['approved_by']) ?></b> duly seconded by all the members present, the body RESOLVES as it is hereby RESOLVED to recommend to the School Head that procurement for item/s or services/s contained in the above-listed approved Purchase Request/s will be through <b><?= strtoupper($pr_row['pr_mode']) ?></b> with the supplier who could offer the most advantageous price to the government;</td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="7"><span style="font-weight: bold;margin-left:10%;font-family:'Arial Bold'">RESOLVED</span>, at the Admin Office, Himoga-an Baybay Integrated School, Sagay City, Negros Occidental, this <b><u><?= date('jS', strtotime($pr_row['pr_date'])) . " day of " . date("F Y", strtotime($pr_row['pr_date'])); ?></u></b>.</td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr align="center" style="font-weight: bold;font-family:'Arial Bold'">
        <td>JUMBO CAÑETE</td>
        <td></td>
        <td colspan="2">CHRIS C. GABANA</td>
        <td></td>
        <td colspan="2">MARY ANN B. ESTELLOSO</td>
    </tr>
    <tr align="center">
        <td>Member</td>
        <td></td>
        <td colspan="2">Member</td>
        <td></td>
        <td colspan="2">Member</td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr align="center">
        <td colspan="4"></td>
        <td colspan="3">Approved:</td>
    </tr>
    <tr align="center" style="font-weight: bold;font-family:'Arial Bold'">
        <td>RUJIE VELASCO</td>
        <td></td>
        <td colspan="2">MA. RHODA A. ODELMO</td>
        <td></td>
        <td colspan="2"></td>
    </tr>
    <tr align="center">
        <td>Member</td>
        <td></td>
        <td colspan="2">Member</td>
        <td></td>
        <td colspan="2"></td>
    </tr>
    <tr align="center" style="font-weight: bold;font-family:'Arial Bold'">
        <td colspan="5"></td>
        <td colspan="2"><?= school_head ?></td>
    </tr>
    <tr align="center">
        <td colspan="5"></td>
        <td colspan="2">Principal I</td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr align="center">
        <td colspan="5"></td>
        <td colspan="2">Date: _______________</td>
    </tr>
</table>
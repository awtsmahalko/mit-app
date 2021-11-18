<?php
require_once '../../core/config.php';

$canvass_id = $_REQUEST['canvass_id'];

$fetch = $mysqli_connect->query("SELECT * from tbl_canvass_header WHERE canvass_id = '$canvass_id'") or die($mysqli_connect->error);
$head_row = $fetch->fetch_array();


$fetch_details = $mysqli_connect->query("SELECT pr.*,item_name,packaging_name from tbl_purchase_request_details AS pr,tbl_items AS i,tbl_packaging AS pack WHERE pr.item_id = i.item_id AND pack.packaging_id = pr.packaging_id AND pr.pr_id = '$head_row[pr_id]' ORDER BY `i`.`item_name` ASC, pack.packaging_name ASC") or die($mysqli_connect->error);
$count_details = $fetch_details->num_rows;

$fetch_sup = $mysqli_connect->query("SELECT supplier_id,SUM(qty * cost) AS amt FROM `tbl_canvass_details` WHERE canvass_id = '$canvass_id' GROUP BY supplier_id ORDER BY amt ASC") or die($mysqli_connect->error);

function PriceAmount($canvass_id, $supplier_id, $item_id, $packaging_id)
{
    global $mysqli_connect;
    $fetch = $mysqli_connect->query("SELECT * from tbl_canvass_details WHERE canvass_id = '$canvass_id' AND supplier_id = '$supplier_id' AND item_id = '$item_id' AND packaging_id = '$packaging_id'") or die($mysqli_connect->error);
    return $fetch->fetch_array();
}
?>
<style>
    @font-face {
        font-family: 'Arial';
        src: url("<?= base_url ?>/css/fonts/ARIAL.TTF");
    }

    @font-face {
        font-family: 'Arial Bold';
        src: url("<?= base_url ?>/css/fonts/Arial-Bold.ttf");
    }

    @font-face {
        font-family: 'Baskerville Old Face';
        src: url("<?= base_url ?>/css/fonts/BASKVILL.ttf");
    }
</style>
<table width="100%">
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr align="center">
        <td colspan="3" style="font-size: 11pt;font-weight:bold;font-family:'Arial Bold';"><?= school_name ?></td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
        <td align="right" style="font-size: 9pt;font-family:'Arial';">AOC No.: <u><span style="font-weight:bold;font-family:'Arial Bold';"><?= getPRNum($head_row['pr_id']) ?></span></u></td>
    </tr>
    <tr align="center">
        <td colspan="3" style="font-size: 14pt;font-weight:bold;font-family:'Baskerville Old Face';">ABSTRACT OF CANVASS</td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
</table>
<table width="100%" border="1px" style="border-collapse: collapse;font-family:'Arial';">
    <tr align="center" style="font-size: 8pt;">
        <td>Name of Project: </td>
        <td></td>
        <td colspan="2" style="font-family:'Arial Bold';font-weight:bold;">OFFICE SUPPLIES</td>
        <?php
        $loop_sup = array();
        while ($row_sup = $fetch_sup->fetch_array()) {
            echo '<td colspan="2" style="font-weight:bold;font-family:\'Arial Bold\'">' . getSupplier($row_sup['supplier_id']) . '</td>';
            $loop_sup[] = $row_sup['supplier_id'];
        }
        ?>
    </tr>
    <tr align="center" style="font-size: 10pt;">
        <td>Item No.</td>
        <td>Quantity</td>
        <td>Unit of Issue</td>
        <td>Name & Specification of Articles</td>
        <?php foreach ($loop_sup as $supplier_id) { ?>
            <td>Unit Price</td>
            <td>Total Amount</td>
        <?php } ?>
    </tr>
    <?php
    $count_det = 1;
    $sup_qty_total = array();
    while ($row_det = $fetch_details->fetch_array()) {
        echo '<tr align="center" style="font-size:9pt;">
                    <td>' . $count_det++ . '</td>
                    <td>' . $row_det['qty'] . '</td>
                    <td>' . $row_det['packaging_name'] . '</td>
                    <td style="text-align:left;font-size:8pt;">' . $row_det['item_name'] . '</td>';
        foreach ($loop_sup as $supplier_id) {
            $aoc = PriceAmount($canvass_id, $supplier_id, $row_det['item_id'], $row_det['packaging_id']);
            $amount = $aoc['cost'] * $aoc['qty'];
            if (!isset($sup_qty_total[$supplier_id])) {
                $sup_qty_total[$supplier_id] = 0;
            }
            $sup_qty_total[$supplier_id] += $amount;
            echo '<td align="right">' . number_format($aoc['cost'], 2) . '</td><td align="right">' . number_format($amount, 2) . '</td>';
        }
        echo '</tr>';
    }

    $tr_no = 20;
    $left_tr = $tr_no - $count_details;
    for ($i = 0; $i < $left_tr; $i++) {
        echo '<tr align="center">
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>';
        foreach ($loop_sup as $supplier_id) {
            echo '<td></td><td></td>';
        }
        echo '</tr>';
    }
    ?>
    <tr align="center" style="font-size: 10pt;font-weight:bold;">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <?php
        foreach ($sup_qty_total as $amount) {
            echo '<td></td><td align="right">' . number_format($amount, 2) . '</td>';
        }
        ?>
    </tr>
</table>
<table width="100%" style="font-size:10pt;font-family:'Arial';">
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3"><span style="margin-left: 5%;"></span> We, members of the BIDS and AWARDS COMMITTEE (BAC) do hereby certify in accordance with the Request for Quotation dated _________received and opened at the office of the BAC Secretariat Office, Sagay City, Negros Occidental on that the forgoing is a true statement of prices and conditions offered for each of the above items at the time the canvass was made and the quality offers which we marked with circle/check are most advantegeous obtainable for the above items.</td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr align="center" style="font-weight: bold;">
        <td><?= bac_1 ?></td>
        <td><?= bac_2 ?></td>
        <td><?= bac_3 ?></td>
    </tr>
    <tr align="center" style="font-style:italic;">
        <td>Teacher</td>
        <td>Teacher</td>
        <td>Teacher</td>
    </tr>
    <tr align="center" style="font-style:italic;font-size:9pt;">
        <td>Member</td>
        <td>Member</td>
        <td>Member</td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr align="center" style="font-weight: bold;">
        <td><?= bac_vice_chair ?></td>
        <td><?= bac_chair ?></td>
        <td></td>
    </tr>
    <tr align="center" style="font-style:italic;">
        <td>Teacher</td>
        <td>Teacher</td>
        <td></td>
    </tr>
    <tr align="center" style="font-style:italic;font-size:9pt;">
        <td>Co-Chairman</td>
        <td>Chairman</td>
    </tr>
</table>
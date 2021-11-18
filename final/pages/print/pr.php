<div class="card shadow mb-4">
    <div class="card-body">
        <table width="100%">
            <tr>
                <td colspan='6' align="center" style="font-size: 15pt;font-weight:bold;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan='6' align="center" style="font-size: 15pt;font-weight:bold;">PURCHASE REQUEST</td>
            </tr>
            <tr>
                <td colspan='6' align="center" style="font-size: 15pt;font-weight:bold;">&nbsp;</td>
            </tr>
            <tr style="font-size: 11pt;font-weight:bold;">
                <td>Entity Name : </td>
                <td colspan='2'>HIMOGAAN BAYBAY INTEGRATED SCHOOL</td>
                <td colspan='3'>Fund Cluster : 01</td>
            </tr>
        </table>
        <table width="100%" border='1px' style="font-size:11pt;">
            <tr>
                <td rowspan='2' colspan='2' style='vertical-align:baseline;'>Office/Section:</td>
                <td colspan='2'>PR No.: 2021-07-015-ELEM </td>
                <td rowspan='2' style='vertical-align:baseline;'>Date</td>
                <td rowspan='2' style='vertical-align:baseline;'>02-Sep-21</td>
            </tr>
            <tr>
                <td>Responsibility Center Code: ______________</td>
            </tr>
            <tr style="text-align:center;font-weight:bold;">
                <td>Stock / Property No.</td>
                <td>Unit</td>
                <td>Item Description</td>
                <td>Quantity</td>
                <td>Unit Cost</td>
                <td>Total Cost</td>
            </tr>
            <?php
            $tr_no = 20;
            $pr_items = array(
                array(
                    'stock' => '',
                    'unit' => 'piece',
                    'desc' => 'Envelop, Plastic, Legal',
                    'qty' => 700,
                    'cost' => 8,
                    'amount' => 5600
                ),
                array(
                    'stock' => '',
                    'unit' => 'pack',
                    'desc' => 'Sign Pen, 0.3 (dozen)',
                    'qty' => 1,
                    'cost' => 953,
                    'amount' => 953
                ),
                array(
                    'stock' => '',
                    'unit' => 'piece',
                    'desc' => 'TAPE, TRANSPARENT, width 48mm (+-1mm)',
                    'qty' => 10,
                    'cost' => 25,
                    'amount' => 250
                ),
                array(
                    'stock' => '',
                    'unit' => 'ream',
                    'desc' => 'FOLDER, TAGBOARD, for legal size documents',
                    'qty' => 4,
                    'cost' => 395,
                    'amount' => 1580
                ),
                array(
                    'stock' => '',
                    'unit' => 'pack',
                    'desc' => 'Tabbing',
                    'qty' => 10,
                    'cost' => 45,
                    'amount' => 450
                ),
                array(
                    'stock' => '',
                    'unit' => 'piece',
                    'desc' => 'Correction Tape',
                    'qty' => 10,
                    'cost' => 30,
                    'amount' => 300
                ),
                array(
                    'stock' => '',
                    'unit' => 'piece',
                    'desc' => 'RECORD BOOK, 300 PAGES, size: 214mm x 278mm min',
                    'qty' => 3,
                    'cost' => 65,
                    'amount' => 195
                ),
                array(
                    'stock' => '',
                    'unit' => 'pack',
                    'desc' => 'NOTE PAD,stick on 50mm x 76mm (2" x 3") min',
                    'qty' => 1,
                    'cost' => 25,
                    'amount' => 25
                ),
                array(
                    'stock' => '',
                    'unit' => 'piece',
                    'desc' => 'Cutter Knife',
                    'qty' => 4,
                    'cost' => 15,
                    'amount' => 60
                ),
                array(
                    'stock' => '',
                    'unit' => 'piece',
                    'desc' => 'Stapler #35, with stapple wire remover',
                    'qty' => 5,
                    'cost' => 110,
                    'amount' => 550
                ),
                array(
                    'stock' => '',
                    'unit' => 'box',
                    'desc' => 'Pentelpen',
                    'qty' => 5,
                    'cost' => 396,
                    'amount' => 1980
                )
            );

            $left_tr = $tr_no - count($pr_items);
            $total_amount = 0;
            for ($i = 0; $i < count($pr_items); $i++) {
                $total_amount += $pr_items[$i]['amount'];
            ?>
                <tr style="border-bottom:none;">
                    <td></td>
                    <td><?= $pr_items[$i]['unit'] ?></td>
                    <td><?= $pr_items[$i]['desc'] ?></td>
                    <td align="center"><?= $pr_items[$i]['qty'] ?></td>
                    <td align="right"><?= number_format($pr_items[$i]['cost'], 2) ?></td>
                    <td align="right"><?= number_format($pr_items[$i]['amount'], 2) ?></td>
                </tr>
            <?php } ?>
            <?php
            for ($i = 0; $i < $left_tr; $i++) {
                echo "<tr style='border-bottom:none;'><td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td></tr>";
            }
            ?>
            <tr style="border-top:1px solid;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td align="right" style="font-weight:bold;"><?= number_format($total_amount, 2) ?></td>
            </tr>
            <tr style="border-bottom:none;">
                <td colspan="6">Purpose: </td>
            </tr>
            <tr style="border-bottom:none;">
                <td colspan="6">&nbsp;</td>
            </tr>
            <tr style="border-bottom:none;">
                <td colspan="6">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="6">&nbsp;</td>
            </tr>
            <tr style="border:none;border-left:1px solid;border-right:1px solid;">
                <td></td>
                <td colspan='2'>Requested by:</td>
                <td colspan='3'>Approved by:</td>
            </tr>
            <tr style="border:none;border-left:1px solid;border-right:1px solid;">
                <td>Signature: </td>
                <td colspan='2'></td>
                <td colspan='3'></td>
            </tr>
            <tr style="border:none;border-left:1px solid;border-right:1px solid;">
                <td>Printed Name: </td>
                <td colspan='2' align="center">STEPHANIE DANE S. SALVADOR</td>
                <td colspan='3' align="center">MARLON L. SOLIVIO</td>
            </tr>
            <tr style="border:none;border-left:1px solid;border-right:1px solid;border-bottom:1px solid;">
                <td>Designation: </td>
                <td colspan='2' align="center">Admin Assistant II</td>
                <td colspan='3' align="center">Principal I</td>
            </tr>
        </table>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <table width="100%">
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
        <table width="100%" border='1px' style="font-size:11pt;">
            <tr style="border-bottom: none;">
                <td style="border-right: unset;">Supplier:</td>
                <td colspan="2" style="border-left: none;">CIAN & CYAN SCHOOL SUPPLIES TRADING</td>
                <td style="border-right: unset;">PO No.: </td>
                <td colspan="2" style="border-left: none;">2021-07-015-ELEM</td>
            </tr>
            <tr style="border-bottom: none;">
                <td style="border-right: unset;">Address:</td>
                <td colspan="2" style="border-left: none;">Sagay</td>
                <td style="border-right: unset;">Date: </td>
                <td colspan="2" style="border-left: none;">09-Sep-21</td>
            </tr>
            <tr>
                <td style="border-right: unset;">TIN:</td>
                <td colspan="2" style="border-left: none;">715-388-689-000</td>
                <td style="border-right: unset;">Mode of Procurement:</td>
                <td colspan="2" style="border-left: none;">Shopping</td>
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
            <tr style="text-align:center;font-weight:bold;">
                <td>Stock / Property No.</td>
                <td>Unit</td>
                <td>Item Description</td>
                <td>Quantity</td>
                <td>Unit Cost</td>
                <td>Amount</td>
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
            <tr style="border-top:unset;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td align="right" style="font-size: 10pt;">Total</td>
                <td align="right" style="font-weight:bold;border-top:double;"><?= number_format($total_amount, 2) ?></td>
            </tr>
            <tr style="border-top:1px solid;font-weight:bold;">
                <td style="border-right: unset;" colspan="2"> (Total Amount in Words)</td>
                <td style="border-left: unset;" colspan="4" align="center">TEN THOUSAND NINE HUNDRED FORTY ONE PESOS ONLY</td>
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
            <tr style="border:none;font-weight:bold;" align="center">
                <td colspan="3">CHARMAINE J. ZARCENO</td>
                <td colspan="3">MARLON L. SOLIVIO</td>
            </tr>
            <tr style="border:none;" align="center">
                <td colspan="3">Signature over Printed Name of Supplier</td>
                <td colspan="3">Signature over Printed Name of Authorized Official</td>
            </tr>
            <tr style="border:none;font-weight:bold;" align="center">
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
            <tr style="border-top: 2px solid;border-bottom: none;">
                <td colspan='3' style="border-left: 2px solid;">Fund Cluster: 01</td>
                <td colspan='3' style="border-left: 2px solid;border-right:2px solid;">ORS/BURS No:</td>
            </tr>
            <tr style="border-bottom: none;">
                <td colspan='3' style="border-left: 2px solid;">Fund Available:</td>
                <td colspan='3' style="border-left: 2px solid;border-right:2px solid;">Date of the ORS/BURS:</td>
            </tr>
            <tr style="border-bottom: none;">
                <td colspan='3' style="border-left: 2px solid;"></td>
                <td colspan='3' style="border-left: 2px solid;border-right:2px solid;">Amount:</td>
            </tr>
            <tr align="center" style="border-bottom: none;">
                <td colspan='3' style="border-left: 2px solid;"><u><b>MARY ANN ESTELLOSO</b></u></td>
                <td colspan='3' style="border-left: 2px solid;border-right:2px solid;"></td>
            </tr>
            <tr align="center" style="border-bottom: 2px solid;">
                <td colspan='3' style="border-left: 2px solid;">Signature over Printed Name of School Treasurer</td>
                <td colspan='3' style="border-left: 2px solid;border-right:2px solid;"></td>
            </tr>
        </table>
    </div>
</div>
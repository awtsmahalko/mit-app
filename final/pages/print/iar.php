<div class="card shadow mb-4">
    <div class="card-body">
        <table width="100%" style="margin-bottom: 5px;">
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
                <td colspan="2" style="font-size: 11pt;">Entity Name: <b>DEPARTMENT OF EDUCATION</b></td>
                <td style="font-size: 11pt;">Fund Cluster: 01</td>
            </tr>
        </table>
        <table width="100%" border='2px' style="font-size:11pt;">
            <tr style="border-bottom: none;">
                <td style="border-right: unset;">Supplier:</td>
                <td style="border-left: none;font-size:10pt;"><b>CIAN & CYAN SCHOOL SUPPLIES TRADING</b></td>
                <td style="border-right: unset;">IAR No.: </td>
                <td style="border-left: none;"><b><u>2021-07-015-ELEM</u></b></td>
            </tr>
            <tr style="border-bottom: none;">
                <td style="border-right: unset;">PO No./Date:</td>
                <td style="border-left: none;font-size:10pt;"><b>2021-07-015-ELEM</b></td>
                <td style="border-right: unset;">Date: </td>
                <td style="border-left: none;"><b><u>09-Sep-21</u></b></td>
            </tr>
            <tr style="border-bottom: none;">
                <td style="border-right: unset;">Requisitioning Office/Dept.:</td>
                <td style="border-left: none;font-size:10pt;"></td>
                <td style="border-right: unset;">Invoice No: </td>
                <td style="border-left: none;"><b><u>11819/11820</u></b></td>
            </tr>
            <tr style="border-bottom: none;">
                <td style="border-right: unset;">Requisitioning Center Code:</td>
                <td style="border-left: none;font-size:10pt;"></td>
                <td style="border-right: unset;">Date: </td>
                <td style="border-left: none;"><b><u>09-Sep-21</u></b></td>
            </tr>
        </table>
        <table width="100%" border='2px' style="font-size:11pt;">
            <tr style="border-top: none;text-align:center;font-weight:bold;font-style:italic;">
                <td>Stock / Property No.</td>
                <td colspan="3">Description</td>
                <td>Unit</td>
                <td>Quantity</td>
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
                <tr style="font-size: 9pt;">
                    <td width="10%"></td>
                    <td colspan="3"><?= $pr_items[$i]['desc'] ?></td>
                    <td align="center"><?= $pr_items[$i]['unit'] ?></td>
                    <td align="center"><?= $pr_items[$i]['qty'] ?></td>
                </tr>
            <?php } ?>
            <?php
            for ($i = 0; $i < $left_tr; $i++) {
                echo "<tr><td>&nbsp;</td><td colspan='3'></td><td></td><td></td></tr>";
            }
            ?>
            <tr style="font-weight:bold;font-style:italic;text-align:center;">
                <td colspan="3" width="50%">INSPECTION</td>
                <td colspan="3" width="50%">ACCEPTANCE</td>
            </tr>
            <tr style="border-bottom:none;height: 40px;">
                <td colspan="3">Date Inspected:</td>
                <td colspan="3">Date Received:</td>
            </tr>
            <tr style="border-bottom:none;font-size:12pt;">
                <td colspan="3">
                    <div style="margin:5px;border:1px solid;height:25px;width: 25px;float:left"></div>Inspected, verified and found in order as to quantity and specifications
                </td>
                <td colspan="3">
                    <div style="margin:5px;border:1px solid;height:25px;width: 25px;float:left"></div>Complete
                </td>
            </tr>
            <tr style="border-bottom:none;font-size:12pt;">
                <td colspan="3"></td>
                <td colspan="3">
                    <div style="margin:5px;border:1px solid;height:25px;width: 25px;float:left"></div>Partial (pls. specify quantity)
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
            <tr style="border-bottom:none;font-weight:bold;" align="center">
                <td colspan="3">REGINA D. ESPAÑOL</td>
                <td colspan="3">LYSETH MARTINEZ</td>
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
    </div>
</div>
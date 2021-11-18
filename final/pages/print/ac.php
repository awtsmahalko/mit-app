<div class="card shadow mb-4">
    <div class="card-body">
        <table width="100%">
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr align="center">
                <td colspan="3" style="font-size: 11pt;">HIMOGA-AN BAYBAY INTEGRATED SCHOOL</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td align="right" style="font-size: 9pt;">AOC No.: <u><b>2021-07-014-JHS</b></u></td>
            </tr>
            <tr align="center">
                <td colspan="3" style="font-size: 14pt;">ABSTRACT OF CANVASS</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
        </table>
        <table width="100%" border="1px">
            <tr align="center" style="font-size: 8pt;">
                <td>Name of Project: </td>
                <td></td>
                <td colspan="2">OFFICE SUPPLIES</td>
                <td colspan="2">CIAN & CYAN SCHOOL SUPPLIES TRADING</td>
                <td colspan="2"> A & E BOOKSTORE</td>
                <td colspan="2"> NOVELS TRADING</td>
            </tr>
            <tr align="center" style="font-size: 10pt;">
                <td>Item No.</td>
                <td>Quantity</td>
                <td>Unit of Issue</td>
                <td>Name & Specification of Articles</td>
                <td>Unit Price</td>
                <td>Total Amount</td>
                <td>Unit Price</td>
                <td>Total Amount</td>
                <td>Unit Price</td>
                <td>Total Amount</td>
            </tr>
            <?php
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

            for ($i = 0; $i < count($pr_items); $i++) {
                echo '<tr align="center" style="font-size:9pt;">
                    <td>' . ($i + 1) . '</td>
                    <td>' . $pr_items[$i]['qty'] . '</td>
                    <td>' . $pr_items[$i]['unit'] . '</td>
                    <td style="text-align:left;font-size:8pt;">' . $pr_items[$i]['desc'] . '</td>
                    <td></td>
                    <td align="right"></td>
                    <td></td>
                    <td align="right"></td>
                    <td></td>
                    <td align="right"></td>
                </tr>';
            }

            $tr_no = 20;
            $left_tr = $tr_no - count($pr_items);
            for ($i = 0; $i < $left_tr; $i++) {
                echo '<tr align="center">
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>';
            }
            ?>
            <tr align="center" style="font-size: 10pt;font-weight:bold;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td align="right">11,45.10</td>
                <td></td>
                <td align="right">11,45.10</td>
                <td></td>
                <td align="right">11,45.10</td>
            </tr>
        </table>
        <table width="100%" style="font-size:10pt;">
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
                <td>JUMBO CAÑETE</td>
                <td>MARY ANN ESTELLOSO</td>
                <td>CHRIS C. GABANA</td>
            </tr>
            <tr align="center" style="font-style:italic;">
                <td>Teacher</td>
                <td>Teacher</td>
                <td>Teacher</td>
            </tr>
            <tr align="center" style="font-style:italic;font-size:9pt;">
                <td>Member</td>
                <td>School League Treasurer</td>
                <td>Member</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr align="center" style="font-weight: bold;">
                <td>RUJIE VELASCO</td>
                <td>MA. RHODA A. ODELMO</td>
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
    </div>
</div>
<form id="frm_rr">
    <div class="modal fade" style="padding : 0 10px;" id="modalDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel"><span class='fa fa-pen'></span> New Receiving Order</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="save-rr" name="module">
                    <input type="hidden" name="hidden_id" id="hidden_id">

                    <div class="row">
                        <div class="col-md-4 pending" style="padding: 20px;border-radius: 8px;border: 1px solid;">
                            <div class="form-group">
                                <label for="po_id">PO No. :</label>
                                <select style="width:100%" class='form-control select2' name='po_id' id='po_id' onchange="getPoDetails()" required>
                                    <option value="">-- Please select --</option>
                                    <!--<option value="S">Super admin</option>-->
                                    <?php
                                    $fetch = $mysqli_connect->query("SELECT pr_id,po_id from tbl_purchase_order_header WHERE po_status != 'FS' ORDER BY date_modified DESC") or die($mysqli_connect->error);

                                    while ($row = $fetch->fetch_array()) {
                                        echo '<option value="' . $row['po_id'] . '">' . getData("pr_no", "tbl_purchase_request_header", "pr_id", $row['pr_id']) . '</option>';
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="rr_date">Date</label>
                                <input type="date" class="form-control" name="rr_date" id="rr_date" required autocomplete='off'>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <label for="rr_invoice">Invoice</label>
                                    <input type="number" class="form-control" name="rr_invoice" id="rr_invoice" required autocomplete='off'>
                                </div>
                                <div class="col-md-7">
                                    <label for="rr_invoice_date">Invoice Date</label>
                                    <input type="date" class="form-control" name="rr_invoice_date" id="rr_invoice_date" required autocomplete='off'>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 finish" style="padding: 20px;border-radius: 8px;border: 1px solid;">
                            <table>
                                <tr>
                                    <td>PR NO</td>
                                    <td style="font-weight:bold;text-decoration:underline;font-style:italic;font-size:15pt;" id="pr_no_html">2021-07-015-ELEM</td>
                                </tr>
                                <tr>
                                    <td>DATE</td>
                                    <td style="font-weight:bold;text-decoration:underline;font-style:italic;font-size:15pt;" id="date_html">2021-07-15</td>
                                </tr>
                                <tr>
                                    <td>INVOICE</td>
                                    <td style="font-weight:bold;text-decoration:underline;font-style:italic;font-size:15pt;" id="invoice_html">2021-07-15</td>
                                </tr>
                                <tr>
                                    <td>INVOICE DATE</td>
                                    <td style="font-weight:bold;text-decoration:underline;font-style:italic;font-size:15pt;" id="invoice_date_html">2021-07-15</td>
                                </tr>
                                <tr>
                                    <td>SUPPLIER</td>
                                    <td style="font-weight:bold;text-decoration:underline;font-style:italic;font-size:15pt;" id="supplier_html">2021-07-015- BOOKSTORE</td>
                                </tr>
                                <tr>
                                    <td>ENCODER</td>
                                    <td style="font-weight:bold;text-decoration:underline;font-style:italic;font-size:15pt;" id="encoder_html">JUAN DELA CRUZ</td>
                                </tr>
                                <tr>
                                    <td>STATUS</td>
                                    <td style="font-weight:bold;text-decoration:underline;font-style:italic;font-size:15pt;" id="status_html">FINISHED</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-8" id="col-detail">
                            <table class="table table-bordered" id="dt_detail_entries" width="100%" cellspacing="0" style="font-size: 9pt;">
                                <thead>
                                    <tr>
                                        <th style="padding:2px;">#</th>
                                        <th style="padding:2px;">UNIT</th>
                                        <th style="padding:2px;">ITEM</th>
                                        <th style="padding:2px;">PO QTY</th>
                                        <th style="padding:2px;" class="pending">REMAIN</th>
                                        <th style="padding:2px;">RECEIVE</th>
                                    </tr>
                                </thead>
                                <tbody id="rr">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class='btn-group'>
                        <button type="button" class="btn btn-secondary btn-sm finish" id="print-iar"><span class='fa fa-print'></span> IAR</button>
                        <button type="submit" class="btn btn-primary btn-sm pending" id="btn_finish_submit"><span class='fa fa-check-circle'></span> Finish Receiving</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
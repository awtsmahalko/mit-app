<form id="frm_po">
    <div class="modal fade" style="padding : 0 10px;" id="modalDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel"><span class='fa fa-pen'></span> New Purchase Order</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="save-po" name="module">
                    <input type="hidden" name="hidden_id" id="hidden_id">

                    <div class="row">
                        <div class="col-md-4 pending" style="padding: 20px;border-radius: 8px;border: 1px solid;">
                            <div class="form-group">
                                <label for="canvass_id">PR No.</label>
                                <select style="width:100%" class='form-control select2' name='canvass_id' id='canvass_id' onchange="changePo()" required>
                                    <option value="">-- Please select --</option>
                                    <!--<option value="S">Super admin</option>-->
                                    <?php
                                    $fetch = $mysqli_connect->query("SELECT pr_id,canvass_id from tbl_canvass_header WHERE canvass_status = 'F' ORDER BY date_modified DESC") or die($mysqli_connect->error);

                                    while ($row = $fetch->fetch_array()) {
                                        echo '<option value="' . $row['canvass_id'] . '">' . getData("pr_no", "tbl_purchase_request_header", "pr_id", $row['pr_id']) . '</option>';
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="po_date">Date</label>
                                <input type="date" class="form-control" name="po_date" id="po_date" required autocomplete='off'>
                            </div>
                            <div class="form-group">
                                <label for="supplier_id">Lowest bidder Supplier</label>
                                <select style="width:100%" class='form-control select2' name='supplier_id' id='supplier_id' onchange="getCanvass()" required>
                                    <option value="">-- Please select --</option>
                                </select>
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
                                    <td style="font-weight:bold;text-decoration:underline;font-style:italic;font-size:15pt;" id="date_html">2021-07-015</td>
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
                                        <th style="padding:2px;"></th>
                                        <th style="padding:2px;">UNIT</th>
                                        <th style="padding:2px;">ITEM</th>
                                        <th style="padding:2px;">QTY</th>
                                        <th style="padding:2px;">COST</th>
                                        <th style="padding:2px;">AMOUNT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total Amount</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class='btn-group finish'>
                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fa fa-print"></span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item approve" href="#" id="print-po">Purchase Order</a>
                            <a class="dropdown-item approve" href="#" id="print-iar">Inspection and Acceptance Report</a>
                        </div>
                    </div>
                    <div class='btn-group'>
                        <button type="submit" class="btn btn-primary btn-sm pending" id="btn_finish_submit"><span class='fa fa-check-circle'></span> Finish Purchase Order</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
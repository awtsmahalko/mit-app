<form action="" method='POST' id='frm_submit' class="purchase_request">
    <div class="modal fade" id="modalEntry" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel"><span class='fa fa-pen'></span> Update Entry</h4>
                    <input type="hidden" name="hidden_id" id="hidden_id" required>
                    <input type="hidden" name="module" id="module" required>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pr_department">Department</label>
                        <select class='form-control select2' style="width: 100%;" name='pr_department' id='pr_department' required>
                            <option value="">-- Please select --</option>
                            <!--<option value="S">Super admin</option>-->
                            <option value="ELEM">ELEMENTARY</option>
                            <option value="JHS">JUNIOR HIGH SCHOOL</option>
                            <option value="SHS">SENIOR HIGH SCHOOL</option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="pr_year">PR Year</label>
                            <input type="number" min="1970" class="form-control" name="pr_year" id="pr_year" required autocomplete='off'>
                        </div>
                        <div class="col-md-4">
                            <label for="pr_mo">Month(1-12)</label>
                            <input type="number" min="1" max="12" class="form-control" name="pr_mo" id="pr_mo" required autocomplete='off'>
                        </div>
                        <div class="col-md-4">
                            <label for="pr_batch">PR Sequence</label>
                            <input type="number" min="1" class="form-control" name="pr_batch" id="pr_batch" required autocomplete='off'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pr_date">Date</label>
                        <input type="date" class="form-control" name="pr_date" id="pr_date" required autocomplete='off'>
                    </div>
                    <div class="form-group">
                        <label for="pr_purpose">Purpose</label>
                        <textarea class="form-control" name="pr_purpose" id='pr_purpose' required autocomplete='off'></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class='btn-group'>
                        <button type="submit" class="btn btn-primary btn-sm" id="btn_submit"><span class='fa fa-check-circle'></span> Submit</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="" method='POST' id='frm_assist_submit' class="purchase_request">
    <div class="modal fade" id="modalAssist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalAssistLabel"></h4>
                    <input type="hidden" name="hidden_id" value="0" id="assist_hidden_id" required>
                    <input type="hidden" name="module" value="approve-pr" id="assist_module" required>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pr_id">PR No</label>
                        <select class='form-control select2' style="width: 100%;" name='pr_id' id='pr_id' required>
                            <option value="">-- Please select --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pr_mode">Mode of Procurement</label>
                        <select class='form-control select2' style="width: 100%;" name='pr_mode' id='pr_mode' required>
                            <option value="">-- Please select --</option>
                            <!--<option value="S">Super admin</option>-->
                            <option value="Shopping">Shopping</option>
                            <option value="Small Value">Small Value</option>
                            <option value="Bidding">Bidding</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pr_expense">Expense Type</label>
                        <select class='form-control select2' style="width: 100%;" name='pr_expense' id='pr_expense' required>
                            <option value="">-- Please select --</option>
                            <!--<option value="S">Super admin</option>-->
                            <option value="Office Supplies">Office Supplies</option>
                            <option value="Other supplies and materials">Other supplies and materials</option>
                            <option value="Repair and maintenance materials">Repair and maintenance materials</option>
                            <option value="Telephone Expense">Telephone Expense</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pr_suppliers">Assist Vendors</label>
                        <select class='form-control select2' style="width: 100%;" name='pr_suppliers[]' id='pr_suppliers' multiple="multiple" required>
                            <option value="">-- Please select --</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class='btn-group'>
                        <button type="submit" class="btn btn-primary btn-sm" id="btn_assist_submit"><span class='fa fa-check-circle'></span> Approve PR and Assist Vendor</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" style="padding : 0 10px;" id="modalDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalLabel">
                    <span class='fa fa-pen'></span> PR NO: <span id="pr_no_html" style="font-weight: bold;font-style:italic;text-decoration:underline;"></span>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 pending" style="padding: 20px;border:1px solid;border-radius: 10px;">
                        <form method='POST' id='frm_submit_details' class="purchase_request_details">
                            <input type="hidden" name="hidden_id" id="update_hidden_id" required>
                            <input type="hidden" name="module" id="update_module" value="add-detail" required>
                            <div class="form-group">
                                <label for="item_id">Item</label>
                                <select style="width:100%" class='form-control select2' name='item_id' id='item_id' onchange="changeItem()" required>
                                    <option value="">-- Please select --</option>
                                    <?php
                                    $fetch = $mysqli_connect->query("SELECT item_id,item_name from tbl_items ORDER BY item_name ASC") or die($mysqli_connect->error);

                                    while ($row = $fetch->fetch_array()) {
                                        echo '<option value="' . $row['item_id'] . '">' . $row['item_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="packaging_id">Unit</label>
                                <select style="width:100%" class='form-control select2' name='packaging_id' id='packaging_id' required>
                                    <option value="">-- Please select --</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="qty">Qty</label>
                                    <input type="number" step=".01" class="form-control" name="qty" id="qty" required autocomplete='off'>
                                </div>
                                <div class="col-md-6">
                                    <label for="cost">Cost</label>
                                    <input type="number" step=".01" class="form-control" name="cost" id="cost" required autocomplete='off'>
                                </div>
                            </div>
                            <div class='btn-group' style="float: right;">
                                <button type="submit" class="btn btn-primary btn-sm" id="btn_det_submit"><span class='fa fa-plus-circle'></span> Add Detail</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8" id="col-detail">
                        <div class='btn-group pending' style="float: right;">
                            <button type="button" class="btn btn-danger btn-sm" id="btn_remove" onclick="deleteDetailsEntry()"><span class='fa fa-trash'></span> Remove Detail</button>
                        </div>
                        <table class="table table-bordered" id="dt_detail_entries" width="100%" cellspacing="0" style="font-size: 9pt;">
                            <thead>
                                <tr>
                                    <th style="padding:2px;"><input type='checkbox' onchange="checkAll(this, 'dt_detail_id')"></th>
                                    <th style="padding:2px;">UNIT</th>
                                    <th style="padding:2px;">ITEM</th>
                                    <th style="padding:2px;width:10%;">QTY</th>
                                    <th style="padding:2px;width:10%;">COST</th>
                                    <th style="padding:2px;width:10%;">AMOUNT</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group finish-approve">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="fa fa-print"></span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item finish-approve finish" href="#" id="print-pr">Purchase Request</a>
                        <a class="dropdown-item approve" href="#" id="print-bac">BAC Resolution 1</a>
                        <a class="dropdown-item approve" href="#" id="print-rfq">Request for Quotation</a>
                    </div>
                </div>
                <div class='btn-group'>
                    <button type="button" class="btn btn-primary btn-sm pending" id="btn_finish_submit" onclick="finishPr()"><span class='fa fa-check-circle'></span> Finish Purchase Request</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
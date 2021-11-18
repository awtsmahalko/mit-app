<form action="" method='POST' id='frm_submit'>
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
                        <label for="department">Department</label>
                        <select class='form-control select2' style="width: 100%;" name='department' id='department' required>
                            <option value="">-- Please select --</option>
                            <!--<option value="S">Super admin</option>-->
                            <option value="ELEM">ELEMENTARY</option>
                            <option value="JHS">JUNIOR HIGH SCHOOL</option>
                            <option value="SHS">SENIOR HIGH SCHOOL</option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8">
                            <label for="release_date">Date</label>
                            <input type="date" class="form-control" name="release_date" id="release_date" required autocomplete='off'>
                        </div>
                        <div class="col-md-4">
                            <label for="release_days_consume">Days Consume</label>
                            <input min="1" type="number" class="form-control" name="release_days_consume" id="release_days_consume" required autocomplete='off'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="remarks">Remarks</label>
                        <textarea class="form-control" name="remarks" id='remarks' required autocomplete='off'></textarea>
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

<div class="modal fade" style="padding : 0 10px;" id="modalDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="modalLabel">
                    <span class='fa fa-pen'></span> ISSUE NO: <span id="pr_no_html" style="font-weight: bold;font-style:italic;text-decoration:underline;"></span>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 pending" style="padding: 20px;border:1px solid;border-radius:10px;">
                        <form action="" method='POST' id='frm_submit_details' class="purchase_request_details">
                            <input type="hidden" name="hidden_id" id="update_hidden_id" required>
                            <input type="hidden" name="module" id="update_module" value="add-detail" required>
                            <div class="form-group">
                                <label for="item_id">Item</label>
                                <select style="width:100%" class='form-control select2' name='item_id' id='item_id' onchange="fetchCurrentQty()" required>
                                    <option value="">-- Please select --</option>
                                    <!--<option value="S">Super admin</option>-->
                                    <?php
                                    $fetch = $mysqli_connect->query("SELECT i.item_id,item_name,p.packaging_id, packaging_name from tbl_items AS i, tbl_items_packaging AS ip,tbl_packaging AS p WHERE ip.item_id = i.item_id AND ip.packaging_id = p.packaging_id ORDER BY item_name ASC") or die($mysqli_connect->error);

                                    while ($row = $fetch->fetch_array()) {
                                        echo '<option value="' . $row['item_id'] . '-' . $row['packaging_id'] . '">' . $row['item_name'] . ' (' . $row['packaging_name'] . ') </option>';
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="qty">Qty <span id="curr" style="font-size: 10pt;color:green;">(1)</span></label>
                                <input type="number" step=".01" class="form-control" name="qty" id="qty" required autocomplete='off'>
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
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class='btn-group'>
                    <button type="button" class="btn btn-primary btn-sm pending" id="btn_finish_submit" onclick="finishRelease()"><span class='fa fa-check-circle'></span> Finish Releasing</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
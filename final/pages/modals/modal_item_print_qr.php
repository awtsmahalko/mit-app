<form id="printQr">
    <div class="modal fade" id="modalPrintQr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class='fa fa-print'></span> Print Qr</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group" style="padding:5px;">
                        <label>Items</label>
                        <select class="form-control select2" style="width: 100%;" id="print_item_id" onchange="fetchPackaging()" required>
                            <option value="">&mdash; Please Select &mdash;</option>
                            <?php
                            $fetch_items = $mysqli_connect->query("SELECT * from tbl_items ORDER BY item_name ASC") or die($mysqli_connect->error);

                            while ($rowItem = $fetch_items->fetch_array()) {
                                echo "<option value='$rowItem[item_id]'> $rowItem[item_name]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group row" style="padding:5px;">
                        <div class="col-md-8">
                            <label>Unit</label>
                            <select class="form-control select2" style="width: 100%;" id="print_packaging_id" required>
                                <option value="">&mdash; Please Select &mdash;</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Qty</label>
                            <input type="number" min="1" class="form-control" style="height: 28px;" id="print_qty" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class='btn-group'>
                        <button type="submit" class="btn btn-primary btn-sm" id="btn_submit3"><span class='fa fa-check-circle'></span> Print</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
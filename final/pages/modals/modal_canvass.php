<form action="" method='POST' id='frm_submit' class="users">
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
                        <label for="pr_id">PR No.</label>
                        <select style="width:100%" class='form-control select2' name='pr_id' id='pr_id' onchange="fetchSuppliers()" required>
                            <option value="">-- Please select --</option>
                            <?php
                            $fetch = $mysqli_connect->query("SELECT pr_id,pr_no from tbl_purchase_request_header WHERE pr_status = 'A' ORDER BY date_modified DESC") or die(mysqli_error());

                            while ($row = $fetch->fetch_array()) {
                                echo '<option value="' . $row['pr_id'] . '">' . $row['pr_no'] . '</option>';
                            }

                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="canvass_date">Date</label>
                        <input type="date" class="form-control" name="canvass_date" id="canvass_date" autocomplete='off'>
                    </div>
                    <div class="form-group">
                        <label for="pr_id">Suppliers</label>
                        <select style="width:100%" class='form-control select2' name='supplier_id[]' id='supplier_id' multiple="multiple" required>
                            <option value="">-- Please select --</option>
                        </select>
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


<form id="frm_canvass">
    <div class="modal fade" style="padding : 0 10px;" id="modalDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel"><span class='fa fa-pen'></span> CANVASS PR NO: <span id="canvass-po" style="font-weight: bold;font-style:italic;text-decoration:underline;"></span></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="save-canvass" name="module">
                    <input type="hidden" name="hidden_id" id="update_canvass_id">
                    <div id="canvass">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group finish">
                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fa fa-print"></span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" id="print-aoc">Abstract of Canvass</a>
                            <a class="dropdown-item" href="#" id="print-bac">BAC Resolution 2</a>
                        </div>
                    </div>
                    <div class='btn-group'>
                        <?php if ($_SESSION['category'] == 'AA') { ?>
                            <button type="submit" class="btn btn-primary btn-sm pending" id="btn_finish_submit"><span class='fa fa-check-circle'></span> Finish Canvassing</button>
                        <?php } ?>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Stock Card</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group" style="padding:5px;">
                        <label for="item_id"><strong>Item</strong></label>
                        <select style="width:100%" class='form-control select2' name='item_id' id='item_id' onchange="changeItem()" required>
                            <option value="">-- Please select --</option>
                            <!--<option value="S">Super admin</option>-->
                            <?php
                            $fetch = $mysqli_connect->query("SELECT item_id,item_name from tbl_items ORDER BY item_name ASC") or die(mysqli_error());

                            while ($row = $fetch->fetch_array()) {
                                echo '<option value="' . $row['item_id'] . '">' . $row['item_name'] . '</option>';
                            }

                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" style="padding:5px;">
                        <label for="packaging_id"><strong>Packaging</strong></label>
                        <select style="width:100%" class='form-control select2' name='packaging_id' id='packaging_id' required>
                            <option value="">-- Please select --</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group" style="padding:5px;">
                        <label><strong></strong></label>
                        <div class="form-group-btn">
                            <button type="button" class="btn btn-primary btn-icon-split" id="btn_generate" onclick="generate_report()">
                                <span class="icon text-white-50">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                                <span class="text" id="text_generate">Generate Report</span>
                            </button>
                            <button type="button" class="btn btn-secondary btn-icon-split" onclick="printDiv('report-1')">
                                <span class="icon text-white-50">
                                    <i class="fas fa-print"></i>
                                </span>
                                <span class="text">Print Report</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body" id="report-1">
            <br>
            <div class="container-fluid">
                <div id="report_data"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".select2").select2();
    });

    function changeItem() {
        $("#packaging_id").html("");
        $.ajax({
            type: "POST",
            url: "ajax/update_purchase_request.php",
            data: {
                module: 'fetch-packaging',
                hidden_id: 0,
                item_id: $("#item_id").val()
            },
            success: function(data) {
                var res = JSON.parse(data);
                $("#packaging_id").html(res.data);
            }
        });
    }


    function generate_report() {

        var item_id = $("#item_id").val();
        var packaging_id = $("#packaging_id").val();

        if (item_id == "") {
            alert("Please select item.");
        } else if (packaging_id == "") {
            alert("Please select packaging.");
        } else {

            $("#btn_generate").prop('disabled', true);
            $.ajax({
                type: "POST",
                url: "ajax/stock_card.php",
                data: {
                    item_id: item_id,
                    packaging_id: packaging_id
                },
                success: function(data) {
                    // alert(data);
                    $("#report_data").html(data);
                    $("#btn_generate").prop('disabled', false);
                }
            });
        }

    }

    function printDiv(container) {

        var printContents = document.getElementById(container).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;

    }
</script>
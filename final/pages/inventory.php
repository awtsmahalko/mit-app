<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Inventory</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form id="generate_report">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group" style="padding:5px;">
                            <label for="department">Department</label>
                            <select style="width:100%" class='form-control select2' name='department' id='department' required>
                                <option value="">-- Please select --</option>
                                <option value="ELEM"> ELEMENTARY </option>
                                <option value="JHS"> JUNIOR HIGH SCHOOL </option>
                                <option value="SHS"> SENIOR HIGH SCHOOL </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" style="padding:5px;">
                            <label for="month">Month</label>
                            <select style="width:100%" class='form-control select2' name='month' id='month' required>
                                <option value="">&mdash; Select &mdash;</option>
                                <?php
                                for ($i = 1; $i < 13; $i++) {
                                    echo '<option value="' . $i . '"> ' . date("F", strtotime("2020-$i-01")) . ' </option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" style="padding:5px;">
                            <label for="year">Year</label>
                            <input style="height: 30px;" min="1970" max="<?= date('Y') ?>" type="number" class='form-control' name='year' id='year' required>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group" style="padding:5px;">
                            <label><strong></strong></label>
                            <div class="form-group-btn">
                                <button type="submit" class="btn btn-primary btn-icon-split" id="btn_generate">
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
            </form>
        </div>
        <div class="card-body" id="report-1">
            <div class="container-fluid" id="report_header">Inventory</div>
            <div class="container-fluid" id="report_date"></div>
            <br>
            <div class="container-fluid">
                <table class="table table-bordered" id="dt_entries" width="100%" cellspacing="0">
                    <thead align="center">
                        <tr>
                            <th style="padding:2px;vertical-align: middle;" rowspan="2">#</th>
                            <th style="padding:2px;vertical-align: middle;" rowspan="2">Name & Specification of Articles</th>
                            <th style="padding:2px;vertical-align: middle;" rowspan="2">Unit of Issue</th>
                            <th style="padding:2px;" colspan="3">Quantity</th>
                        </tr>
                        <tr>
                            <th style="padding:2px;">Receipt</th>
                            <th style="padding:2px;">Issuance</th>
                            <th style="padding:2px;">Balance</th>
                        </tr>
                    </thead>
                    <tbody id="report_data">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".select2").select2();
    });



    $("#generate_report").submit(function(e) {
        e.preventDefault();

        var month_text = $("#month option:selected").text();
        var department = $("#department option:selected").text();
        var year_text = $("#year").val();
        $("#btn_generate").prop('disabled', true);
        $("#report_date").html("As of " + month_text + " " + year_text + "<br>" + department + " DEPARTMENT");
        $.ajax({
            type: "POST",
            url: "ajax/inventory.php",
            data: $("#generate_report").serialize(),
            success: function(data) {
                $("#report_data").html(data);
                $("#btn_generate").prop('disabled', false);
            }
        });
    });

    function printDiv(container) {

        var printContents = document.getElementById(container).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;

    }
</script>
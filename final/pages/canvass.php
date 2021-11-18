<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Canvassing</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <?php if ($_SESSION['category'] == 'AA') { ?>
            <div class="card-header py-3">
                <!--<h6 class="m-0 font-weight-bold text-primary">List of Users</h6>-->
                <div class="btn-group pull-right">
                    <a href="#" class="btn btn-primary btn-sm btn-icon-split" onclick="showAddModal()">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Add Entry</span>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm btn-icon-split" onclick='deleteEntry()' id='btn_delete'>
                        <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="text">Delete Entry</span>
                    </a>
                </div>
            </div>
        <?php } ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dt_entries" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><input type='checkbox' onchange="checkAll(this, 'dt_id')"></th>
                            <th></th>
                            <th>PR No</th>
                            <th>Date</th>
                            <th>Suppliers</th>
                            <th>BY</th>
                            <th>Status</th>
                            <th>Date Modified</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require_once 'modals/modal_canvass.php'; ?>
</div>
<script type="text/javascript">
    var item_qty = [];
    $(document).ready(function() {
        $(".select2").select2();

        getEntries();
    });

    function getEntries() {
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "ajax": {
                "url": "ajax/datatables/canvass.php",
                "dataSrc": "data"
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return row.canvass_status == 'F' ? "" : "<input type='checkbox' value=" + row.id + " class='dt_id' style='position: initial; opacity:1;'>";
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        var print_btn = '';
                        if (row.canvass_status == 'F') {
                            print_btn += '<button type="button" class="btn btn-secondary btn-circle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                '<span class="fa fa-print"></span>' +
                                '</button>' +
                                '<div class="dropdown-menu">' +
                                '<a class="dropdown-item" href="#" onclick="printAoc(' + row.id + ')">Abstract of Canvass</a>' +
                                '<a class="dropdown-item" href="#" onclick="printBac2(' + row.id + ')">BAC Resolution 2</a>' +
                                '</div>';
                        }
                        return "<center><button class='btn btn-info btn-circle btn-sm' onclick='getEntryDetails(" + row.id + ")'><span class='fa fa-pen'></span></button>" + print_btn + "</center>";
                    }
                },
                {
                    "data": "pr_no"
                },
                {
                    "data": "dates"
                },
                {
                    "data": "supplier"
                },
                {
                    "data": "by"
                },
                {
                    "data": "status"
                },
                {
                    "data": "date_modified"
                }
            ]
        });
    }

    function getEntryDetails(id) {
        document.getElementById("print-bac").setAttribute("onclick", "printBac2(" + id + ")");
        document.getElementById("print-aoc").setAttribute("onclick", "printAoc(" + id + ")");
        $("#update_canvass_id").val(id);
        $("#modalDetails").modal('show');

        $.ajax({
            type: "POST",
            url: "ajax/update_canvass.php",
            data: {
                module: 'fetch-canvass',
                hidden_id: id
            },
            success: function(data) {
                var res = JSON.parse(data);
                $("#canvass-po").html(res.pr_no);
                console.log(res);
                var skin_tr = '',
                    skin_sup = '',
                    skin_head = '',
                    skin_total = '';
                if (res.supplier.length > 0) {
                    for (let index = 0; index < res.supplier.length; index++) {
                        const supElem = res.supplier[index];

                        skin_sup += '<th style="padding:2px;font-size:8pt;text-align:center;" colspan="2">' + supElem.name + '</th>';

                        skin_head += '<th style="padding: 2px;width:10%;font-size:11pt;">COST</th>' +
                            '<th style="padding: 2px;font-size:11pt;">AMOUNT</th>';

                        skin_total += '<td style="padding: 2px;"></td>' +
                            '<td style="padding: 2px;" id="total-amount-' + supElem.id + '"></td>';
                    }
                }
                item_qty = [];
                if (res.item.length > 0) {
                    for (let index = 0; index < res.item.length; index++) {
                        const itemElem = res.item[index];
                        item_qty[itemElem.id + '-' + itemElem.packaging_id] = itemElem.qty;

                        skin_tr += '<tr>' +
                            '<td style="padding: 2px;font-size:10pt;">' + (index + 1) + '</td>' +
                            '<td style="padding: 2px;font-size:10pt;">' + itemElem.unit + '</td>' +
                            '<td style="padding: 2px;font-size:10pt;">' + itemElem.name + '</td>' +
                            '<td style="padding: 2px;font-size:10pt;">' + itemElem.qty + '</td>';

                        if (res.supplier.length > 0) {
                            for (let supIndex = 0; supIndex < res.supplier.length; supIndex++) {
                                const supElem = res.supplier[supIndex];

                                if (res.canvass_status == 'F') {
                                    // var item_pkg = res.costs[itemElem.id][itemElem.packaging_id];
                                    var cost_stored = res.costs[itemElem.id][itemElem.packaging_id][supElem.id];
                                    var readonly = 'readonly';
                                } else {
                                    var cost_stored = '';
                                    var readonly = '';
                                }
                                skin_tr += '<td style="padding: 2px;"><input type="number" value="' + cost_stored + '" name="costs[' + itemElem.id + '][' + itemElem.packaging_id + '][' + supElem.id + ']" step=".01" min=".01" class="form-control-2 cost-sup-' + supElem.id + '" data-item="' + itemElem.id + '" data-pkg="' + itemElem.packaging_id + '" onkeyup="getAmount(' + supElem.id + ')" ' + readonly + ' required></td>' +
                                    '<td style="padding: 2px;" id="amount-' + itemElem.id + '-' + itemElem.packaging_id + '-' + supElem.id + '"></td>';
                            }
                        }
                        skin_tr += '</tr>';

                    }
                    skin_tr += '<tr><td style="padding: 2px;" colspan="4">Total</td>' + skin_total + '</tr>';
                }

                var table_skin = '<table class="table table-bordered">' +
                    '<tr>' +
                    '<th style="padding:2px;vertical-align:middle;" rowspan="2">#</th>' +
                    '<th style="padding:2px;vertical-align:middle;" rowspan="2">UNIT</th>' +
                    '<th style="padding:2px;vertical-align:middle;" rowspan="2">ITEM NAME</th>' +
                    '<th style="padding:2px;vertical-align:middle;" rowspan="2">QTY</th>' + skin_sup +
                    '</tr>' +
                    '<tr>' + skin_head +
                    '</tr>' + skin_tr +
                    '</table>';
                $("#canvass").html(table_skin);

                if (res.canvass_status == 'F') {
                    $(".pending").hide();
                    $(".finish").show();
                    if (res.supplier.length > 0) {
                        for (let index = 0; index < res.supplier.length; index++) {
                            const supElem = res.supplier[index];
                            getAmount(supElem.id);
                        }
                    }
                } else {
                    $('.pending').show();
                    $(".finish").hide();
                }
            }
        });
    }

    function getAmount(sup_id) {
        var total_amount = 0;
        $(".cost-sup-" + sup_id).map(function() {
            var itemid = this.getAttribute('data-item');
            var pkgid = this.getAttribute('data-pkg');
            var amount = item_qty[itemid + '-' + pkgid] * this.value;

            $("#amount-" + itemid + '-' + pkgid + '-' + sup_id).html(amount.toFixed(2));
            total_amount += amount;
        });
        $("#total-amount-" + sup_id).html(total_amount.toFixed(2));
    }

    $("#frm_canvass").submit(function(e) {
        e.preventDefault();

        $("#btn_finish_submit").prop('disabled', true);
        $("#btn_finish_submit").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");
        $.ajax({
            type: "POST",
            url: "ajax/update_canvass.php",
            data: $("#frm_canvass").serialize(),
            success: function(data) {
                var res = JSON.parse(data);
                console.log(res);
                if (res.data == 1) {
                    success_add();

                    $("#modalDetails").modal('hide');
                    getEntries();

                    $("#frm_canvass").each(function() {
                        this.reset();
                    });
                } else {
                    //alert('Something is wrong. Failed to execute query. Please try again.');
                    failed_query(res);
                }

                $("#btn_finish_submit").prop('disabled', false);
                $("#btn_finish_submit").html("<span class='fa fa-check-circle'></span> Finish Canvassing");
            }
        });

    });

    function showAddModal() {
        fetchSuppliers();
        $("#frm_submit").each(function() {
            this.reset();
        });
        $(".select2").select2().trigger('change');
        $("#module").val('add');
        $("#modalLabel").html("<span class='fa fa-plus-circle'></span> Add Entry");
        $("#modalEntry").modal('show');
    }

    function fetchSuppliers() {
        $.ajax({
            url: 'ajax/update_purchase_request.php',
            method: 'POST',
            data: {
                hidden_id: $("#pr_id").val(),
                module: 'fetch-supplier',
            },
            success: function(data) {
                var res = JSON.parse(data);
                $("#supplier_id").html(res.data);
            }
        });
    }
    $("#frm_submit").submit(function(e) {
        e.preventDefault();

        $("#btn_submit").prop('disabled', true);
        $("#btn_submit").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");
        var frm_module = $("#module").val();

        $.ajax({
            type: "POST",
            url: "ajax/update_canvass.php",
            data: $("#frm_submit").serialize(),
            success: function(data) {
                var res = JSON.parse(data);
                if (res.data == 1) {
                    success_add();

                    $("#modalEntry").modal('hide');
                    getEntries();
                    getEntryDetails(res.id);
                    $("#frm_submit").each(function() {
                        this.reset();
                    });
                } else if (res.data == 2) {
                    //alert('Cannot proceed. Entry already exists.');
                    entry_already_exists();
                } else {
                    //alert('Something is wrong. Failed to execute query. Please try again.');
                    failed_query(res);
                }

                $("#btn_submit").prop('disabled', false);
                $("#btn_submit").html("<span class='fa fa-check-circle'></span> Submit");
            }
        });

    });

    function deleteEntry() {

        var count_checked = $("input[class='dt_id']:checked").length;
        if (count_checked > 0) {
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover these entries!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        var checkedValues = $("input[class='dt_id']:checked").map(function() {
                            return this.value;
                        }).get();

                        $("#btn_delete").prop('disabled', true);
                        deletePermanent(checkedValues, "tbl_canvass_header", "canvass_id");
                        deletePermanent(checkedValues, "tbl_canvass_suppliers", "canvass_id");
                    } else {
                        swal("Cancelled", "Entries are safe :)", "error");
                    }
                });
        } else {
            swal("Cannot proceed!", "Please select entries to delete!", "warning");
        }
    }

    function deletePermanent(checkedValues, tb, keyword) {
        $.ajax({
            type: "POST",
            url: "ajax/deleteBulkEntries.php",
            data: {
                id: checkedValues,
                tb: tb,
                keyword: keyword
            },
            success: function(data) {
                if (data == 1) {
                    //alert('Successfully deleted entries.');
                    success_delete();
                    getEntries();
                } else {
                    //alert('Something is wrong. Failed to execute query. Please try again.');
                    //alert(data);
                    failed_query(data);
                }

                $("#btn_delete").prop('disabled', false);
            }
        });

    }

    function printAoc(id) {
        $.ajax({
            method: "POST",
            url: "print/forms/abstract_of_canvass.php",
            data: {
                canvass_id: id
            },
            success: function(data) {
                var myWindow = window.open('', 'Print Abstract of Canvass', 'height=600,width=900');
                myWindow.document.write('<html><head><title>Print Abstract of Canvass</title>');
                myWindow.document.write('</head><body>');
                myWindow.document.write(data);
                myWindow.document.write('</body></html>');
                myWindow.document.close(); // necessary for IE >= 10

                // myWindow.focus(); // necessary for IE >= 10
                myWindow.print();
            }
        });
    }

    function printBac2(id) {
        $.ajax({
            method: "POST",
            url: "print/forms/bac_resolution_2.php",
            data: {
                canvass_id: id
            },
            success: function(data) {
                var myWindow = window.open('', 'Print Bac Resolution 2', 'height=600,width=900');
                myWindow.document.write('<html><head><title>Print Bac Resolution 2</title>');
                myWindow.document.write('</head><body>');
                myWindow.document.write(data);
                myWindow.document.write('</body></html>');
                myWindow.document.close(); // necessary for IE >= 10

                // myWindow.focus(); // necessary for IE >= 10
                setTimeout(function() {
                    myWindow.print();
                }, 500)
            }
        });
    }
</script>
<style>
    .form-control-2 {
        display: block;
        width: 100%;
        height: 25px;
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #6e707e;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #d1d3e2;
        border-radius: .35rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }
</style>
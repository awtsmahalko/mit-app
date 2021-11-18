<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Receive Stocks</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
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
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dt_entries" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><input type='checkbox' onchange="checkAll(this, 'dt_id')"></th>
                            <th></th>
                            <th>PR No</th>
                            <th>Date</th>
                            <th>Supplier</th>
                            <th>Invoice</th>
                            <th>Amount</th>
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
    <?php require_once 'modals/modal_receiving.php'; ?>
</div>
<script>
    $(document).ready(function() {
        getEntries();
        $('.select2').select2();
    });

    function showAddModal() {
        $("#frm_rr").each(function() {
            this.reset();
        });
        $(".select2").select2().trigger('change');

        getPoDetails();

        $("#modalLabel").html("<span class='fa fa-pen'></span> New Receive Stocks");
        $("#modalDetails").modal('show');

        $('.pending').show();
        $('.finish').hide();
    }

    function getEntryDetails(id) {
        document.getElementById("print-iar").setAttribute("onclick", "printIar(" + id + ")");
        $.ajax({
            method: "POST",
            url: "ajax/update_receiving.php",
            data: {
                hidden_id: id,
                module: 'fetch-rr-data'
            },
            success: function(data) {
                var res = JSON.parse(data);
                console.log(res);
                $("#pr_no_html").html(res.pr_no);
                $("#date_html").html(res.date);
                $("#invoice_html").html(res.invoice);
                $("#invoice_date_html").html(res.invoice_d);
                $("#supplier_html").html(res.supplier);
                $("#encoder_html").html(res.encoder);
                $("#status_html").html(res.status);

                $("#modalLabel").html("<span class='fa fa-eye'></span> View Receiving");
                $("#modalDetails").modal('show');
                getPoDetails(id);
                $('.pending').hide();
                $('.finish').show();
            }
        });
    }

    function getEntries() {
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "ajax": {
                "url": "ajax/datatables/receiving.php",
                "dataSrc": "data"
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return "<input type='checkbox' value=" + row.id + " class='dt_id' style='position: initial; opacity:1;'>";
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        return "<center><button class='btn btn-info btn-circle btn-sm' onclick='getEntryDetails(" + row.id + ")'><span class='fa fa-pen'></span></button><button class='btn btn-secondary btn-circle btn-sm' onclick='printIar(" + row.id + ")'><span class='fa fa-print'></span></button></center>";
                    }
                },
                {
                    "data": "pr_no"
                },
                {
                    "data": "rr_date"
                },
                {
                    "data": "supplier"
                },
                {
                    "data": "invoice"
                },
                {
                    "data": "amount"
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

    function getPoDetails(id = 0) {

        $.ajax({
            type: "POST",
            url: "ajax/update_receiving.php",
            data: {
                module: 'fetch-po',
                hidden_id: id,
                po_id: $("#po_id").val()
            },
            success: function(data) {
                var res = JSON.parse(data);
                console.log(res);
                var skin_tr = '',
                    skin_sup = '',
                    skin_head = '',
                    skin_total = '';

                item_qty = [];
                if (res.item.length > 0) {
                    for (let index = 0; index < res.item.length; index++) {
                        const itemElem = res.item[index];
                        item_qty[itemElem.id + '-' + itemElem.packaging_id] = itemElem.qty;

                        if (id > 0) {
                            var rr_input = itemElem.qty;
                        } else {
                            var rr_input = '<input type="hidden" name="costs[' + itemElem.id + '][' + itemElem.packaging_id + ']" value="' + itemElem.cost + '">' +
                                '<input type="hidden" name="orig_qty[' + itemElem.id + '][' + itemElem.packaging_id + ']" value="' + itemElem.orig_qty + '">' +
                                '<input type="hidden" name="remain_qty[' + itemElem.id + '][' + itemElem.packaging_id + ']" value="' + itemElem.remain_qty + '">' +
                                '<input type="number" name="rr_qty[' + itemElem.id + '][' + itemElem.packaging_id + ']" step=".01" min="0" max="' + itemElem.remain_qty + '" class="form-control-2" data-item="' + itemElem.id + '" data-pkg="' + itemElem.packaging_id + '" required>';
                        }
                        skin_tr += '<tr>' +
                            '<td style="padding: 2px;font-size:10pt;">' + (index + 1) + '</td>' +
                            '<td style="padding: 2px;font-size:10pt;">' + itemElem.unit + '</td>' +
                            '<td style="padding: 2px;font-size:10pt;">' + itemElem.name + '</td>' +
                            '<td style="padding: 2px;font-size:10pt;">' + itemElem.orig_qty + '</td>' +
                            (id > 0 ? '' : '<td style="padding: 2px;font-size:10pt;">' + itemElem.remain_qty + '</td>') +
                            '<td style="padding: 2px;">' + rr_input + '</td>' +
                            '</tr>';

                    }
                }

                $("#rr").html(skin_tr);
            }
        });
    }


    $("#frm_rr").submit(function(e) {
        e.preventDefault();

        $("#btn_finish_submit").prop('disabled', true);
        $("#btn_finish_submit").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");

        $.ajax({
            type: "POST",
            url: "ajax/update_receiving.php",
            data: $("#frm_rr").serialize(),
            success: function(data) {
                var res = JSON.parse(data);
                console.log(res);
                $("#modalDetails").modal('hide');
                $("#frm_rr").each(function() {
                    this.reset();
                });
                if (res.data == 1) {
                    getEntries();
                    success_add();
                }

                $("#btn_finish_submit").prop('disabled', false);
                $("#btn_finish_submit").html("<span class='fa fa-check-circle'></span> Submit");
            }
        });
    });

    function printIar(id) {
        $.ajax({
            method: "POST",
            url: "print/forms/iar.php",
            data: {
                rr_id: id
            },
            success: function(data) {
                var myWindow = window.open('', 'Print Receive', 'height=600,width=900');
                myWindow.document.write('<html><head><title>Print Receive</title>');
                myWindow.document.write('</head><body>');
                myWindow.document.write(data);
                myWindow.document.write('</body></html>');
                myWindow.document.close(); // necessary for IE >= 10

                // myWindow.focus(); // necessary for IE >= 10
                myWindow.print();
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

    #dt_detail_entries,
    td {
        padding: 2px !important;
    }
</style>
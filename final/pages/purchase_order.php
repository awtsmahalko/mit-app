<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Purchase Order</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <?php if ($_SESSION['category'] == 'BAC') { ?>
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
                            <th>Supplier</th>
                            <th>Amount</th>
                            <th>BY</th>
                            <th>Status</th>
                            <th>Inspected By</th>
                            <th>Accepted By</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require_once 'modals/modal_purchase_order.php'; ?>
</div>
<script>
    $(document).ready(function() {
        getEntries();
        $('.select2').select2();
    });

    function showAddModal() {
        $("#modalLabel").html("<span class='fa fa-pen'></span> New Purchase Order");
        $("#frm_po").each(function() {
            this.reset();
        });
        $(".select2").select2().trigger('change');
        changePo();
        $("#modalDetails").modal('show');
        $('.pending').show();
        $('.finish').hide();
    }

    function getEntryDetails(id) {
        document.getElementById("print-po").setAttribute("onclick", "printPo(" + id + ")");
        document.getElementById("print-iar").setAttribute("onclick", "printIar(" + id + ")");
        $.ajax({
            method: "POST",
            url: "ajax/update_purchase_order.php",
            data: {
                hidden_id: id,
                module: 'fetch-po-data'
            },
            success: function(data) {
                var res = JSON.parse(data);
                console.log(res);
                $("#pr_no_html").html(res.pr_no);
                $("#date_html").html(res.date);
                $("#supplier_html").html(res.supplier);
                $("#encoder_html").html(res.encoder);
                $("#status_html").html(res.status);


                $("#modalLabel").html("<span class='fa fa-eye'></span> View Purchase Order");
                $("#modalDetails").modal('show');
                $('.pending').hide();
                $('.finish').show();

                if (res.io_id == 0 || res.pc_id == 0) {
                    $("#print-iar").hide();
                } else {
                    $("#print-iar").show();
                }

                getCanvass(id);
            }
        });
    }

    function changePo() {
        $.ajax({
            method: 'POST',
            url: 'ajax/update_purchase_order.php',
            data: {
                hidden_id: 0,
                module: 'fetch-supplier',
                canvass_id: $("#canvass_id").val()
            },
            success: function(data) {
                var res = JSON.parse(data);
                $("#supplier_id").html(res.options);
                getCanvass();
            }
        });
    }

    function getEntries() {
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "ajax": {
                "url": "ajax/datatables/purchase_order.php",
                "dataSrc": "data"
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return row.po_status != 'S' ? "" : "<input type='checkbox' value=" + row.id + " class='dt_id' style='position: initial; opacity:1;'>";
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        var print_btn = '<button type="button" class="btn btn-secondary btn-circle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                            '<span class="fa fa-print"></span>' +
                            '</button>' +
                            '<div class="dropdown-menu">' +
                            '<a class="dropdown-item" href="#" onclick="printPo(' + row.id + ')">Purchase Order</a>' +
                            (row.is_iar == 1 ? '<a class="dropdown-item" href="#" onclick="printIar(' + row.id + ')">Inspection and Acceptance Report</a>' : '') +
                            '</div>';
                        return "<center><button class='btn btn-info btn-circle btn-sm' onclick='getEntryDetails(" + row.id + ")'><span class='fa fa-pen'></span></button>" + print_btn + "</center>";
                    }
                },
                {
                    "data": "pr_no"
                },
                {
                    "data": "po_date"
                },
                {
                    "data": "supplier"
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
                    "data": "io_id"
                },
                {
                    "data": "pc_id"
                }
            ]
        });
    }

    function getCanvass(id = 0) {
        $("#dt_detail_entries").DataTable().destroy();
        $("#dt_detail_entries").DataTable({
            "processing": true,
            "paging": false,
            "searching": false,
            "info": false,
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

                // Total over this page     
                var pageTotal = api
                    .column(5)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);


                // Update footer
                $(api.column(5).footer()).html(pageTotal);
            },
            "ajax": {
                "method": "POST",
                "url": "ajax/update_purchase_order.php",
                "dataSrc": "data",
                "data": {
                    hidden_id: id,
                    module: 'dt-canvass',
                    canvass_id: $("#canvass_id").val(),
                    supplier_id: $("#supplier_id").val()
                }
            },
            "columns": [{
                    "data": "count"
                },
                {
                    "data": "unit"
                },
                {
                    "data": "item"
                },
                {
                    "data": "qty"
                },
                {
                    "data": "cost"
                },
                {
                    "data": "amount"
                }
            ]
        });
    }

    $("#frm_po").submit(function(e) {
        e.preventDefault();

        $("#btn_finish_submit").prop('disabled', true);
        $("#btn_finish_submit").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");

        $.ajax({
            type: "POST",
            url: "ajax/update_purchase_order.php",
            data: $("#frm_po").serialize(),
            success: function(data) {
                var res = JSON.parse(data);
                console.log(res);
                if (res.data == 1) {
                    $("#modalDetails").modal('hide');
                    getEntries();
                    success_add();
                } else if (res.data == 2) {
                    entry_already_exists();
                } else {

                }

                $("#btn_finish_submit").prop('disabled', false);
                $("#btn_finish_submit").html("<span class='fa fa-check-circle'></span> Finish Purchase Order");
            }
        });
    });

    function acceptPo(po_id, po_no) {

        swal({
                title: "Are you sure?",
                text: "PO No. " + po_no + " will be accepted!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Yes, accept it!",
                cancelButtonText: "Close",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        method: "POST",
                        url: "ajax/update_purchase_order.php",
                        data: {
                            hidden_id: po_id,
                            module: 'accept-po'
                        },
                        success: function(data) {
                            var res = JSON.parse(data);
                            getEntries();
                            if (res.data == 1) {
                                success_update();
                            }
                        }
                    });
                }
            });

    }

    function approvePo(po_id, po_no) {

        swal({
                title: "Are you sure?",
                text: "PO No. " + po_no + " is inspected, verified and found in order as to quantity and specifications!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Yes, approve it!",
                cancelButtonText: "Close",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        method: "POST",
                        url: "ajax/update_purchase_order.php",
                        data: {
                            hidden_id: po_id,
                            module: 'inspect-po'
                        },
                        success: function(data) {
                            var res = JSON.parse(data);
                            getEntries();
                            if (res.data == 1) {
                                success_update();
                            }
                        }
                    });
                }
            });
    }

    function printPo(id) {
        $.ajax({
            method: "POST",
            url: "print/forms/purchase_order.php",
            data: {
                po_id: id
            },
            success: function(data) {
                var myWindow = window.open('', 'Print Purchase Order', 'height=600,width=900');
                myWindow.document.write('<html><head><title>Print Purchase Order</title>');
                myWindow.document.write('</head><body>');
                myWindow.document.write(data);
                myWindow.document.write('</body></html>');
                myWindow.document.close(); // necessary for IE >= 10

                // myWindow.focus(); // necessary for IE >= 10
                myWindow.print();
            }
        });
    }

    function printIar(id) {
        $.ajax({
            method: "POST",
            url: "print/forms/iar.php",
            data: {
                po_id: id
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
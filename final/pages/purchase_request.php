<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Purchase Requests</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!--<h6 class="m-0 font-weight-bold text-primary">List of Users</h6>-->
            <div class="btn-group pull-right">
                <?php if ($_SESSION['category'] == 'AA') { ?>
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
                <?php } else { ?>
                    <a href="#" class="btn btn-primary btn-sm btn-icon-split" onclick="showAssistModal()">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Assist Entry</span>
                    </a>
                <?php } ?>
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
                            <th>Department</th>
                            <th>Date Request</th>
                            <th>Purpose</th>
                            <th>Status</th>
                            <th>Date added</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require_once 'modals/modal_purchase_request.php'; ?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        getEntries();
        $('.select2').select2();
    });

    function getEntryDetails(id) {
        document.getElementById("print-pr").setAttribute("onclick", "printPurchaseRequest(" + id + ")");
        document.getElementById("print-bac").setAttribute("onclick", "printBac1(" + id + ")");
        document.getElementById("print-rfq").setAttribute("onclick", "printRfq(" + id + ")");
        var tb = "tbl_purchase_request_header";
        var keyword = "pr_id";

        $.ajax({
            type: "POST",
            url: "ajax/getDetails.php",
            data: {
                id: id,
                tb: tb,
                keyword: keyword
            },
            success: function(data) {
                var json = JSON.parse(data);
                console.log(json);
                $("#hidden_id").val(json.pr_id);
                $("#update_hidden_id").val(json.pr_id);
                $("#pr_no_html").html(json.pr_no);
                // $("#pr_dept_html").html(json.pr_department);
                // $("#pr_date_html").html(json.pr_date);
                // $("#pr_status_html").html(json.pr_status);
                $("#modalDetails").modal('show');
                getDetailEntries();
                if (json.pr_status == 'S') {
                    $('.pending').show();
                    $('.finish-approve').hide();
                    $("#col-detail").removeClass('col-md-12').addClass('col-md-8');
                } else if (json.pr_status == 'P') {
                    $('.pending').hide();
                    $('.finish-approve').show();
                    $('.finish').show();
                    $('.approve').hide();
                    $("#col-detail").removeClass('col-md-8').addClass('col-md-12');
                } else {
                    $('.pending').hide();
                    $('.finish-approve').show();
                    $('.approve').show();
                    $("#col-detail").removeClass('col-md-8').addClass('col-md-12');
                }
            }
        });
    }

    function deleteEntry() {

        var count_checked = $("input[class='dt_id']:checked").length;
        var tb = "tbl_purchase_request_header";
        var keyword = "pr_id";

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
                        deletePermanent(checkedValues, "tbl_purchase_request_details", "pr_id");
                        deletePermanent(checkedValues, "tbl_purchase_request_header", "pr_id");
                        $("#btn_delete").prop('disabled', false);

                    } else {
                        swal("Cancelled", "Entries are safe :)", "error");
                    }
                });
        } else {
            swal("Cannot proceed!", "Please select entries to delete!", "warning");
        }
    }

    function deleteDetailsEntry() {

        var count_checked = $("input[class='dt_detail_id']:checked").length;

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
                        var checkedValues = $("input[class='dt_detail_id']:checked").map(function() {
                            return this.value;
                        }).get();

                        $("#btn_remove").prop('disabled', true);
                        deletePermanent(checkedValues, "tbl_purchase_request_details", "pr_detail_id");
                        $("#btn_remove").prop('disabled', false);
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
                    getDetailEntries();
                } else {
                    //alert('Something is wrong. Failed to execute query. Please try again.');
                    //alert(data);
                    failed_query(data);
                }

                $("#btn_delete").prop('disabled', false);
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
            url: "ajax/update_purchase_request.php",
            data: $("#frm_submit").serialize(),
            success: function(data) {
                var res = JSON.parse(data);
                if (res.data == 1) {
                    //alert('Successfully updated entry.');
                    if (frm_module == 'add') {
                        success_add();
                    } else {
                        success_update();
                    }

                    $("#modalEntry").modal('hide');
                    getEntries();
                    getEntryDetails(res.id);

                    $("#frm_submit").each(function() {
                        this.reset();
                    });
                    $(".select2").select2().trigger('change');
                } else if (res.data == 2) {
                    //alert('Cannot proceed. Entry already exists.');
                    entry_already_exists();
                } else {
                    //alert('Something is wrong. Failed to execute query. Please try again.');
                    failed_query(res.data);
                }

                $("#btn_submit").prop('disabled', false);
                $("#btn_submit").html("<span class='fa fa-check-circle'></span> Submit");
            }
        });
    });

    $("#frm_assist_submit").submit(function(e) {
        e.preventDefault();

        $("#btn_assist_submit").prop('disabled', true);
        $("#btn_assist_submit").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");

        $.ajax({
            type: "POST",
            url: "ajax/update_purchase_request.php",
            data: $("#frm_assist_submit").serialize(),
            success: function(data) {
                var res = JSON.parse(data);
                if (res.data == 1) {
                    //alert('Successfully updated entry.');

                    success_update();
                    $("#modalAssist").modal('hide');
                    getEntries();

                    $("#frm_assist_submit").each(function() {
                        this.reset();
                    });
                    $(".select2").select2().trigger('change');
                } else if (res.data == 2) {
                    //alert('Cannot proceed. Entry already exists.');
                    entry_already_exists();
                } else {
                    //alert('Something is wrong. Failed to execute query. Please try again.');
                    failed_query(res.data);
                }

                $("#btn_assist_submit").prop('disabled', false);
                $("#btn_assist_submit").html("<span class='fa fa-check-circle'></span> Approve PR and Assist Vendor");
            }
        });
    });

    $("#frm_submit_details").submit(function(e) {
        e.preventDefault();

        $("#btn_det_submit").prop('disabled', true);
        $("#btn_det_submit").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");
        var frm_module = $("#update_module").val();

        $.ajax({
            type: "POST",
            url: "ajax/update_purchase_request.php",
            data: $("#frm_submit_details").serialize(),
            success: function(data) {
                var res = JSON.parse(data);
                if (res.data == 1) {
                    getEntryDetails(res.id);
                    $("#frm_submit_details").each(function() {
                        this.reset();
                    });
                    $(".select2").select2().trigger('change');
                } else if (res.data == 2) {
                    //alert('Cannot proceed. Entry already exists.');
                    entry_already_exists();
                } else {
                    //alert('Something is wrong. Failed to execute query. Please try again.');
                    failed_query(res.data);
                }

                $("#btn_det_submit").prop('disabled', false);
                $("#btn_det_submit").html("<span class='fa fa-check-circle'></span> Submit");
            }
        });
    });

    function showAddModal() {
        $("#frm_submit").each(function() {
            this.reset();
        });

        $(".select2").select2().trigger('change');

        $("#module").val('add');
        $("#modalLabel").html("<span class='fa fa-plus-circle'></span> Add Entry");
        $("#modalEntry").modal('show');
    }

    function showAssistModal() {
        fetchPendingPr();
        fetchSuppliers();
        $("#frm_assist_submit").each(function() {
            this.reset();
        });

        $(".select2").select2().trigger('change');
        $("#modalAssistLabel").html("<span class='fa fa-plus-circle'></span> Approve PR and assist vendor");
        $("#modalAssist").modal('show');
    }

    function fetchPendingPr() {
        $.ajax({
            url: 'ajax/update_purchase_request.php',
            method: 'POST',
            data: {
                hidden_id: 0,
                module: 'fetch-pending-pr',
            },
            success: function(data) {
                var res = JSON.parse(data);
                $("#pr_id").html(res.data);
            }
        });
    }

    function fetchSuppliers() {
        $.ajax({
            url: 'ajax/update_purchase_request.php',
            method: 'POST',
            data: {
                hidden_id: 0,
                module: 'fetch-supplier',
            },
            success: function(data) {
                var res = JSON.parse(data);
                $("#pr_suppliers").html(res.data);
            }
        });
    }

    function getEntries() {
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "ajax": {
                "url": "ajax/datatables/purchase_request.php",
                "dataSrc": "data"
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return row.status != 'S' ? "" : "<input type='checkbox' value=" + row.id + " class='dt_id' style='position: initial; opacity:1;'>";
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        if (row.status == 'P') {
                            var print_btn = '<button type="button" class="btn btn-secondary btn-circle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                '<span class="fa fa-print"></span>' +
                                '</button>' +
                                '<div class="dropdown-menu">' +
                                '<a class="dropdown-item" href="#" onclick="printPurchaseRequest(' + row.id + ')">Purchase Request</a>' +
                                '</div>';
                            var view_icon = "fa-info";
                        } else if (row.status == 'A') {
                            var print_btn = '<button type="button" class="btn btn-secondary btn-circle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                '<span class="fa fa-print"></span>' +
                                '</button>' +
                                '<div class="dropdown-menu">' +
                                '<a class="dropdown-item" href="#" onclick="printPurchaseRequest(' + row.id + ')">Purchase Request</a>' +
                                '<a class="dropdown-item" href="#" onclick="printBac1(' + row.id + ')">BAC Resolution 1</a>' +
                                '<a class="dropdown-item" href="#" onclick="printRfq(' + row.id + ')">Request for Quotation</a>' +
                                '</div>';
                            var view_icon = "fa-info";
                        } else {
                            var print_btn = '';
                            var view_icon = "fa-pen";
                        }
                        return "<center><button class='btn btn-info btn-circle btn-sm' onclick='getEntryDetails(" + row.id + ")'><span class='fa " + view_icon + "'></span></button>" + print_btn + "</center>";
                    }
                },
                {
                    "data": "pr_no"
                },
                {
                    "data": "pr_department"
                },
                {
                    "data": "pr_date"
                },
                {
                    "data": "pr_purpose"
                },
                {
                    "data": "pr_status"
                },
                {
                    "data": "date_modified"
                }
            ]
        });
    }

    function getDetailEntries() {
        var pr_id = $("#update_hidden_id").val();
        $("#dt_detail_entries").DataTable().destroy();
        $("#dt_detail_entries").DataTable({
            "processing": true,
            "ajax": {
                "url": "ajax/datatables/purchase_request_details.php",
                "dataSrc": "data",
                "data": {
                    id: pr_id
                }
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return "<input type='checkbox' value=" + row.id + " class='dt_detail_id' style='position: initial; opacity:1;'>";
                    }
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

    function changeItem() {
        $("#packaging_id").html("");
        $.ajax({
            type: "POST",
            url: "ajax/update_purchase_request.php",
            data: {
                module: 'fetch-packaging',
                hidden_id: $("#update_hidden_id").val(),
                item_id: $("#item_id").val()
            },
            success: function(data) {
                var res = JSON.parse(data);
                $("#packaging_id").html(res.data);
            }
        });
    }

    function finishPr() {

        var checkedValues = $("input[class='dt_detail_id']").map(function() {
            return this.value;
        }).get();
        if (checkedValues != '') {
            swal({
                    title: "Are you sure?",
                    text: "This will notify BAC Office for Purchase Request Approval!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-primary",
                    confirmButtonText: "Yes, finish it!",
                    cancelButtonText: "No, cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: "POST",
                            url: "ajax/update_purchase_request.php",
                            data: {
                                module: 'finish',
                                hidden_id: $("#update_hidden_id").val()
                            },
                            success: function(data) {
                                var res = JSON.parse(data);
                                if (res.data == 1) {
                                    success_add();
                                    getEntries();
                                    $("#modalDetails").modal('hide');
                                } else {
                                    //alert('Something is wrong. Failed to execute query. Please try again.');
                                    failed_query(res.data);
                                }
                            }
                        });
                    } else {
                        swal("Cancelled", "Entries are still pending :)", "error");
                    }
                });
        } else {
            swal("Cannot proceed", "Please add entries to finish", "error");
        }
    }

    function printPurchaseRequest(id) {
        $.ajax({
            method: "POST",
            url: "print/forms/purchase_request.php",
            data: {
                pr_id: id
            },
            success: function(data) {
                var myWindow = window.open('', 'Print Purchase Request', 'height=600,width=900');
                myWindow.document.write('<html><head><title>Print Purchase Request</title>');
                myWindow.document.write('</head><body>');
                myWindow.document.write(data);
                myWindow.document.write('</body></html>');
                myWindow.document.close(); // necessary for IE >= 10

                // myWindow.focus(); // necessary for IE >= 10
                myWindow.print();
            }
        });
    }

    function printBac1(id) {
        $.ajax({
            method: "POST",
            url: "print/forms/bac_resolution_1.php",
            data: {
                pr_id: id
            },
            success: function(data) {
                var myWindow = window.open('', 'Print Purchase Request', 'height=600,width=900');
                myWindow.document.write('<html><head><title>Print Purchase Request</title>');
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

    function printRfq(id) {
        $.ajax({
            method: "POST",
            url: "print/forms/request_for_quotation.php",
            data: {
                pr_id: id
            },
            success: function(data) {
                var myWindow = window.open('', 'Print Purchase Request', 'height=600,width=900');
                myWindow.document.write('<html><head><title>Print Purchase Request</title>');
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
    #dt_detail_entries,
    td {
        padding: 2px !important;
    }
</style>

<!-- CREATE TABLE `tbl_purchase_request_header` (
  `pr_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pr_batch` int(11) NOT NULL,
  `pr_no` varchar(30) NOT NULL DEFAULT '',
  `pr_department` varchar(4) NOT NULL DEFAULT '',
  `pr_date` date NOT NULL,
  `pr_purpose` varchar(155) NOT NULL DEFAULT '',
  `pr_status` varchar(1) NOT NULL DEFAULT 'S' COMMENT 'S:Saved,F:Finished,A:Approved',
  `user_id` int(11) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`pr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tbl_purchase_request_details` (
  `pr_detail_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pr_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` decimal(12,2) NOT NULL,
  `cost` decimal(12,2) NOT NULL,
  PRIMARY KEY (`pr_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4; -->
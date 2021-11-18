<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Items</h1>
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

            <div class="btn-group" style="float: right;">
                <a href="#" class="btn btn-secondary btn-sm btn-icon-split" onclick='printQr()' id='btn_delete'>
                    <span class="icon text-white-50">
                        <i class="fas fa-print"></i>
                    </span>
                    <span class="text">Print Qr</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dt_entries" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><input type='checkbox' onchange="checkAll(this, 'dt_id')"></th>
                            <th>Edit</th>
                            <th>Assign Unit</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Serial No</th>
                            <th>Date Modified</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require_once 'modals/modal_items.php'; ?>
    <?php require_once 'modals/modal_item_packaging.php'; ?>
    <?php require_once 'modals/modal_item_print_qr.php'; ?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        getEntries();
        $(".select2").select2();
    });

    function assign_packaging(item_id) {
        $("#item_id").val(item_id);
        $("#modalAssignPckaging").modal('show');
        $("#assigned_packaging").html("Fetching data ...");

        $.ajax({
            type: "POST",
            url: "ajax/getPackaging.php",
            data: {
                item_id: item_id
            },
            success: function(data) {
                $("#assigned_packaging").html(data);
            }
        });
    }

    $("#frm_submit2").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "ajax/update_item_packaging.php",
            data: $("#frm_submit2").serialize(),
            success: function(data) {
                if (data == 1) {
                    success_update();
                } else {
                    failed_query(data);
                }
            }
        });
    });

    function getEntryDetails(id) {

        var tb = "tbl_items";
        var keyword = "item_id";

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
                $("#hidden_id").val(json.item_id);
                $("#item_name").val(json.item_name);
                $("#item_desc").val(json.item_desc);
                $("#item_serial_no").val(json.item_serial_no);

                $("#module").val('update');
                $("#modalLabel").html("<span class='fa fa-pen'></span> Update Entry");
                $("#modalEntry").modal('show');
            }
        });
    }

    function deleteEntry() {

        var count_checked = $("input[class='dt_id']:checked").length;
        var tb = "tbl_items";
        var keyword = "item_id";

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

                    } else {
                        swal("Cancelled", "Entries are safe :)", "error");
                    }
                });
        } else {
            swal("Cannot proceed!", "Please select entries to delete!", "warning");
        }
    }

    $("#frm_submit").submit(function(e) {
        e.preventDefault();

        $("#btn_submit").prop('disabled', true);
        $("#btn_submit").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");
        var frm_module = $("#module").val();

        $.ajax({
            type: "POST",
            url: "ajax/update_items.php",
            data: $("#frm_submit").serialize(),
            success: function(data) {
                if (data == 1) {
                    //alert('Successfully updated entry.');
                    if (frm_module == 'add') {
                        success_add();
                    } else {
                        success_update();
                    }

                    $("#modalEntry").modal('hide');
                    getEntries();

                    $("#frm_submit").each(function() {
                        this.reset();
                    });
                } else if (data == 2) {
                    //alert('Cannot proceed. Entry already exists.');
                    entry_already_exists();
                } else {
                    //alert('Something is wrong. Failed to execute query. Please try again.');
                    failed_query(data);
                }

                $("#btn_submit").prop('disabled', false);
                $("#btn_submit").html("<span class='fa fa-check-circle'></span> Submit");
            }
        });
    });

    function showAddModal() {
        $("#frm_submit").each(function() {
            this.reset();
        });

        $("#module").val('add');
        $("#modalLabel").html("<span class='fa fa-plus-circle'></span> Add Entry");
        $("#modalEntry").modal('show');
    }

    function getEntries() {
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "ajax": {
                "url": "ajax/datatables/items.php",
                "dataSrc": "data"
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return "<input type='checkbox' value=" + row.id + " class='dt_id' style='position: initial; opacity:1;'>";
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        return "<center><button class='btn btn-info btn-circle btn-sm' onclick='getEntryDetails(" + row.id + ")'><span class='fa fa-pen'></span></button></center>";
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        return "<center><button class='btn btn-success btn-circle btn-sm' onclick='assign_packaging(" + row.id + ")'><span class='fa fa-plus'></span></button></center>";
                    }
                },
                {
                    "data": "item_name"
                },
                {
                    "data": "item_desc"
                },
                {
                    "data": "item_serial_no"
                },
                {
                    "data": "date_modified"
                }
            ]
        });
    }

    function printQr() {
        $("#modalPrintQr").modal('show');
    }

    function fetchPackaging() {
        $("#print_packaging_id").html("");
        $.ajax({
            type: "POST",
            url: "ajax/update_purchase_request.php",
            data: {
                module: 'fetch-packaging',
                hidden_id: 0,
                item_id: $("#print_item_id").val()
            },
            success: function(data) {
                var res = JSON.parse(data);
                $("#print_packaging_id").html(res.data);
            }
        });
    }

    $("#printQr").submit(function(e) {
        e.preventDefault();

        var myWindow = window.open('', 'Print Qr Code', 'height=600,width=900');
        myWindow.document.write('<html><head><title>Print QR Code</title>');
        myWindow.document.write('</head><body>');
        myWindow.document.write('<p>QR for <strong>' + $("#print_item_id option:selected").text() + '</strong> (' + $("#print_packaging_id option:selected").text() + ') </p>');

        var max_img = $("#print_qty").val() * 1;
        var print_item_id = $("#print_item_id").val();
        var print_packaging_id = $("#print_packaging_id").val();
        var qr_text = print_item_id + "-" + print_packaging_id;

        for (let index = 0; index < max_img; index++) {
            myWindow.document.write('<img src="qr.php?text=' + qr_text + '">');
        }
        myWindow.document.write('</body></html>');
        myWindow.document.close(); // necessary for IE >= 10

        // myWindow.focus(); // necessary for IE >= 10
        myWindow.print();


    });
</script>
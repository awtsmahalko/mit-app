<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Suppliers</h1>
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
                            <th>Edit</th>
                            <th>Company</th>
                            <th>Supplier</th>
                            <th>Address</th>
                            <th>Contact #</th>
                            <th>Email</th>
                            <th>Tin #</th>
                            <th>Remarks</th>
                            <th>Date Modified</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require_once 'modals/modal_suppliers.php'; ?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        getEntries();
    });

    function getEntryDetails(id) {

        var tb = "tbl_suppliers";
        var keyword = "supplier_id";

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
                $("#hidden_id").val(json.supplier_id);
                $("#supplier_name").val(json.supplier_name);
                $("#supplier_owner").val(json.supplier_owner);
                $("#supplier_email").val(json.supplier_email);
                $("#supplier_address").val(json.supplier_address);
                $("#supplier_contact_no").val(json.supplier_contact_no);
                $("#supplier_tin").val(json.supplier_tin);
                $("#remarks").val(json.remarks);

                $("#module").val('update');
                $("#modalLabel").html("<span class='fa fa-pen'></span> Update Entry");
                $("#modalEntry").modal('show');
            }
        });
    }

    function deleteEntry() {

        var count_checked = $("input[class='dt_id']:checked").length;
        var tb = "tbl_suppliers";
        var keyword = "supplier_id";

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
            url: "ajax/update_suppliers.php",
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
                "url": "ajax/datatables/suppliers.php",
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
                    "data": "supplier_name"
                },
                {
                    "data": "supplier_owner"
                },
                {
                    "data": "supplier_address"
                },
                {
                    "data": "supplier_contact_no"
                },
                {
                    "data": "supplier_email"
                },
                {
                    "data": "supplier_tin"
                },
                {
                    "data": "remarks"
                },
                {
                    "data": "date_modified"
                }
            ]
        });
    }
</script>
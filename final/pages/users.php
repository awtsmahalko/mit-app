<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User Accounts</h1>
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
                <a href="#" class="btn btn-success btn-sm btn-icon-split" onclick='assignPc()' id='btn_assign_pc'>
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Assign Property Custodian</span>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact No</th>
                            <th>Username</th>
                            <th>Category</th>
                            <th>Date Modified</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require_once 'modals/modal_users.php'; ?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        getEntries();
        $(".select2").select2();
    });

    function getEntryDetails(id) {

        var tb = "tbl_users";
        var keyword = "user_id";

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
                $("#hidden_id").val(json.user_id);
                $("#user_fname").val(json.user_fname);
                $("#user_mname").val(json.user_mname);
                $("#user_lname").val(json.user_lname);
                $("#user_email").val(json.user_email);
                $("#user_contact_no").val(json.user_contact_no);
                $("#user_category").val(json.user_category);
                $("#username").val(json.username);
                $("#password").val("confidential");


                $("#div_password").hide();
                $("#module").val('update');
                $("#modalLabel").html("<span class='fa fa-pen'></span> Update Entry");
                $("#modalEntry").modal('show');
            }
        });
    }

    function deleteEntry() {

        var count_checked = $("input[class='dt_id']:checked").length;
        var tb = "tbl_users";
        var keyword = "user_id";

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

        $("#user_category").prop('disabled', false);

        $.ajax({
            type: "POST",
            url: "ajax/update_users.php",
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
                    $("#user_category").prop('disabled', true);
                } else {
                    //alert('Something is wrong. Failed to execute query. Please try again.');
                    failed_query(data);
                    $("#user_category").prop('disabled', true);
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

        $("#user_category").prop('disabled', false);

        $("#div_password").show();
        $("#module").val('add');
        $("#modalLabel").html("<span class='fa fa-plus-circle'></span> Add Entry");
        $("#modalEntry").modal('show');
    }

    function getEntries() {
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "ajax": {
                "url": "ajax/datatables/users.php",
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
                    "data": "user_name"
                },
                {
                    "data": "user_email"
                },
                {
                    "data": "user_contact_no"
                },
                {
                    "data": "username"
                },
                {
                    "data": "user_category"
                },
                {
                    "data": "date_modified"
                }
            ]
        });
    }

    function assignPc() {
        $("#modalEntry2").modal('show');

        $.ajax({
            type: "POST",
            url: "ajax/update_users.php",
            data: {
                module: 'fetch-pc'
            },
            success: function(data) {
                var res = JSON.parse(data);
                $("#cat_elem").html(res.elem);
                $("#cat_jhs").html(res.jhs);
                $("#cat_shs").html(res.shs);
            }
        });

    }

    $("#frm_submit2").submit(function(e) {
        e.preventDefault();

        $("#btn_submit2").prop('disabled', true);
        $("#btn_submit2").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");
        var frm_module = $("#module").val();
        $.ajax({
            type: "POST",
            url: "ajax/update_users.php",
            data: $("#frm_submit2").serialize(),
            success: function(data) {
                getEntries();
                if (data == 1) {
                    $("#modalEntry2").modal('hide');
                    success_update();
                } else if (data == 2) {
                    swal("Cannot proceed!", "Assign Custodian must be unique!", "warning");
                } else {
                    failed_query(data);
                }
                $("#btn_submit2").prop('disabled', false);
                $("#btn_submit2").html("<span class='fa fa-check-circle'></span> Submit");
            }
        });
    });
</script>
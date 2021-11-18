<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Release Stock</h1>
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
                            <th>Release No</th>
                            <th>Department</th>
                            <th>Date Release</th>
                            <th>Days Consume</th>
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
    <?php require_once 'modals/modal_release.php'; ?>
</div>
<script type="text/javascript">
    var dept = "";
    $(document).ready(function() {
        getEntries();
        $('.select2').select2();
    });

    function getEntryDetails(id) {
        $("#curr").html('');
        var tb = "tbl_release_header";
        var keyword = "release_id";

        $("#frm_submit_details").each(function() {
            this.reset();
        });
        $(".select2").select2().trigger('change');
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
                dept = json.department;
                $("#hidden_id").val(json.release_id);
                $("#update_hidden_id").val(json.release_id);
                $("#pr_no_html").html(json.release_no);
                // $("#pr_dept_html").html(json.pr_department);
                // $("#pr_date_html").html(json.pr_date);
                // $("#pr_status_html").html(json.pr_status);
                $("#modalDetails").modal('show');
                getDetailEntries();
                if (json.release_status == 'F') {
                    $('.pending').hide();
                    $('.finish').show();
                    $("#col-detail").removeClass('col-md-8').addClass('col-md-12');
                } else {
                    $('.pending').show();
                    $('.finish').hide();
                    $("#col-detail").removeClass('col-md-12').addClass('col-md-8');
                }
            }
        });
    }

    function deleteEntry() {

        var count_checked = $("input[class='dt_id']:checked").length;
        var tb = "tbl_release_header";
        var keyword = "release_id";

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
                        deletePermanent(checkedValues, "tbl_release_details", "release_id");
                        deletePermanent(checkedValues, "tbl_release_header", "release_id");
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
                        deletePermanent(checkedValues, "tbl_release_details", "release_detail_id");
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
            url: "ajax/update_release.php",
            data: $("#frm_submit").serialize(),
            success: function(data) {
                var res = JSON.parse(data);
                console.log(res);
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


    $("#frm_submit_details").submit(function(e) {
        e.preventDefault();

        $("#btn_det_submit").prop('disabled', true);
        $("#btn_det_submit").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");
        var frm_module = $("#update_module").val();

        $.ajax({
            type: "POST",
            url: "ajax/update_release.php",
            data: $("#frm_submit_details").serialize(),
            success: function(data) {
                var res = JSON.parse(data);
                if (res.data == 1) {
                    getDetailEntries();
                    $("#frm_submit_details").each(function() {
                        this.reset();
                    });
                    $(".select2").select2().trigger('change');
                } else if (res.data == 2) {
                    //alert('Cannot proceed. Entry already exists.');
                    entry_already_exists();
                } else if (res.data == -1) {
                    //alert('Cannot proceed. Entry already exists.');
                    swal("Oops", "Unable to add zero quantity", "warning");
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

        $("#module").val('save-header');
        $("#modalLabel").html("<span class='fa fa-plus-circle'></span> Add Entry");
        $("#modalEntry").modal('show');
    }

    function getEntries() {
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "ajax": {
                "url": "ajax/datatables/release.php",
                "dataSrc": "data"
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return row.release_status == 'F' ? "" : "<input type='checkbox' value=" + row.id + " class='dt_id' style='position: initial; opacity:1;'>";
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        return "<center><button class='btn btn-info btn-circle btn-sm' onclick='getEntryDetails(" + row.id + ")'><span class='fa fa-pen'></span></button></center>";
                    }
                },
                {
                    "data": "release_no"
                },
                {
                    "data": "department"
                },
                {
                    "data": "release_date"
                },
                {
                    "data": "release_days_consume"
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

    function getDetailEntries() {
        var pr_id = $("#update_hidden_id").val();
        $("#dt_detail_entries").DataTable().destroy();
        $("#dt_detail_entries").DataTable({
            "processing": true,
            "ajax": {
                "url": "ajax/datatables/release_details.php",
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
                hidden_id: 0,
                item_id: $("#item_id").val()
            },
            success: function(data) {
                var res = JSON.parse(data);
                $("#packaging_id").html(res.data);
            }
        });
    }

    function fetchCurrentQty() {
        var item_id = $("#item_id").val();

        $.ajax({
            type: "POST",
            url: "ajax/update_release.php",
            data: {
                module: 'fetch-qty',
                hidden_id: 0,
                item_pack: item_id,
                department: dept
            },
            success: function(data) {
                var res = JSON.parse(data);
                $("#curr").html(res.data);
                document.getElementById("qty").setAttribute("max", res.data);
            }
        });
    }

    function finishRelease() {
        var checkedValues = $("input[class='dt_detail_id']").map(function() {
            return this.value;
        }).get();
        if (checkedValues != '') {
            swal({
                    title: "Are you sure?",
                    text: "Item will be move as stock out!",
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
                            url: "ajax/update_release.php",
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
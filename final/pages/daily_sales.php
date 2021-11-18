<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daily Sales</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="col-lg-6">
                <div class="input-group">
                    <span class="input-group-addon">Start Date: </span>
                    <input type="date" class="form-control" id="start_date">
                </div>
            </div>
            <br>
            <div class="col-lg-6">
                <div class="input-group">
                    <span class="input-group-addon">End Date: </span>
                    <input type="date" class="form-control" id="end_date">
                </div>
            </div>
            <br>
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-sm btn-icon-split" id="btn_generate" onclick="generate_report()">
                    <span class="icon text-white-50">
                        <i class="fas fa-check-circle"></i>
                    </span>
                    <span class="text" id="text_generate">Generate Report</span>
                </button>
                <button type="button" class="btn btn-secondary btn-sm btn-icon-split" onclick="printDiv('report-1')">
                    <span class="icon text-white-50">
                        <i class="fas fa-print"></i>
                    </span>
                    <span class="text">Print Report</span>
                </button>
            </div>
        </div>
        <div class="card-body" id="report-1">
            <div class="container-fluid" id="report_header">Parking Space Ticketing Daily Sales</div>
            <div class="container-fluid" id="report_date"></div>
            <br>
            <div class="container-fluid">
                <table class="table table-bordered" id="dt_entries" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Ticket Date</th>
                            <th>Ticket Range</th>
                            <th>Total Tickets</th>
                            <th>Tickets Used</th>
                            <th>Tickets Sales</th>
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
    
});


/*function generate_report(){

    $("#btn_generate").prop('disabled', true);

    var inventory_date = $("#inventory_date").val();

    if(inventory_date == ""){
        alert("Please select inventory date.");
    }else{

        $("#report_date").html("As of " + inventory_date);
        $.ajax({
            type:"POST",
            url:"ajax/inventory.php",
            data:{
                inventory_date:inventory_date
            },
            success:function(data){
                $("#report_data").html(data);
                $("#btn_generate").prop('disabled', false);
            }
        });
    }

}*/

function printDiv(container){

    var printContents = document.getElementById(container).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;

}

</script>
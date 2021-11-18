<?php
include '../core/config.php';
checkLoginStatus();

$ticket_id = $_GET['q'];
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Parking Space Ticketing and Monitoring App</title>

        <script src="../vendor/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery.qrcode.min.js"></script>

        <style type="text/css">
        @media print {
            body * {
                visibility: hidden;
            }
            #print-div * {
                visibility: visible;
            }
        }
        </style>
    </head>
    <body>
        <div class="container-fluid" id="print-div">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <input type="hidden" id="ticket_id" value="<?php echo $ticket_id; ?>">
                <div class="card-body" id="report-1">
                    <div class="container-fluid" id="report_header"></div>
                    <br>
                    <div class="container-fluid" id="qr_codes_container"></div>
                </div>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
$(document).ready(function() {
    getTickets();
});


function generate_qr_codes(start, end, date){
    var ticket_id = $("#ticket_id").val();

    while(start <= end){
        $("#qr_codes_container").append("<div style='float:left; width: 15%; margin: 7px 0px;' id='qr_container"+start+"'></div>");
        $('#qr_container'+start).qrcode({
            text:ticket_id+"-"+start,
            width:128,
            height:128
        });
        start++;
    }
    
    printDiv();
}


function getTickets(){

    var id = $("#ticket_id").val();

    $("#qr_codes_container").html("");
        
    var tb = "tbl_tickets";
    var keyword = "ticket_id";

    $.ajax({
        type:"POST",
        url:"../ajax/getDetails.php",
        data:{
            id:id,
            tb:tb,
            keyword:keyword
        },
        success:function(data){
            var json = JSON.parse(data);
            var ticket_start_range = json.ticket_start_range * 1;
            var ticket_end_range = json.ticket_end_range * 1;
            var ticket_date = json.ticket_date;

            $("#report_header").html("<h3>Parking Space Ticketing and Monitoring App</h3><strong>Ticket range: " + ticket_start_range + "-" + ticket_end_range + ". Ticket date: " + ticket_date+"</strong>");
            
            generate_qr_codes(ticket_start_range, ticket_end_range, ticket_date);
        }
    });
}

function printDiv(){
    window.print();
    window.close();
}

</script>
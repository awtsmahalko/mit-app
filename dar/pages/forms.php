
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Forms</h1>
    <p class="mb-4">Here you can generate the forms</p>

    <div class="form-group row">
        <div class="col">
            <select class="form-control" id="form_type">
                <option>&mdash; Please Select Form &mdash;</option>
                <option value='70E'>Form No. 70-E</option>
            </select>
        </div>
        <div class="col">
            <button type="button" class="btn btn-primary btn-icon-split" onclick="generate()">
                <span class="icon text-white-50">
                    <i class="fa fa-check"></i>
                </span>
                <span class="text">Generate</span>
            </button>
            <button type="button" class="btn btn-info btn-icon-split" onclick="printDiv('results')">
                <span class="icon text-white-50">
                    <i class="fa fa-print"></i>
                </span>
                <span class="text">Print</span>
            </button>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body" id="results">
        </div>
    </div>
</div>
<script type='text/javascript'>
    function generate(){
        var form_type = $("#form_type").val();
        var url = 'pages/form/'+form_type+'.php';
        $.post(url,{},function (data,status){
            $("#results").html(data);
        });
    }

    

    function printDiv(container) {

        var printContents = document.getElementById(container).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;

    }
</script>
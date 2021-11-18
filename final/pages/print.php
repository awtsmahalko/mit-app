<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Print</h1>
    </div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="pr-tab" data-toggle="tab" href="#pr" role="tab" aria-controls="pr" aria-selected="true">Purchase Request</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="bac1-tab" data-toggle="tab" href="#bac1" role="tab" aria-controls="bac1" aria-selected="false">Bac Resolution 1</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="rfq1-tab" data-toggle="tab" href="#rfq1" role="tab" aria-controls="rfq1" aria-selected="false">Request for Quotaion 1</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="ac-tab" data-toggle="tab" href="#ac" role="tab" aria-controls="ac" aria-selected="false">Abstract of Canvass</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="bac2-tab" data-toggle="tab" href="#bac2" role="tab" aria-controls="bac2" aria-selected="false">Bac Resolution 2</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="po-tab" data-toggle="tab" href="#po" role="tab" aria-controls="po" aria-selected="false">Purchase Order</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="iar-tab" data-toggle="tab" href="#iar" role="tab" aria-controls="iar" aria-selected="false">IAR</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="pr" role="tabpanel" aria-labelledby="pr-tab">
            <?php include_once 'pages/print/pr.php'; ?>
        </div>
        <div class="tab-pane fade show" id="bac1" role="tabpanel" aria-labelledby="bac1-tab">
            <?php include_once 'pages/print/bac_1.php'; ?>
        </div>
        <div class="tab-pane fade show" id="rfq1" role="tabpanel" aria-labelledby="rfq1-tab">
            <?php include_once 'pages/print/rfq_1.php'; ?>
        </div>
        <div class="tab-pane fade show" id="ac" role="tabpanel" aria-labelledby="ac-tab">
            <?php include_once 'pages/print/ac.php'; ?>
        </div>
        <div class="tab-pane fade show" id="bac2" role="tabpanel" aria-labelledby="bac2-tab">
            <?php include_once 'pages/print/bac_2.php'; ?>
        </div>
        <div class="tab-pane fade show" id="po" role="tabpanel" aria-labelledby="po-tab">
            <?php include_once 'pages/print/po.php'; ?>
        </div>
        <div class="tab-pane fade show" id="iar" role="tabpanel" aria-labelledby="iar-tab">
            <?php include_once 'pages/print/iar.php'; ?>
        </div>
    </div>
</div>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total Tickets Generated -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Items</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php if ($_SESSION['category'] == 'AA') { ?>
                                    <a href="index.php?page=items"><?= countItems(); ?></a>
                                <?php } else { ?>
                                    <?= countItems(); ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cubes fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Sales (Month) -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Approved Purchase Requests
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php if ($_SESSION['category'] == 'AA' || $_SESSION['category'] == 'BAC') { ?>
                                    <a href="index.php?page=purchase-request"><?= countApprovePr() ?></a>
                                <?php } else { ?>
                                    <?= countApprovePr(); ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pending Purchase Requests</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">

                                        <?php if ($_SESSION['category'] == 'AA' || $_SESSION['category'] == 'BAC') { ?>
                                            <a href="index.php?page=purchase-request"><?= countPendingPr() ?>%</a>
                                        <?php } else { ?>
                                            <?= countPendingPr(); ?>%
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?= countPendingPr() ?>%" aria-valuenow="<?php echo 154; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">User Accounts</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php if ($_SESSION['category'] == 'AA') { ?>
                                    <a href="index.php?page=users"><?= countUsers(); ?></a>
                                <?php } else { ?>
                                    <?= countUsers(); ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <div class="col-md-8">
                        <h6 class="m-0 font-weight-bold text-primary">Items Real Time Inventory</h6>
                    </div>
                    <div class="col-md-4 row">
                        <select class="form-control select2" onchange="canvass_inventory()" id="department-inv">
                            <option value="">All Department</option>
                            <option value="ELEM">Elementary</option>
                            <option value="JHS">Junior High School</option>
                            <option value="SHS">Senior High School</option>
                        </select>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div id="canvass-inventory"></div>
                </div>
            </div>
        </div>

        <!-- Area Chart -->
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <div class="col-md-8">
                        <h6 class="m-0 font-weight-bold text-primary">Monthly Periodic Forecasting</h6>
                    </div>
                    <div class="col-md-4 row">
                        <select class="form-control select2" onchange="generate_graph_monthly()" id="monthly-pr">
                            <option value="P">Purchased</option>
                            <option value="R">Released</option>
                        </select>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div id="monthly-periodic"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 row">
            <div class="col-xl-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <div class="col-md-8">
                            <h6 class="m-0 font-weight-bold text-primary">Quarterly Periodic Forecasting</h6>
                        </div>
                        <div class="col-md-4 row">
                            <select class="form-control select2" onchange="generate_graph_quarter()" id="quarterly-pr">
                                <option value="P">Purchased</option>
                                <option value="R">Released</option>
                            </select>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <div class="col-md-8">
                            <h6 class="m-0 font-weight-bold text-primary">Yearly Periodic Forecasting</h6>
                        </div>
                        <div class="col-md-4 row">
                            <select class="form-control select2" onchange="generate_graph_yearly()" id="yearly-pr">
                                <option value="P">Purchased</option>
                                <option value="R">Released</option>
                            </select>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div id="yearly-periodic"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.select2').select2();
    canvass_inventory();
    generate_graph_quarter();
    generate_graph_monthly();
    generate_graph_yearly();


    function canvass_inventory() {
        var department = $("#department-inv").val();
        $.getJSON('ajax/graph_inventory.php', {
            department: department
        }, function(data) {
            var title = {
                text: 'Real Time Inventory'
            };
            var subtitle = {
                text: 'All Items (Elementary)'
            };
            var xAxis = {
                categories: data['categories']
            };
            var yAxis = {
                title: {
                    text: 'Quantity'
                }
            };
            var plotOptions = {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: true
                }
            };
            var series = data['series'];

            var json = {};
            json.title = title;
            json.subtitle = subtitle;
            json.xAxis = xAxis;
            json.yAxis = yAxis;
            json.series = series;
            json.plotOptions = plotOptions;
            $('#canvass-inventory').highcharts(json);
        });
    }

    function generate_graph_quarter() {

        var quarterly_pr = $("#quarterly-pr").val();
        var quarterly_pr_text = $("#quarterly-pr option:selected").text();
        $.getJSON('ajax/graph_quarterly.php', {
            quarterly_pr: quarterly_pr
        }, function(data) {

            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: quarterly_pr_text + ' Periodic Forecasting'
                },
                subtitle: {
                    text: "Quarterly"
                },
                xAxis: {
                    type: 'category',
                    categories: ["First Quarter", "Second Quarter", "Third Quarter", "Fourth Quarter"],
                    labels: {
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Quantity'
                    }
                },
                legend: {
                    enabled: true
                },
                tooltip: {
                    pointFormat: 'Total: <b>{point.y:.1f}</b>'
                },
                series: data['series']
            });

        });
    }

    function generate_graph_yearly() {

        var yearly_pr = $("#yearly-pr").val();
        var yearly_pr_text = $("#yearly-pr option:selected").text();
        $.getJSON('ajax/graph_yearly.php', {
            yearly_pr: yearly_pr
        }, function(data) {

            Highcharts.chart('yearly-periodic', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: yearly_pr_text + ' Periodic Forecasting'
                },
                subtitle: {
                    text: "Yearly"
                },
                xAxis: {
                    type: 'category',
                    categories: data["categories"],
                    labels: {
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Quantity'
                    }
                },
                legend: {
                    enabled: true
                },
                tooltip: {
                    pointFormat: 'Total: <b>{point.y:.1f}</b>'
                },
                series: data["series"]
            });

        });
    }

    function generate_graph_monthly() {
        var monthly_pr = $("#monthly-pr").val();
        var monthly_pr_text = $("#monthly-pr option:selected").text();
        $.getJSON('ajax/graph_monthly.php', {
            monthly_pr: monthly_pr
        }, function(data) {

            Highcharts.chart('monthly-periodic', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: monthly_pr_text + ' Periodic Forecasting'
                },
                subtitle: {
                    text: "Monthly"
                },
                xAxis: {
                    type: 'category',
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                    ],
                    labels: {
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Quantity'
                    }
                },
                legend: {
                    enabled: true
                },
                tooltip: {
                    pointFormat: 'Total: <b>{point.y:.1f}</b>'
                },
                series: data['series']
            });

        });
    }
</script>
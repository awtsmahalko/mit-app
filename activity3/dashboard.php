<?php
$title = "Dashboard"; //set the title in header.php
$page = "dashboard";
require_once 'authenticate.php';
include 'template/header.php';
include 'template/nav.php';
include 'template/sidebar.php';

require_once 'control/user.php';
$user = new user();

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Users</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="users.php">View Details</a>
                            <div class="small text-white"><?php echo count($user->getAllUsers()) ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <?php
    include 'template/footer.php';
    ?>

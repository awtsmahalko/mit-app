<?php
include 'template/header.php';
$views = isset($_REQUEST['q']) ? $_REQUEST['q'] : 'dashboard';
?>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">

            <?php include 'template/sidebar.php'; ?>
            <!-- / Menu -->

            <div class="layout-page">

                <?php include 'template/navbar.php'; ?>

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <?php include "views/$views.php"; ?>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>

    </div>
    <?php include 'template/footer.php'; ?>

</body>

</html>
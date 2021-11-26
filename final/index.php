<?php
include 'core/config.php';
checkLoginStatus();
$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Procurement and Inventory Management System</title>

  <!-- Custom fonts for this template-->
  <link rel="icon" type="image/png" href="img/logo.ico">

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/sweetalert.css">
  <link rel="stylesheet" href="vendor/select2/css/select2.css">

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="js/sweetalert.js"></script>
  <script src="vendor/select2/js/select2.js"></script>
  <script type="text/javascript" src="js/jquery.qrcode.min.js"></script>

  <script src="https://code.highcharts.com/highcharts.js"></script>
  <style type="text/css">
    .input-group-addon {
      padding: 5px;
      background: #ccc;
      color: #555;
      border-bottom-left-radius: 5px;
      border-top-left-radius: 5px;
    }
  </style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php require 'components/sidebar.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php require 'components/topbar.php'; ?>
        <!-- End of Topbar -->

        <!-- Begin Routes -->
        <?php require_once 'routes/routes.php'; ?>
        <!-- End Routes -->


      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>PIMS - Eduard Rino Q. Carton &copy; 2021</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="auth/logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <?php
  require 'pages/modals/modal_update_profile.php';
  require 'pages/modals/modal_update_password.php';
  ?>

  <!-- Bootstrap core JavaScript-->

  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

</body>

</html>

<script type="text/javascript">
  function success_add() {
    swal("Success!", "Successfully added entry!", "success");
  }

  function success_update() {
    swal("Success!", "Successfully updated entry!", "success");
  }

  function success_delete() {
    swal("Success!", "Successfully deleted entry!", "success");
  }

  function entry_already_exists() {
    swal("Cannot proceed!", "Entry already exists!", "warning");
  }

  function failed_query(data) {
    swal("Failed to execute query!", data, "warning");
    //alert('Something is wrong. Failed to execute query. Please try again.');
  }

  function checkAll(ele, ref) {
    var checkboxes = document.getElementsByClassName(ref);
    if (ele.checked) {
      for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].type == 'checkbox') {
          checkboxes[i].checked = true;
        }
      }
    } else {
      for (var i = 0; i < checkboxes.length; i++) {
        //console.log(i)
        if (checkboxes[i].type == 'checkbox') {
          checkboxes[i].checked = false;
        }
      }
    }
  }

  $("#frm_updateProfile").submit(function(e) {
    e.preventDefault();

    $("#btn_update_profile").prop('disabled', true);
    $("#btn_update_profile").html("<span class='fa fa-spinner fa-spin'></span> Updating ...");

    $.ajax({
      type: "POST",
      url: "ajax/update_profile.php",
      data: $("#frm_updateProfile").serialize(),
      success: function(data) {
        if (data == 1) {
          //alert('Successfully updated entry.');
          success_update();
          $("#updateProfile").modal('hide');

          $("#frm_updateProfile").each(function() {
            this.reset();
          });
        } else if (data == 2) {
          //alert('Cannot proceed. Entry already exists.');
          entry_already_exists();
        } else {
          //alert('Something is wrong. Failed to execute query. Please try again.');
          failed_query(data);
        }

        $("#btn_update_profile").prop('disabled', false);
        $("#btn_update_profile").html("<span class='fa fa-check-circle'></span> Submit");
      }
    });
  });

  $("#frm_updatePassword").submit(function(e) {
    e.preventDefault();

    $("#btn_update_password").prop('disabled', true);
    $("#btn_update_password").html("<span class='fa fa-spinner fa-spin'></span> Updating ...");

    $.ajax({
      type: "POST",
      url: "ajax/update_password.php",
      data: $("#frm_updatePassword").serialize(),
      success: function(data) {
        if (data == 1) {
          $("#updatePassword").modal('hide');

          alert('Successfully updated password. Please login again for security.');
          //swal("Success!", "Successfully updated password. Please login again for security.", "success");
          window.location = 'auth/logout.php';

        } else if (data == 2) {
          //alert('Old password is not correct.');
          swal("Error!", "Old password is not correct!", "error");
        } else if (data == 3) {
          //alert('.');
          swal("Error!", "Passwords did not matched!", "error");
        } else {
          //alert('Something is wrong. Failed to execute query. Please try again.');
          failed_query(data);
        }

        $("#btn_update_password").prop('disabled', false);
        $("#btn_update_password").html("<span class='fa fa-check-circle'></span> Submit");
      }
    });
  });
</script>
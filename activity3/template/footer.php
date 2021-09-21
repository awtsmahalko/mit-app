<?php
if($page!="index") {
?>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2021</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
<?php } ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<?php
    if($page=="dashboard") {
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<?php
}
    ?>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>

<!-- <script src="js/scripts.js"></script> -->

<?php
if(!empty($msg)) {
?>
<script>
    $(document).ready(function() {
        $("#msg").toast("show");
    });

</script>
<?php  } ?>
<script>
    function modifyUser(username){
        $("#uusername").val(username);
        $("#edituser").modal('show');
    }
    function deleteUser(username){
        $("#dusername").val(username);
        $("#deleteuser").modal('show');
    }
</script>


</body>
</html>

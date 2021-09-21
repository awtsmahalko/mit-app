<?php
$title = "Security Check"; //set the title in header.php
$page = "index";
$msg = "";

include 'template/header.php';
require_once 'control/user.php';
$user = new user();
session_destroy();

if(isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $user->authenticate($username, $password);

    if($result) {
        header("location: users.php");
    } else {
        $msg = "Invalid username or password!";
    }

}





?>
<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <?php include_once 'template/msgtoast.php'; ?>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Security Check</h3></div>
                            <form action="index.php" method="post">
                                <div class="card-body">


                                    <div class="form-floating mb-3">
                                        <input name="username" class="form-control" id="inputUser" type="text" placeholder="Username" />
                                        <label for="inputUser">Username</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input name="password" class="form-control" id="inputPassword" type="password" placeholder="Password" />
                                        <label for="inputPassword">Password</label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                        <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="password.html">Forgot Password?</a>

                                        <input type="submit" class="btn btn-primary" value="Login">
                                    </div>

                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
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
</div>


<?php
include 'template/footer.php';
?>

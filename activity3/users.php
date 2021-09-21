<?php
$title = "Users"; //set the title in header.php
$page = "users";
$msg = "";
require_once 'authenticate.php';
include 'template/header.php';
include 'template/nav.php';
include 'template/sidebar.php';
include 'control/user.php';

$user = new user();

if(isset($_POST['username'])) {
    if($_POST['password']==$_POST['rpassword']) {
        if($user->checkIfUserExist($_POST['username'])>0){
            $msg = "Username already exist!";
        }else{
            $result = $user->addNewUser($_POST['username'], $_POST['password']);
            if($result)
                $msg = "New User added!";
            else
                $msg = "Failed to add new user";
        }

    } else {
        $msg = "Password does not match!";
    }
}

if(isset($_POST['uusername'])){
    if($_POST['unpassword']==$_POST['urpassword']) {
        $result = $user->updateUser($_POST['uusername'], $_POST['unpassword']);
        if($result)
            $msg = "User Password successfully updated!";
        else
            $msg = "Failed to update user";

    } else {
        $msg = "Password does not match!";
    }
}

if(isset($_POST['dusername'])){
    $result = $user->deleteUser($_POST['dusername']);
    if($result)
        $msg = "User successfully deleted!";
    else
        $msg = "Failed to delete user";
}

?>






<div id="layoutSidenav_content">
    <main>

        <?php include_once 'template/msgtoast.php'; ?>

        <div class="container-fluid px-4">
            <h1 class="mt-4">Users</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Users</li>
            </ol>
            <div class="row">
                <div class="col-md-2 offset-10">

                    <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#adduser"><span class="fa fa-plus-circle"></span> Add New User</button>


                </div>



            </div>
            <div class="card mb-4 mt-2">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    List of Users
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                        <tr>

                            <th>Username</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
<?php

    $users = $user->getAllUsers();
    if(count($users)>0) {
        foreach($users as $user) {
            echo "<tr><td>$user</td><td><button class='btn btn-sm btn-primary' onclick=\"modifyUser('$user')\"><span class='fa fa-edit'></span> Change Password</button>
                        <button class='btn btn-sm btn-danger' onclick=\"deleteUser('$user')\"><span class='fa fa-trash'></span> Delete</button></td></tr>";
        }
    } else {
        echo "<tr><td>xxxx</td><td><a href='' class='btn btn-sm btn-primary'>Modify</a>
                        <a href='#' class='btn btn-sm btn-danger'>Delete</a></td></tr>";
    }

?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>


    <!-- Modal -->
    <div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserLabel">Add New User</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="users.php">
                <div class="modal-body">

                    <div class="row pt-1">

                        <div class="col-md-5">
                            Enter Username
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="username" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row pt-1">

                        <div class="col-md-5">
                            Enter Password
                        </div>
                        <div class="col-md-7">
                            <input type="password" class="form-control" name="password" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row pt-1">

                        <div class="col-md-5">
                            Retype Password
                        </div>
                        <div class="col-md-7">
                            <input type="password" class="form-control" name="rpassword" autocomplete="off" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Save </button></div>

                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edituser" tabindex="-1" role="dialog" aria-labelledby="editUserLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserLabel">Change User Password</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="users.php">
                <div class="modal-body">
                    <input type="hidden" name="uusername" id="uusername">
                    <div class="row pt-1">
                        <div class="col-md-5">
                            Enter New Password
                        </div>
                        <div class="col-md-7">
                            <input required type="password" class="form-control" name="unpassword" autocomplete="off">
                        </div>
                    </div>
                    <div class="row pt-1">

                        <div class="col-md-5">
                            Retype Password
                        </div>
                        <div class="col-md-7">
                            <input required type="password" class="form-control" name="urpassword" autocomplete="off">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Save </button></div>

                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteuser" tabindex="-1" role="dialog" aria-labelledby="deleteUserLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserLabel">Delete User</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="users.php">
                <div class="modal-body">
                    <input type="hidden" name="dusername" id="dusername">
                    <div class="row pt-1">
                        <div class="col-md-12">
                            <h3>Are you sure to delete this user?</h3>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Yes </button></div>

                </form>
            </div>
        </div>
    </div>

<?php
include 'template/footer.php';
?>

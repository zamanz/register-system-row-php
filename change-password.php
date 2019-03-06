<?php require_once 'includes/header.php'; ?>
<?php
    if (isset($_SESSION["login"]) == false) {
        header("Location: index.php");
    }
    
?>
<?php 
    if (!isset($_GET['change_pass']) OR $_GET['change_pass'] == NULL ) {
        echo "<script>window.location='index.php';</script>";
    }
    else{
        $usersId = $_GET['change_pass'];
    }
?>
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $usersId = $_POST['usersId'];
                    $password = $_POST['password'];

                    if (empty($password)) {
                        echo "<div class='alert alert-warning'><strong>Error 404!</strong> Input field must not be empty</div>";
                    }
                    else{

                        $password = md5($password);
                        $sql = "SELECT * FROM users_table WHERE usersId = '$usersId'";
                        $result = mysqli_query($conn, $sql);
                        $value = $result->fetch_assoc();
                        if ($value['password'] != $password) {
                            echo "<div class='alert alert-danger'><strong>Error 404!</strong> Old Password is Incorrect.</div>";
                        }
                        
                        else{
                            $query = "UPDATE users_table SET password = '$password' WHERE usersId = '$usersId'";
                            $upData = mysqli_query($conn, $query);
                            if ($upData) {
                                echo "<div class='alert alert-success'><strong>Success!</strong> Password change successfully. <a href='login.php'>Login</a></div>";
                            }
                            else{
                                echo "<div class='alert alert-danger'><strong>Error 404!</strong> Password change failed.</div>";
                            }
                        }
                    }
                }
            ?>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Change Password</h5>
                </div>
                <div class="card-body">

                    <form action="#" method="POST">
                        <input type="hidden" name="usersId" value="<?php echo $usersId ?>">
                        <div class="form-group">
                            <label>Old Password</label>
                            <input type="password" name="old_password" class="form-control" placeholder="Old Password">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="password" class="form-control" placeholder="New Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Change</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>

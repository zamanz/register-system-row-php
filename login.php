<?php require_once 'includes/header.php'; ?>
<?php
    if (isset($_SESSION["login"]) == true) {
        header("Location: index.php");
    }
    
?>
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    if (empty($email) OR empty($password)) {
                        echo "<div class='alert alert-warning'><strong>Error 404!</strong> Input field must not be empty</div>";
                    }
                    else{

                        $password = md5($password);
                        $sql = "SELECT * FROM users_table WHERE email = '$email' AND password = '$password'";
                        $result = mysqli_query($conn, $sql);
                        if ($result->num_rows > 0) {
                            $getData = mysqli_fetch_assoc($result);
                            $_SESSION["login"] = true;
                            $_SESSION["usersId"] = $getData['usersId'];
                            $_SESSION["user_name"] = $getData['name'];
                            $_SESSION["email_address"] = $getData['email'];
                            header("Location: index.php");
                        }
                        else{
                            echo "<div class='alert alert-warning'><strong>Error 404!</strong> Email Or password not match</div>";
                        }
                    }
                }
            ?>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Login Form</h5>
                </div>
                <div class="card-body">
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>

                        <button type="submit" class="btn btn-primary">Login</button> <span><a href="register.php" class="btn btn-primary" style="margin-left: 30px;">Sign Up</a></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>

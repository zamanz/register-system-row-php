<?php require_once 'includes/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $name = $_POST['user_name'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    if (empty($name) OR empty($email) OR empty($password)) {
                        echo "<div class='alert alert-warning'><strong>Error 404!</strong> Input field must not be empty</div>";
                    }
                    else{
                        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                            echo "<div class='alert alert-warning'><strong>Error 404!</strong> Email is a Not valid</div>";
                        }
                        else{

                            $password = md5($password);
                            $checkMail = "SELECT * FROM users_table WHERE email = '$email'";
                            $result = mysqli_query($conn, $checkMail);
                            if ($result->num_rows > 0) {
                                echo "<div class='alert alert-warning'><strong>Error 404!</strong> This Email Address already exists. <a href='register.php'>Refresh</a></div>";
                            }
                            else{
                                $query = "INSERT INTO users_table (name, email, password) VALUES('$name', '$email', '$password')";
                                $insertData = mysqli_query($conn, $query);
                                if ($insertData) {
                                    echo "<div class='alert alert-success'><strong>Success!</strong> Registration completed successfully. <a href='login.php'>Login</a></div>";
                                }
                                else{
                                    echo "<div class='alert alert-danger'><strong>Error 404!</strong> Registration failed. <a href='register.php'>Refresh</a></div>";
                                }
                            }
                        }
                    }
                }
            ?>

            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Registration Form</h5>
                </div>
                <div class="card-body">

                    <form action="#" method="POST">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" name="user_name" class="form-control" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label>Email address:</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>

                        <button type="submit" class="btn btn-primary">Register</button><span><a href="login.php" class="btn btn-primary" style="margin-left: 30px;">Login</a></span>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>

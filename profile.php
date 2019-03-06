
<?php require 'includes/header.php'; ?>
<?php
	if (isset($_SESSION["login"]) == false) {
	 	header("Location: login.php");
	}
?>
<?php 
    if (!isset($_GET['users_profile']) OR $_GET['users_profile'] == NULL ) {
        echo "<script>window.location='index.php';</script>";
    }
    else{
        $users_profile = $_GET['users_profile'];
    }
?>
	<div class="container">
		<div class="row">
			<div class="col-8 offset-2">
				<div class="card mt-3">
	                <div class="card-body">
	                    <h5 class="card-title primary">Update Information</h5>
	                </div>
	                <div class="card-body">
	                	<?php 
	                		$sql = "SELECT * FROM users_table WHERE usersId = '$users_profile'";
	                		$results = mysqli_query($conn, $sql);
	                		$value = $results->fetch_assoc();
	                	?>
	                	<?php
			                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			                	$usersId = $_POST['usersId'];
			                    $name = $_POST['user_name'];
			                    $email = $_POST['email'];

			                    if (empty($name) OR empty($email)) {
			                        echo "<div class='alert alert-warning'><strong>Error 404!</strong> Input field must not be empty</div>";
			                    }
			                    else{
			                        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			                            echo "<div class='alert alert-warning'><strong>Error 404!</strong> Email is a Not valid</div>";
			                        }
			                        else{
		                                $query = "UPDATE users_table SET name = '$name', email = '$email' WHERE usersId = '$usersId'";
		                                $upData = mysqli_query($conn, $query);
		                                if ($upData) {
		                                    echo "<div class='alert alert-success'><strong>Success!</strong> Profile Updated successfully.</div>";
		                                }
		                                else{
		                                    echo "<div class='alert alert-danger'><strong>Error 404!</strong> Profile Updated failed.</div>";
		                                }
		                            }
			                    }
			                }
			            ?>

						<form action="#" method="POST">
							<input type="hidden" name="usersId" value="<?php echo $value['usersId'] ?>">
	                        <div class="form-group">
	                            <label>Name:</label>
	                            <input type="text" name="user_name" class="form-control" value="<?php echo $value['name'] ?>">
	                        </div>

	                        <div class="form-group">
	                            <label>Email address:</label>
	                            <input type="email" name="email" class="form-control" value="<?php echo $value['email'] ?>">
	                        </div>

	                        <button type="submit" class="btn btn-success">Update</button>

	                        <a href="change-password.php?change_pass=<?php echo $value['usersId'] ?>" class="btn btn-primary">Change Password</a>
	                    </form>

					</div>
				</div>

			</div>
		</div>
	</div>

<?php require 'includes/footer.php'; ?>

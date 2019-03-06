
<?php require 'includes/header.php'; ?>
<?php
	if (isset($_SESSION["login"]) == false) {
	 	header("Location: login.php");
	 } 
?>
	<div class="container">
		<div class="row">
			<div class="col-8 offset-2">
				<div class="card mt-3">
	                <div class="card-body">
	                    <h5 class="card-title primary">Dashboard</h5>
	                </div>
	                <div class="card-body">
						<h1>Hello! <?php echo $_SESSION['user_name']; ?></h1>
						<h2>Your email address is ! <?php echo $_SESSION['email_address']; ?></h2>

					</div>
				</div>

			</div>
		</div>
	</div>

<?php require 'includes/footer.php'; ?>

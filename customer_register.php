	<?php
		$active = 'Account';
		include("includes/header.php");
	?>

	<div id="content">
		<div class="container">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li>Register</li>
				</ul>
			</div>

			<div class="col-md-3">


				<?php
					include('includes/sidebar.php');
				?>
			</div>
				<div class="col-md-9">
					<div class="box">
						<div class="box-header">
							<center>
								<h2>Registration</h2>
							</center>
							<form action="" enctype="multipart/form-data" method="post">
								<div class="form-group">
									<label>Your Name</label>
									<input type="text" name="c_name" class="form-control" required>
								</div>
                                <div class="form-group">
									<label>Email</label>
									<input type="text" name="c_email" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="c_pass" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Country</label>
									<input type="text" name="c_country" class="form-control" required>
								</div>
								<div class="form-group">
									<label>City</label>
									<input type="text" name="c_city" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Contacts</label>
									<input type="text" name="c_contact" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Address</label>
									<input type="text" name="c_address" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Profile Picture</label>
									<input type="file" name="c_image" class="form-control" required>
								</div>
								<div class="text-center">
									<button type="submit" name="register" class="btn btn-primary">
									<i class="fa fa-user-md"></i> Register
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
		</div>
	</div>

	<?php
		include('includes/footer.php');
	?>

	<script src="js/jquery-331.min.js"></script>
	<script src="js/bootstrap-337.min.js"></script>

</body>
</html>


<?php
	if(isset($_POST['register'])) {
		$email_validation_regex = '/^\\S+@\\S+\\.\\S+$/';
		if(preg_match($email_validation_regex, $_POST['c_email'])) {
			$c_name = $_POST['c_name'];

			$c_email = $_POST['c_email'];

			$c_pass = $_POST['c_pass'];

			$c_country = $_POST['c_country'];

			$c_city = $_POST['c_city'];

			$c_contact = $_POST['c_contact'];

			$c_address = $_POST['c_address'];

			$c_image = $_FILES['c_image']['name'];

			$c_image_tmp = $_FILES['c_image']['tmp_name'];

			$c_ip = getRealIPUser();

			move_uploaded_file($c_image_tmp, "customer/customer_images/$c_image");

			$insert_customer = "Insert into customers
			(customer_name, customer_email, customer_pass, customer_country, customer_city, customer_contact, customer_address, customer_image, customer_ip) values
			('$c_name', '$c_email', '$c_pass', '$c_country', '$c_city', '$c_contact', '$c_address', '$c_image', '$c_ip')";

			$run_customer = mysqli_query($connection, $insert_customer);

			$sel_cart = "Select * from cart where ip_add = '$c_ip'";

			$run_cart = mysqli_query($connection, $sel_cart);

			$check_cart = mysqli_num_rows($run_cart);

			if($check_cart > 0) {
				$_SESSION['customer_email'] = $c_email;

				echo "<script>alert('Registartion complete')</script>";

				echo "<script>window.open('checkout.php', '_self')</script>";
			} else {
				$_SESSION['customer_email'] = $c_email;

				echo "<script>alert('Registartion complete')</script>";

				echo "<script>window.open('index.php', '_self')</script>";
			}
		} else {
			echo "<script>alert('Wrong Email')</script>";
		}

	}

?>
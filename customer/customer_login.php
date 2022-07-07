<div class="box">
	<div class="box-header">
		<center>
			<h1>Login</h1>

			<p class="lead">Already have an account?</p>

			<p class="text-muted">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis facilis, culpa expedita eaque temporibus ut enim modi corporis sed dolorem dignissimos, sint eum est eligendi doloribus voluptatum veritatis, inventore officiis.
			</p>
		</center>
	</div>

	<form method="post" action="checkout.php">
		<div class="form-group">
			<label>Email</label>
			<input type="text" name="c_email" class="form-control" required>
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" name="c_pass" class="form-control" required>
		</div>
		<div class="text-center">
			<button name="login" value="Login" class="btn btn-primary">
				<i class="fa fa-sign-in"></i> Login
			</button>
		</div>
	</form>

	<center>
		<a href="customer_register.php">
            <h3>Don`t have an account? Register here</h3>
		</a>
	</center>

</div>

<?php
	if(isset($_POST['login'])) {
		$customer_email = $_POST['c_email'];

		$customer_pass = $_POST['c_pass'];

		$select_customers = "Select * from customers where customer_email = '$customer_email' and customer_pass = '$customer_pass'";

		$res = mysqli_query($connection, $select_customers);

		$get_ip = getRealIPUser();

		$count = mysqli_num_rows($res);

		$select_cart = "Select * from cart where ip_add = '$get_ip'";

		$run_cart = mysqli_query($connection, $select_cart);

		$check_cart = mysqli_num_rows($run_cart);

		if($count == 0) {
			echo "<script>alert('Email or password is wrong')</script>";

			exit();
		}

		if($count == 1 and $check_cart==0) {
			$_SESSION['customer_email'] = $customer_email;

			echo "<script>alert('Welcome')</script>";

			echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";
		} else {
			$_SESSION['customer_email'] = $customer_email;

			echo "<script>alert('Welcome!')</script>";

			echo "<script>window.open('checkout.php','_self')</script>";
		}

	}
?>
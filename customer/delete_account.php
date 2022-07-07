<center>
	<h1>Do you really want to delete your account?</h1>

	<form action="" method="post">
		<input type="submit" name="Yes" value="Yes" class="btn btn-danger">
		<input type="submit" name="No" value="No" class="btn btn-primary">
	</form>
</center>

<?php
	$c_email = $_SESSION['customer_email'];

	if(isset($_POST['Yes'])) {
		$delete_customer = "Delete from customers where customer_email = '$c_email'";

		$run_delete = mysqli_query($connection, $delete_customer);

		if($run_delete) {
			session_destroy();

			echo "<script>alert('Deleted successfully')</script>";


			echo "<script>window.open('../index.php', '_self')</script>";
		}
	}

	if(isset($_POST['No'])) {
		echo "<script>window.open('my_account.php', '_self')</script>";
	}
?>
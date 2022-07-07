<h1 align="center">Edit your Password</h1>

<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="">Old Password: </label>
		<input type="text" name="old_pass" class="form-control" required>
	</div>
	<div class="form-group">
		<label for="">New Password: </label>
		<input type="text" name="new_pass" class="form-control" required>
	</div>
	<div class="form-group">
		<label for="">Confirm new password: </label>
		<input type="text" name="new_pass_again" class="form-control" required>
	</div>

	<div class="text-center">
		<button type="submit" name="submit" class="btn btn-primary">
			<i class="fa fa-user-md"></i> Update
		</button>
	</div>
</form>


<?php

	if(isset($_POST['submit'])) {
		$c_email = $_SESSION['customer_email'];

		$c_old = $_POST['old_pass'];

		$c_new_pass = $_POST['new_pass'];

		$c_new_pass_again = $_POST['new_pass_again'];

		$sel_old_pass = "Select * from customers where customer_pass = '$c_old'";

		$run_old = mysqli_query($connection, $sel_old_pass);

		$check_c_old = mysqli_fetch_array($run_old);

		if($check_c_old == 0) {
			echo "<script>alert('Your current password is not valid. Try again')</script>";
			exit();
		}
		if($c_new_pass != $c_new_pass_again) {
			echo "<script>alert('Your new passwords don`t match')</script>";
			exit();
		}


		$update_c_pass = "Update customers set customer_pass = '$c_new_pass_again' where customer_email = '$c_email'";

		$run_c_pass = mysqli_query($connection, $update_c_pass);

		if($run_c_pass) {

			$sender_name = "Fashion Store";

			$sender_email = "fashion-store@ukr.net";

			$sender_subject = "Change password";

			$sender_message = $c_new_pass;

			$receiver_email = $c_email;

			mail($receiver_email, $sender_subject, $sender_message, $sender_email);

			echo "<script>alert('Updated successfully')</script>";

			echo "<script>window.open('my_account.php?my_orders', '_self')</script>";
		}
	}
?>
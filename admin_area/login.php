<?php
	session_start();
	include("includes/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap-337.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/login.css">
	<title>Gang</title>
</head>
<body>

	<div class="container">
		<form action="" class="form-login" method="post">
			<h2 class="form-login-heading">
				Admin Login
			</h2>

			<input type="text" class="form-control" placeholder="Email" name="admin_email" required>


			<input type="password" class="form-control" placeholder="Password" name="admin_pass" required>

			<button type="submit" name="admin_login" class="btn btn-lg btn-primary btn-block">
				Login
			</button>

		</form>
	</div>

</body>
</html>


<?php
	if(isset($_POST['admin_login'])) {
		$admin_email = mysqli_real_escape_string($connection, $_POST['admin_email']);

		$admin_pass = mysqli_real_escape_string($connection, $_POST['admin_pass']);

		$sql = "select * from admins where admin_email = '$admin_email' and admin_pass = '$admin_pass'";

		$res = mysqli_query($connection, $sql);

		$count = mysqli_num_rows($res);

		if($count == 1) {
			$_SESSION['admin_email'] = $admin_email;

			echo "<script>alert('Welcome!')</script>";

			echo "<script>window.open('index.php?dashboard', '_self')</script>";
		} else {
			echo "<script>alert('Wrong input!')</script>";
		}
	}
?>
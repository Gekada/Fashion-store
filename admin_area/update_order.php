<?php
	session_start();
	if(!isset($_SESSION['admin_email'])) {
		echo "<script>window.open('login.php', '_self')</script>";
	} else {
		include('includes/db.php');

		$order_id = $_GET['id'];

		$update = "Update customer_orders set order_status = 'Complete' where order_id = '$order_id'";

		$run = mysqli_query($connection, $update);

		echo "<script>alert('Updated')</script>";

		echo "<script>window.open('index.php?dashboard','_self')</script>";
	}
?>
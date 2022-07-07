
<?php

	session_start();


	if(!isset($_SESSION['customer_email'])) {
		echo "<script>window.open('../checkout.php', '_self')</script>";
	} else {
		include("includes/db.php");
		include("functions/functions.php");


		if(isset($_GET['order_id'])) {
			$order_id = $_GET['order_id'];
		}

		//echo $order_id . " ascaasc";

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles/bootstrap-337.min.css">
	<link rel="stylesheet" href="styles/style.css">
	<link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
	<title>Gang</title>
</head>
<body>

	<div id="top">
		<div class="container">
			<div class="col-md-6 offer">
	            <a href="#" class="btn btn-success btn-sm">
	            	<?php
	            	if(!isset($_SESSION['customer_email'])) {
	            		echo "Welcome guest";
	            	} else {
	            		echo "Welcome: ".$_SESSION['customer_email']."";
	            	}
	            ?>

	            </a>
				<a href="checkout.php"><?php items() ?> Items In Your Cart | Total Price: $ <?php totalPrice() ?></a>
			</div>
			<div class="col-md-6">
				<ul class="menu">
					<li>
						<a href="../customer_register.php">Register</a>
					</li>
					<li>
                        <a href="my_account.php">My account</a>
					</li>
					<li>
                        <a href="../cart.php">Go to cart</a>
					</li>
					<li>
                        <a href="../checkout.php">
                        <?php
			            	if(!isset($_SESSION['customer_email'])) {
			            		echo "<a href='../checkout.php'>Login</a>";
			            	} else {
			            		echo "<a href='logout.php'>Log out</a>";
			            	}
			            ?>
                    	</a>
					</li>
				</ul>
			</div>

		</div>
	</div>

	<div id="navbar" class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<a href="index.php	" class="navbar-brand home">
                    <img src="images/ecom-store-logo.png" class="hidden-xs" alt="">
                    <img src="images/ecom-store-logo-mobile.png" class="visible-xs" alt="">

				</a>
				<button class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="fa fa-align-justify"></i>
				</button>
				<button class="navbar-toggle" data-toggle="collapse" data-target="#search">
                    <span class="sr-only">Toggle search</span>
                    <i class="fa fa-search"></i>
				</button>
			</div>
			<div class="navbar-collapse collapse" id="navigation">
				<div class="padding-nav">
					<ul class="nav navbar-nav left">
						<li><a href="../index.php">Home</a></li>
						<li><a href="../shop.php">Shop</a></li>
						<li class="active"><a href="my_account.php">My account</a></li>
						<li><a href="../cart.php">Shopping cart</a></li>
						<li><a href="../contact.php">Contact us</a></li>
					</ul>
				</div>
				<a href="../cart.php" class="btn navbar-btn btn-primary right">
					<i class="fa fa-shopping-cart"></i>
					<span><?php items() ?> Items in your cart</span>
				</a>
				<div class="navbar-collapse collapse right">
					<button class="btn btn-primary navbar-btn" type="button" data-toggle="collapse" data-target="#search">
						<span class="sr-only">Toggle search</span>

						<i class="fa fa-search"></i>
					</button>
				</div>
				<div class="collapse clearfix" id="search">
					<form action="results.php" method="get" class="navbar-form">
						<div class="input-group">
							<input type="text" name="user_query" placeholder="search" required class="form-control">

							<span class="input-group-btn">

								<button type="submit" name="search" value="Search" class="btn btn-primary">
									<i class="fa fa-search"></i>
								</button>

							</span>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div id="content">
		<div class="container">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li>My account</li>
				</ul>
			</div>

			<div class="col-md-3">
				<?php
					include('includes/sidebar.php');
				?>
			</div>
			<div class="col-md-9">
				<div class="box">
					<h1 align="center">Please confirm payment</h1>
					<form action="" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="">Invoice №: </label>
							<input type="text" name="invoice_no" required class="form-control">
							<input type="hidden" name="update_id" class="form-control" value="<?php echo $order_id ?>">
						</div>
                        <div class="form-group">
							<label for="">Amount: </label>
							<input type="text" name="amount_sent" required class="form-control">
						</div>
						<div class="form-group">
							<label for="">Select payment: </label>
							<select name="payment_mode" id="" class="form-control">
								<option value="">Select:</option>
								<option value="">Back code</option>
								<option value="">UBL</option>
								<option value="">Western union</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Transaction ID: </label>
							<input type="text" name="ref_no" required class="form-control">
						</div>
						<div class="form-group">
							<label for="">Omni Paisa / East Paisa: </label>
							<input type="text" name="code" required class="form-control">
						</div>
						<div class="form-group">
							<label for="">Payment Date: </label>
							<input type="text" name="date" required class="form-control">
						</div>
						<div class="text-center">
							<button name="confirm_payment" class="btn btn-primary btn-lg">
								<i class="fa fa-user-md"></i> Confirm
							</button>
						</div>
					</form>

					<?php
						if(isset($_POST['confirm_payment'])) {
							$update_id = $_POST['update_id'];

							$invoice_no = $_POST['invoice_no'];

							$amount_sent = $_POST['amount_sent'];

							$ref_no = $_POST['ref_no'];

							$payment_mode = $_POST['payment_mode'];

							$code = $_POST['code'];

							$date = $_POST['date'];

							$complete = "Complete";

							$insert_payment = "Insert into payments (invoice_no, amount, payment_mode, ref_no, code, payment_date) values
							('$invoice_no', '$amount_sent', '$payment_mode', '$ref_no', '$code', '$date')";

							$run_payment = mysqli_query($connection, $insert_payment);

							$update_customer_order = "Update customer_orders set order_status = '$complete' where order_id = '$update_id'";

							$run_update = mysqli_query($connection, $update_customer_order);

							error_log($update_customer_order, 0);

							$update_pending_order = "Update pending_orders set order_status = '$complete' where order_id = '$update_id'";

							$run_pending_order = mysqli_query($connection, $update_pending_order);

							error_log($update_pending_order, 0);

							if($run_pending_order) {
								echo "<script>alert('Thanks for purchasing')</script>";

								echo "<script>window.open('my_account.php?my_orders', '_self')</script>";
							} else {

							}
						}
					?>

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
	}
?>
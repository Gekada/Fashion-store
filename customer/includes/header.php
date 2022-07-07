<?php
	session_start();
	include("includes/db.php");
	include("functions/functions.php");

	$date = date("Y-m-d");
	$userIP = $_SERVER['REMOTE_ADDR'];

	$res = $connection -> query("select ip from `views_count` where ip = '$userIP' and `date` = '$date'");
	$row1 = mysqli_num_rows($res);
	if($row1 == 0) {
		mysqli_query($connection, "INSERT INTO `views_count` (`ip`, `date`, `count`) VALUES ('$userIP', '$date', 1)");
	//	echo "row == 0";
	} else {
		$sql3 = "SELECT * FROM `views_count` order by `date` DESC LIMIT 1";
		$res2 = mysqli_query($connection, $sql3);
		$row2 = mysqli_fetch_array($res2);
		if($row2['date'] == $date) {
			$sql = "Update `views_count` set `count` = `count` + 1 where `ip` = '$userIP' and `date` = '$date'";
			error_log($sql, 0);
			mysqli_query($connection, $sql);
		} else {
			mysqli_query($connection, "INSERT INTO `views_count` (`ip`, `date`, `count`) VALUES ('$userIP', '$date', 1)");
		}

	}

?>

<?php
	if(isset($_GET['pro_id'])) {
		$product_id = $_GET['pro_id'];

		$get_product = "select * from products where product_id = $product_id";

		$res = mysqli_query($connection, $get_product);

		$row_product = mysqli_fetch_array($res);

		$p_cat_id = $row_product['p_cat_id'];

		$pro_title = $row_product['product_title'];

		$pro_price = $row_product['product_price'];

		$pro_desc = $row_product['product_desc'];

		$pro_img1 = $row_product['product_img1'];

		$pro_img2 = $row_product['product_img2'];

		$pro_img3 = $row_product['product_img3'];

		$get_p_cat = "Select * from product_categories where p_cat_id = $p_cat_id";

		$res2 = mysqli_query($connection, $get_p_cat);

		$row_p_cat = mysqli_fetch_array($res2);

		$p_cat_title = $row_p_cat['p_cat_title'];
	}
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
				<a href="cart.php"><?php items() ?> Items In Your Cart | Total Price: $ <?php totalPrice() ?></a>
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
				<a href="../index.php" class="navbar-brand home">
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
				<a href="cart.php" class="btn navbar-btn btn-primary right">
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
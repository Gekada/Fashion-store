<?php
	session_start();
	include("includes/db.php");
	if(!isset($_SESSION['admin_email'])) {
		echo "<script>window.open('login.php', '_self')</script>";
	} else {

		$admin_session = $_SESSION['admin_email'];

		$get_admin = "Select * from admins where admin_email = '$admin_session'";

		$run_admin = mysqli_query($connection, $get_admin);

		$row_admin = mysqli_fetch_array($run_admin);

		$admin_id = $row_admin['admin_id'];

		$admin_name = $row_admin['admin_name'];

		$get_products = "Select * from products";

		$run_products = mysqli_query($connection, $get_products);

		$count_products = mysqli_num_rows($run_products);

		$get_customers = "Select * from customers";

		$run_customers = mysqli_query($connection, $get_customers);

		$count_customers = mysqli_num_rows($run_customers);

		$get_p_categories = "Select 8 from product_categories";

		$run_p_categories = mysqli_query($connection, $get_p_categories);

		$count_p_categories = mysqli_num_rows($run_p_categories);

		$get_pending_orders = "Select * from customer_orders where order_status = 'Pending'";

		$run_pending_orders = mysqli_query($connection, $get_pending_orders);

		$count_pending_orders = mysqli_num_rows($run_pending_orders);

		$get_complete_orders = "Select * from customer_orders where order_status = 'Complete'";

		$run_complete_orders = mysqli_query($connection, $get_complete_orders);

		$count_complete_orders = mysqli_num_rows($run_complete_orders);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap-337.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
	<!--<link rel="stylesheet" href="css/login.css">-->
	<title>Gang</title>
</head>
<body>

	<div id="wrapper">
		<?php include("includes/sidebar.php") ?>
		<div id="page-wrapper">
			<div class="container-fluid">

				<?php
					if(isset($_GET['dashboard'])) {
						include("dashboard.php");
					}
					if(isset($_GET['insert_product'])) {
						include("insert_product.php");
					}
					if(isset($_GET['view_products'])) {
						include("view_products.php");
					}
					if(isset($_GET['delete_product'])) {
						include("delete_product.php");
					}
					if(isset($_GET['edit_product'])) {
						include("edit_product.php");
					}

					if(isset($_GET['view_p_cat'])) {
						include("view_p_cat.php");
					}
					if(isset($_GET['insert_p_cat'])) {
						include("insert_p_cat.php");
					}
					if(isset($_GET['delete_p_cat'])) {
						include("delete_p_cat.php");
					}
					if(isset($_GET['edit_p_cat'])) {
						include("edit_p_cat.php");
					}

					if(isset($_GET['insert_cat'])) {
						include("insert_cat.php");
					}
					if(isset($_GET['view_cat'])) {
						include("view_cat.php");
					}
					if(isset($_GET['edit_cat'])) {
						include("edit_cat.php");
					}
					if(isset($_GET['delete_cat'])) {
						include("delete_cat.php");
					}
					if(isset($_GET['insert_slide'])) {
						include("insert_slide.php");
					}
					if(isset($_GET['view_slides'])) {
						include("view_slides.php");
					}
					if(isset($_GET['delete_slide'])) {
						include("delete_slide.php");
					}
					if(isset($_GET['edit_slide'])) {
						include("edit_slide.php");
					}

					if(isset($_GET['view_counts'])) {
						include("view_counts.php");
					}
					if(isset($_GET['total_view_counts'])) {
						include("total_view_counts.php");
					}
					if(isset($_GET['view_customers'])) {
						include("view_customers.php");
					}
					if(isset($_GET['delete_customer'])) {
						include("delete_customer.php");
					}
					if(isset($_GET['view_orders'])) {
						include("view_orders.php");
					}
					if(isset($_GET['delete_order'])) {
						include("delete_order.php");
					}
					if(isset($_GET['add_news'])) {
						include("add_news.php");
					}
					if(isset($_GET['add_product_quantity'])) {
						include("add_product_quantity.php");
					}
					if(isset($_GET['view_pending_orders'])) {
						include("view_pending_orders.php");
					}
					if(isset($_GET['insert_admin'])) {
						include("insert_admin.php");
					}
					if(isset($_GET['view_admins'])) {
						include("view_admins.php");
					}
					if(isset($_GET['delete_admin'])) {
						include("delete_admin.php");
					}
					if(isset($_GET['edit_admin'])) {
						include("edit_admin.php");
					}

				?>

			</div>
		</div>
	</div>

<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>
</body>
</html>

<?php

	}
?>
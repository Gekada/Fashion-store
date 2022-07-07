<?php
	include("includes/db.php");
	include("functions/functions.php");

	if(isset($_GET['c_id'])) {
		$customer_id = $_GET['c_id'];
	}


	$ip_add = getRealIPUser();


	$status = "Pending";



	$invoice_no = mt_rand();

	$select_cart = "Select * from cart where ip_add = '$ip_add'";

	$date = date("Y-m-d");

	$run_cart = mysqli_query($connection, $select_cart);

	while($row_cart = mysqli_fetch_array($run_cart)) {
		$pro_id = $row_cart['p_id'];

		$pro_qty = $row_cart['qty'];

		$pro_size = $row_cart['size'];

		$get_products = "Select * from products where product_id = '$pro_id'";

		$run_products = mysqli_query($connection, $get_products);

		while($row_product = mysqli_fetch_array($run_products)) {
			$sub_total = $row_product['product_price'] * $pro_qty;

			$insert_customer_order = "Insert into customer_orders (customer_id, total_price, invoice_no, order_date, order_status) values
			('$customer_id', '$sub_total', '$invoice_no', '$date', '$status')";

			$run_customer_order = mysqli_query($connection, $insert_customer_order);

			$get_id = $connection->insert_id;

			$insert_product_in_order = "Insert into products_in_order (order_id, product_id, product_qty, product_size) values ('$get_id', '$pro_id', '$pro_qty', '$pro_size')";

			$run_insert_product_in_order = mysqli_query($connection, $insert_product_in_order);

			//error_log($insert_product_in_order, 0);

			//echo "dsfsf" . $run_insert_product_in_order;

			//die();

			$update_stock = "Update in_stock set quantity = quantity - '$pro_qty' where product_id = '$pro_id' and size = '$pro_size'";

			$run_update = mysqli_query($connection, $update_stock);

			$delete_cart = "Delete from cart where ip_add = '$ip_add'";

			$run_delete = mysqli_query($connection, $delete_cart);

			echo "<script>alert('Your order has been submitted')</script>";

			echo "<script>window.open('customer/my_account.php?my_orders', '_self')</script>";


		}
	}

?>


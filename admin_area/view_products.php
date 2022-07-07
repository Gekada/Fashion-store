
<?php
	include("includes/db.php");
	if(!isset($_SESSION['admin_email'])) {
		echo "<script>window.open('login.php', '_self')</script>";
	} else {


?>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="active">
				<i class="fa fa-dashboard"></i> Dashboard / View Products
			</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-tags"></i> View products
				</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>Product ID</th>
								<th>Product Title</th>
								<th>Image</th>
								<th>Price</th>
								<th>Sold</th>
								<th>Keywords</th>
								<th>Size</th>
								<th>Date</th>
								<th>Delete</th>
								<th>Edit</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$get_pro = "Select * from products";

								$run_pro = mysqli_query($connection, $get_pro);

								while($row_pro = mysqli_fetch_array($run_pro)) {
									$pro_id = $row_pro['product_id'];

									$pro_title = $row_pro['product_title'];

									$pro_img1 = $row_pro['product_img1'];

									$pro_price = $row_pro['product_price'];

									$product_keywords = $row_pro['product_keywords'];

									$get_size = "Select size from in_stock where product_id = '$pro_id'";

									$run_size = mysqli_query($connection, $get_size);

									$sizes = "";


									while($row_sizes = mysqli_fetch_array($run_size)) {
										$sizes = $sizes . $row_sizes['size'] . " ";
									}





									$product_size = $row_pro['size'];

									$pro_date = $row_pro['date'];

							?>

							<tr>
								<th><?php echo $pro_id ?></th>
								<th><?php echo $pro_title ?></th>
								<th><img src="product_images/<?php echo $pro_img1 ?>" width="60" height="60" alt=""></th>
								<th>$ <?php echo $pro_price ?></th>
								<th>
									<?php

									$get_sold = "SELECT sum(product_qty) FROM `products_in_order` where product_id = '$pro_id' and order_id in (Select order_id from customer_orders where order_status = 'Complete')";

									$run_sold = mysqli_query($connection, $get_sold);

									$row = mysqli_fetch_array($run_sold);

									$count = $row['sum(product_qty)'];

									echo $count;

									?>
								</th>
								<th><?php echo $product_keywords ?></th>
								<th><?php echo $sizes ?></th>
								<th><?php echo $pro_date ?></th>
								<th><a href="index.php?delete_product=<?php echo $pro_id ?>"><i class="fa fa-trash"></i> Delete </a></th>
								<th><a href="index.php?edit_product=<?php echo $pro_id ?>"><i class="fa fa-pencil"></i> Edit </a></th>
							</tr>

							<?php

								}
							?>


						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>



<?php
	}
?>
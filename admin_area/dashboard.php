

<?php
	include("includes/db.php");
	if(!isset($_SESSION['admin_email'])) {
		echo "<script>window.open('login.php', '_self')</script>";
	} else {


?>


<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Dashboard</h1>
		<ol class="breadcrumb">
			<li class="active">
				<i class="fa fa-dashboard"></i> Dashboard

			</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-tasks fa-5x"></i>
					</div>

					<div class="col-xs-9 text-right">
						<div class="huge">
							<?php echo $count_products ?>
						</div>
						<div>
							Products
						</div>
					</div>

				</div>
			</div>
				<a href="index.php?view_products">
					<div class="panel-footer">
						<span class="pull-left">
							View Details
						</span>
						<span class="pull-right">
							<i class="fa fa-arrow-circle-right"></i>
						</span>
						<div class="clearfix"></div>
					</div>
				</a>
		</div>
	</div>

	<div class="col-lg-3 col-md-6">
		<div class="panel panel-green">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-users fa-5x"></i>
					</div>

					<div class="col-xs-9 text-right">
						<div class="huge">
							<?php echo $count_customers ?>
						</div>
						<div>
							Customers
						</div>
					</div>

				</div>
			</div>
				<a href="index.php?view_customers">
					<div class="panel-footer">
						<span class="pull-left">
							View Details
						</span>
						<span class="pull-right">
							<i class="fa fa-arrow-circle-right"></i>
						</span>
						<div class="clearfix"></div>
					</div>
				</a>
		</div>
	</div>

	<div class="col-lg-3 col-md-6">
		<div class="panel panel-yellow">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-tags fa-5x"></i>
					</div>

					<div class="col-xs-9 text-right">
						<div class="huge">
							<?php echo $count_p_categories ?>
						</div>
						<div>
							Product Categories
						</div>
					</div>

				</div>
			</div>
				<a href="index.php?view_p_cats">
					<div class="panel-footer">
						<span class="pull-left">
							View Details
						</span>
						<span class="pull-right">
							<i class="fa fa-arrow-circle-right"></i>
						</span>
						<div class="clearfix"></div>
					</div>
				</a>
		</div>
	</div>

	<div class="col-lg-3 col-md-6">
		<div class="panel panel-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-shopping-cart fa-5x"></i>
					</div>

					<div class="col-xs-9 text-right">
						<div class="huge">
							<?php echo $count_complete_orders ?>
						</div>
						<div>
							Orders
						</div>
					</div>

				</div>
			</div>
				<a href="index.php?view_orders">
					<div class="panel-footer">
						<span class="pull-left">
							View Details
						</span>
						<span class="pull-right">
							<i class="fa fa-arrow-circle-right"></i>
						</span>
						<div class="clearfix"></div>
					</div>
				</a>
		</div>
	</div>

</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-money fa-fw"></i> Pending Orders
				</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover table-striped table-bordered">
						<thead>
							<tr>
								<th>Order No:</th>
								<th>Order Date:</th>
								<th>Customer email:</th>
								<th>Invoice No:</th>
								<th>Info:</th>
								<th>Change Status:</th>
							</tr>

						</thead>
						<tbody>

							<?php
								$get_order = "Select * from customer_orders where order_status = 'Pending' order by 1 desc limit 0,8";

								$run_order = mysqli_query($connection, $get_order);

								while($row_order = mysqli_fetch_array($run_order)) {

									$order_id = $row_order['order_id'];

									$order_date = $row_order['order_date'];

									$c_id = $row_order['customer_id'];

									$total_price = $row_order['total_price'];

									$invoice_no = $row_order['invoice_no'];

									$products_in_order = $row_order['products_in_order'];

									$get_products = "Select * from products_in_order where order_id = '$order_id'";

									$run_products = mysqli_query($connection, $get_products);

							?>

							<tr>
								<td><?php echo $order_id ?></td>
								<td><?php echo $order_date ?></td>
								<td>
									<?php
										$get_customer = "Select * from customers where customer_id = '$c_id'";

										$run_customer = mysqli_query($connection, $get_customer);

										$row_customer = mysqli_fetch_array($run_customer);

										$customer_email = $row_customer['customer_email'];

										echo $customer_email;
									?>
								</td>
								<td><?php echo $invoice_no ?></td>
								<td>
									<button type="button" class="btn btn-primary launch" data-toggle="modal" data-target="#staticBackdrop<?php echo $order_id ?>"> <i class="fa fa-info"></i>
										Get information</button>
									<div class="modal fade" id="staticBackdrop<?php echo $order_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
									    <div class="modal-dialog">
									        <div class="modal-content">
									            <div class="modal-body ">
									                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i> </div>

									                <div class="px-4 py-5">

									                    <h5 class="text-uppercase">Order number: <?php echo $order_id ?></h5>
									                    <h5>Invoice_no: <?php echo $invoice_no ?> </h5>



									                <h4 class="mt-5 theme-color mb-5">Thanks for your order</h4>

									                <span class="theme-color">Payment Summary</span>
									                <div class="mb-3">
									                    <hr class="new1">
									                </div>

									                <?php
									                	$get_products = "Select * from products_in_order where order_id = '$order_id'";

									                	$run_get_products = mysqli_query($connection, $get_products);

									                	while($row = mysqli_fetch_array($run_get_products)) {
									                		$product_id = $row['product_id'];

										                	$product_qty = $row['product_qty'];

										                	$product_size = $row['product_size'];

										                	$get_pro = "Select * from products where product_id = '$product_id'";

										                	$run_pro = mysqli_query($connection, $get_pro);

										                	while($info = mysqli_fetch_array($run_pro)) {
											                	$product_price = $info['product_price'];

										                	 	$product_title = $info['product_title'];



									                 ?>

									                <div class="d-flex justify-content-between">
									                    <span class="font-weight-bold">Product Title: <?php echo $product_title ?>(Qty:<?php echo $product_qty ?>)</span>
									                    <span class="text-muted">Size: <?php echo $product_size ?></span>
									                    <span class="text-muted">$ <?php echo $product_price ?></span>
														<span class="text-muted">Sub-Total: $ <?php echo $product_price * $product_qty?></span>
									                </div>

									            		<?php
									            			}
									            		}	 ?>

									                <div class="d-flex justify-content-between mt-3">
									                    <span class="font-weight-bold">Total</span>
									                    <span class="font-weight-bold theme-color">$ <?php echo $total_price ?></span>
									                </div>

									                </div>


									            </div>
									        </div>
									    </div>
									</div>
								</td>
								<form action="" method="post">
									<td>
										<a class="btn btn-default" href="update_order.php?id=<?php echo $order_id ?>">Complete</a>
									</td>
								</form>
							</tr>


						<?php } ?>

						</tbody>
					</table>
				</div>

				<div class="text-right">
					<a href="index.php?view_pending_orders">
						View Pending Orders <i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>

			</div>
		</div>
	</div>





</div>


<?php
	}
?>


<?php

?>
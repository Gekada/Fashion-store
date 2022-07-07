
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
				<i class="fa fa-dashboard"></i> Dashboard / View Pending Orders
			</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-tags"></i> View Pending Orders
				</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>Customer_email</th>
								<th>Invoice No</th>
								<th>Info</th>
								<th>Date</th>
								<th>Total</th>
								<th>Change Status:</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$get_pro = "Select * from customer_orders where order_status = 'Pending' order by 1 desc";

								$run_pro = mysqli_query($connection, $get_pro);

								while($row_pro = mysqli_fetch_array($run_pro)) {
									$o_id = $row_pro['order_id'];

									$customer_id = $row_pro['customer_id'];

									$invoice_no = $row_pro['invoice_no'];

									$total_price = $row_pro['total_price'];

									$get_products = "Select * from products_in_order where order_id = '$o_id'";

									$run_products = mysqli_query($connection, $get_products);

									$get_customer = "Select * from customers where customer_id = '$customer_id'";

									$run_c = mysqli_query($connection, $get_customer);

									$row_customer = mysqli_fetch_array($run_c);

									$customer_email = $row_customer['customer_email'];

									$date = $row_pro['order_date'];

									$total = $row_pro['total_price'];


							?>

							<tr>
								<th><?php echo $o_id ?></th>
								<th><?php echo $customer_email ?></th>
								<th><?php echo $invoice_no ?></th>
								<th>
									<button type="button" class="btn btn-primary launch" data-toggle="modal" data-target="#staticBackdrop<?php echo $o_id ?>"> <i class="fa fa-info"></i>
						Get information</button>
					<div class="modal fade" id="staticBackdrop<?php echo $o_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					    <div class="modal-dialog">
					        <div class="modal-content">
					            <div class="modal-body ">
					                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i> </div>

					                <div class="px-4 py-5">

					                    <h5 class="text-uppercase">Order number: <?php echo $o_id ?></h5>
					                    <h5>Invoice_no: <?php echo $invoice_no ?> </h5>



					                <h4 class="mt-5 theme-color mb-5">Thanks for your order</h4>

					                <span class="theme-color">Payment Summary</span>
					                <div class="mb-3">
					                    <hr class="new1">
					                </div>

					                <?php
					                	$get_products = "Select * from products_in_order where order_id = '$o_id'";

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
					</div></th>
								<th><?php echo $date ?></th>
								<th><?php echo $total ?></th>
								<th><form action="" method="post">
										<a class="btn btn-default" href="update_order.php?id=<?php echo $o_id ?>">Complete</a>
								</form></th>
								<th><a href="index.php?delete_order=<?php echo $o_id ?>"><i class="fa fa-trash"></i> Delete </a></th>
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
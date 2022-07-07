
<style>
	.disabled {
	    pointer-events:none
	}
</style>

<center>
	<h1>My Orders</h1>


</center>

<hr>

<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>ON: </th>
				<th>Total Price: </th>
				<th>Invoice: </th>
				<th>Order Date: </th>
				<th>Status: </th>
				<th>Info: </th>
			</tr>
		</thead>
		<tbody>
			<?php
				$customer_session = $_SESSION['customer_email'];

				$get_customer = "Select * from customers where customer_email = '$customer_session'";

				$run_customer = mysqli_query($connection, $get_customer);

				$row_customer = mysqli_fetch_array($run_customer);

				$customer_id = $row_customer['customer_id'];

				$get_orders = "Select * from customer_orders where customer_id = '$customer_id'";

				$run_orders = mysqli_query($connection, $get_orders);

				$i = 0;

				while($row_orders = mysqli_fetch_array($run_orders)) {
					$order_id = $row_orders['order_id'];

					$total_price = $row_orders['total_price'];

					$invoice_no = $row_orders['invoice_no'];

					$order_date = substr($row_orders['order_date'], 0, 11);

					$order_status = $row_orders['order_status'];

					$i++;



			?>
			<tr>
				<th><?php echo $i ?></th>
				<td>$ <?php echo $total_price ?></td>
				<td><?php echo $invoice_no ?></td>
				<td><?php echo $order_date ?></td>
				<td><?php echo $order_status ?></td>
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
			</tr>
			<?php
				}
			?>
		</tbody>
	</table>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
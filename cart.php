	<?php
		$active = 'Cart';
		include("includes/header.php");
	?>

	<div id="content">
		<div class="container">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li>Cart</li>
				</ul>
			</div>

			<div id="cart" class="col-md-9">
				<div class="box">
					<form action="cart.php" enctype="multipart/form-data" method="post">
						<h1>Shopping Cart</h1>

						<?php
							$ip_add = getRealIPUser();

							$select_cart = "Select * from cart where ip_add = '$ip_add'";

							$res = mysqli_query($connection, $select_cart);

							$count = mysqli_num_rows($res);


						?>

						<p class="text-muted">You currently have <?php echo $count ?> item(s) in your cart</p>

						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th colspan="2">Product</th>
										<th>Quantity</th>
										<th>Unit Price</th>
										<th>Size</th>
										<th colspan="1">Delete</th>
										<th colspan="2">Sub-total</th>
									</tr>
								</thead>
								<tbody>
								<?php

								$total = 0;

								while ($row_cart = mysqli_fetch_array($res)) {
									$pro_id = $row_cart['p_id'];
									$pro_size = $row_cart['size'];
									$pro_qty = $row_cart['qty'];

									$get_products = "Select * from products where product_id = '$pro_id'";

									$run_products = mysqli_query($connection, $get_products);

									while ($row_products = mysqli_fetch_array($run_products)) {

										$product_title = $row_products['product_title'];

										$product_img1 = $row_products['product_img1'];

										$only_price = $row_products['product_price'];

										$sub_total = $row_products['product_price'] * $pro_qty;

										$total += $sub_total;

								?>

									<tr>
										<td>
											<img class="img-responsive" src="admin_area/product_images/<?php echo $product_img1; ?>" alt="">
										</td>
										<td>
											<a href="details.php?pro_id=<?php echo $pro_id?>"><?php echo $product_title ?></a>
										</td>
										<td>
											<input type="number" value="<?php echo $pro_qty ?>" id="tentacles" name="tentacles" min="1" max="100">
										</td>
                                        <td>
											$<?php echo $only_price ?>
										</td>
										<td>
											<?php echo $pro_size ?>
										</td>
										<td>
											<input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>">
										</td>
										<td>
											$<?php echo $sub_total ?>
										</td>
									</tr>
								<?php
									}
								}
								?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="5">Total</th>
										<th colspan="2">$<?php echo $total ?></th>
									</tr>
								</tfoot>
							</table>
						</div>

						<div class="box-footer">
							<div class="pull-left">
								<a href="index.php" class="btn btn-default">
									<i class="fa fa-chevron-left"></i>Continue shopping
								</a>
							</div>
							<div class="pull-right">
								<button type="submit" name="update" value="Update cart" class="btn btn-default">
									<i class="fa fa-refresh"></i>Update cart
								</button>
								<!--<a href="checkout.php" class="btn btn-primary">
									Checkout <i class="fa fa-chevron-right"></i>
								</a>-->
								<button type="submit" name="checkout" value="Checkout" class="btn btn-primary">
									<i class="fa fa-chevron-right"></i>Checkout
								</button>
							</div>
						</div>

					</form>
				</div>



				<?php
					function updateCart() {
						global $connection;

						if(isset($_POST['update'])) {
							foreach ($_POST['remove'] as $remove_id) {
								$delete_product = "delete from cart where p_id = '$remove_id'";

								$run_delete = mysqli_query($connection, $delete_product);

								if($run_delete) {
									echo "<script>window.open('cart.php', '_self')</script>";
								}
							}
						}




					}

					echo @$up_cart = updateCart();

				?>






				<div id="row same-height-row">
					<div class="col-md-3 col-sm-6">
						<div class="box same-height headline">
							<h3 class="text-center">You may Like these Products</h3>
						</div>
					</div>
					<?php

						$get_products = "Select distinct(product_title), product_id, product_price, product_img1 from products where product_id in (Select product_id from in_stock where quantity > 0) order by rand() limit 0,3";

						//$get_products = "Select * from products order by rand() limit 0, 3";

						$res = mysqli_query($connection, $get_products);

						while ($row = mysqli_fetch_array($res)) {
							$pro_id = $row['product_id'];

							$pro_title = $row['product_title'];

							$pro_img1 = $row['product_img1'];

							$pro_price = $row['product_price'];

							echo "
								<div class='col-md-3 col-sm-6 center-responsive'>
									<div class='product same-height'>
										<a style='display:flex; justify-content:center' href='details.php?pro_id=$pro_id'>
											<img style='height:200px;' class='img-responsive' src='admin_area/product_images/$pro_img1'>
										</a>
										<div class='text'>
											<h3><a href='details.php?pro_id=$pro_id'>$pro_title</a></h3>

											<p class='price'>$ $pro_price</p>
										</div>
									</div>
								</div>
							";
						}
					?>
				</div>
			</div>
			<div class="col-md-3">
				<div id="order-summary" class="box">
					<div class="box-header">
						<h3>Order summary</h3>
					</div>

					<div class="table-responsive">
						<table class="table">
							<tbody>
								<tr>
									<td>
										Order sub-total
									</td>
									<th>
										$<?php echo $total ?>
									</th>
								</tr>
								<tr>
									<td>Shipping and handling</td>
									<td>$ 0</td>
								</tr>
								<tr>
									<td>Tax</td>
									<th>$ 0</th>
								</tr>
								<tr class="total">
									<td>Total</td>
									<th>$ <?php echo $total ?></th>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
		if(isset($_POST['checkout'])) {

			$get_cart = "select * from cart where ip_add = '$ip_add'";

			$run_get_cart = mysqli_query($connection, $get_cart);

			while ($row = mysqli_fetch_array($run_get_cart)) {

				$product_id = $row['p_id'];

				$product_size = $row['size'];

				$product_qty = $row['qty'];

				$get_product_name = "Select * from products where product_id = '$product_id'";

				$run_get_name = mysqli_query($connection, $get_product_name);

				$row_name = mysqli_fetch_array($run_get_name);

				$product_name = $row_name['product_title'];

				$get_qty_in_stock = "Select * from in_stock where product_id = '$product_id' and size = '$product_size'";

				$run_qty_in_stock = mysqli_query($connection, $get_qty_in_stock);

				$row = mysqli_fetch_array($run_qty_in_stock);

				$sizes_in_stock = $row['quantity'];

				//echo "qty " . $product_qty . " stock " . $sizes_in_stock;

				//die();

				if($product_qty > $sizes_in_stock) {
					echo "<script>alert('$product_name Нет в наличии. Осталось: $sizes_in_stock штук')</script>";
				} else {
					echo "<script>window.open('checkout.php', '_self')</script>";
				}
			}


		}
	?>

	<?php
		include('includes/footer.php');
	?>

	<script src="js/jquery-331.min.js"></script>
	<script src="js/bootstrap-337.min.js"></script>

</body>
</html>
	<?php
		$active = 'Shop';
		include("includes/header.php");




	?>

	<div id="content">
		<div class="container">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li>Shop</li>
				</ul>
			</div>

			<div class="col-md-3">
				<?php
					include('includes/sidebar.php');
				?>
			</div>

			<div class="col-md-9">


				<?php

				if(!isset($_GET['p_cat'])) {
					if(!isset($_GET['cat'])) {
					echo "
						<div class='box'>
							<h1>Shop</h1>
							<p>
								Lorem ipsum dolor sit amet consectetur adipisicing, elit. Placeat praesentium laudantium doloribus cum veniam consequuntur at dignissimos laboriosam quisquam! A blanditiis voluptatibus necessitatibus architecto accusantium hic unde soluta nobis at!
							</p>
						</div>
					";
					}
				}
				?>

				<form action="" method="post">
					<div style="margin-bottom:20px; display:table;">
					<select id="price" name="price" style="background-color: transparent; border: 1px solid black;" onchange="myFunction()" class="btn btn-primary-outline dropdown-toggle">
						<option disabled selected value="">Price</option>
						<option value='20'>0-20</option>
						<option value='20-100'>20-100</option>
						<option value='100-250'>100-250</option>
						<option value='250-500'>250-500</option>
						<option value='500-1000'>500-1000</option>
						<option value='1000-∞'>1000-∞</option>
					</select>
					<select id="size" name="size" style="margin-left: 10px; background-color: transparent; border: 1px solid black;" onchange="myFunction()" class="btn btn-primary-outline dropdown-toggle">
						<option disabled selected value="">Size</option>
						<option value='S'>S</option>
						<option value='M'>M</option>
						<option value='L'>L</option>
					</select>
					<select id="product_cat" name="product_cat" style="margin-left: 10px; background-color: transparent; border: 1px solid black;" onchange="myFunction()" class="btn btn-primary-outline dropdown-toggle">
						<option disabled selected value="">Category Product</option>

						<?php
							$sql = "select * from product_categories";

							$res = mysqli_query($connection, $sql);

							while($row = mysqli_fetch_array($res)) {
								$p_cat_id = $row['p_cat_id'];
								$p_cat_title = $row['p_cat_title'];

								echo "
									<option value='$p_cat_id'>$p_cat_title</option>
								";
							}
						?>

					</select>
					<select id="cat"  name="cat" style="margin-left: 10px; background-color: transparent; border: 1px solid black;" onchange="myFunction()" class="btn btn-primary-outline dropdown-toggle">
						<option disabled selected value="">For</option>

						<?php
							$sql = "select * from categories";

							$res = mysqli_query($connection, $sql);

							while($row = mysqli_fetch_array($res)) {
								$cat_id = $row['cat_id'];
								$cat_title = $row['cat_title'];

								echo "
									<option value='$cat_id'>$cat_title</option>
								";
							}
						?>

					</select>
					<input type="submit" style="display: inline-block; margin-left: 10px; " value="Clear Filtres" class="btn btn-primary">
					<select id="sort" name="sort" style="margin-left: 10px; background-color: transparent; border: 1px solid black;" onchange="myFunction()" class="btn btn-primary-outline dropdown-toggle">
						<option disabled selected value="">Sort by</option>
						<option value='Lower Price'>Lower Price</option>
						<option value='Higher price'>Higher price</option>
						<option value='New Products'>New Products</option>
					</select>
				</div>
				</form>


				<div id="prods" class="row">

					<?php
						if(!isset($_GET['p_cat'])) {
							if(!isset($_GET['cat'])) {
								$per_page = 6;
								if(isset($_GET['page'])) {
									$page = $_GET['page'];
								}else {
									$page = 1;
								}

									$start_from = ($page-1) * $per_page;

									//$get_products = "Select * from products order by 1 desc limit $start_from, $per_page";
									//
									$get_products = "Select distinct(product_title), product_id, product_price, product_img1 from products where product_id in (Select product_id from in_stock where quantity > 0) order by 2 desc limit $start_from, $per_page";

									$run_products = mysqli_query($connection, $get_products);

									while($row = mysqli_fetch_array($run_products)) {
										$pro_id = $row['product_id'];
										$pro_title = $row['product_title'];
										$pro_price = $row['product_price'];
										$pro_img1 = $row['product_img1'];

										echo "
											<div class='col-md-4 col-sm-6 center-responsive'>
												<div class='product'>
													<a style='display:flex; justify-content:center' href='details.php?pro_id=$pro_id'>
														<img style='height:258px;' class='img-responsive' src='admin_area/product_images/$pro_img1'>
													</a>
													<div class='text'>
														<h3>
															<a href='details.php?pro_id=$pro_id'>
																$pro_title
															</a>
														</h3>
														<p class='price'>
															$ $pro_price
														</p>
														<p class='button'>
															<a href='details.php?pro_id=$pro_id' class='btn btn-default'>
																View details
															</a>
															<a href='details.php?pro_id=$pro_id' class='btn btn-primary'>
																<i class='fa fa-shopping-cart'>
																	Add to Cart
																</i>
															</a>
														</p>
													</div>
												</div>
											</div>
										";

									}

					?>



				</div>
				<center>
					<ul id="pagin" class="pagination">
						<?php

							$query = "Select distinct(product_title), product_id, product_price, product_img1 from products where product_id in (Select product_id from in_stock where quantity > 0)";

							$res = mysqli_query($connection, $query);

							$records = mysqli_num_rows($res);

							$total_pages = ceil($records / $per_page);

							echo "
								<li><a href='shop.php?page=1'>".'First Page'."</a></li>
							";

							for ($i = 1; $i <= $total_pages; $i++) {
								echo "
									<li><a href='shop.php?page=".$i."'>".$i."</a></li>
								";
							}
								echo "
								<li><a href='shop.php?page=$total_pages'>".'Last Page'."</a></li>
							";
							}
						}
						?>
					</ul>
				</center>
					<?php
						getpcatpro();
						getcatpro();
					 ?>
			</div>

		</div>
	</div>

	<?php
		if(isset($_POST['submit'])) {
			echo sdvhsivds;
		}
	 ?>

	<script>
		function myFunction() {
			document.getElementById("prods").innerHTML = "";
			document.getElementById("pagin").innerHTML = "";
			$price = $("#price").val();
			$size = $("#size").val();
			$product_cat = $("#product_cat").val();
			$cat = $("#cat").val();
			$sort = $("#sort").val();

		  $.ajax({
                    url: 'filter.php',
                    type: 'POST',
                    data: {
                    	price: $price,
                    	size: $size,
                    	product_cat: $product_cat,
                    	cat: $cat,
                    	sort: $sort
                    },
                    success: function(result) {
                        $("#prods").append(result);
                    }
                });
		}
	</script>

	<?php
		include('includes/footer.php');
	?>

	<script src="js/jquery-331.min.js"></script>
	<script src="js/bootstrap-337.min.js"></script>

</body>
</html>
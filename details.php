	<?php
		$active = 'Cart';
		include("includes/header.php");
	?>

	<div id="content">
		<div class="container">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li>Shop</li>
					<li>
						<a href="shop.php?p_cat=<?php echo $p_cat_id ?>"><?php echo $p_cat_title ?></a>
					</li>
					<li>
						<?php echo $pro_title ?>
					</li>
				</ul>
			</div>

			<div class="col-md-3">
				<?php
					include('includes/sidebar.php');
				?>
			</div>

			<div class="col-md-9">
				<div id="productMain" class="row">
					<div class="col-sm-6">
						<div id="mainImage">
							<div id="myCarousel" class="carousel slide">
								<ol class="carousel-indicators">
									<li data-slide-to="0" class="active" data-target="#myCarousel"></li>
									<li data-slide-to="1" data-target="#myCarousel"></li>
									<li data-slide-to="2" data-target="#myCarousel"></li>
								</ol>
								<div class="carousel-inner">
									<div class="item active">
										<center><img style="height:315px;" class="img-responsive" src="admin_area/product_images/<?php echo $pro_img1 ?>" alt=""></center>
									</div>
									<div class="item">
										<center><img style="height:315px;" class="img-responsive" src="admin_area/product_images/<?php echo $pro_img2 ?>" alt=""></center>
									</div>
									<div class="item">
										<center><img style="height:315px;" class="img-responsive" src="admin_area/product_images/<?php echo $pro_img3 ?>" alt=""></center>
									</div>
								</div>

								<a href="#myCarousel" class="left carousel-control" data-slide="prev">
									<span class="glyphicon glyphicon-chevron-left"></span>
									<span class="sr-only">Previous</span>
								</a>

								<a href="#myCarousel" class="right carousel-control" data-slide="next">
									<span class="glyphicon glyphicon-chevron-right"></span>
									<span class="sr-only">Next</span>
								</a>

							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="box">
							<h1 class="text-center"><?php echo $pro_title ?></h1>

							<?php add_cart() ?>

							<form action="details.php?add_cart=<?php echo $product_id ?>" class="form-horizontal" method="post">
								<div class="form-group">
									<label for="" class="col-md-5 control-label">Quantity:</label>
									<div class="col-md-7">
										<select name="product_qty" id="" class="form-control">
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">
										Size:
									</label>
									<div class="col-md-7">
										<select name="product_size" class="form-control" required oninput="setCustomValidity('')" oninvalid="setCustomValidity('Must pick 1 size for the product')">
											<option disabled selected value="">Select</option>
											<?php
												$get_sizes = "select * from in_stock where product_id = '$product_id' and quantity <> 0";

												//error_log($get_sizes, 0);

												$run = mysqli_query($connection, $get_sizes);

												while($row = mysqli_fetch_array($run)) {

													$size = $row['size'];

													echo "<option value='$size'>$size</option>";
											?>



											<?php
												}
											?>

										</select>
									</div>
								</div>
								<p class="price">$<?php echo $pro_price ?></p>
								<p class="text-center buttons"><button class="btn btn-primary i fa fa-shopping-cart">Add To Cart</button></p>
							</form>
						</div>
						<div class="row" id="thumbs">
							<div class="col-xs-4"><a style='display:flex; border: 2px solid transparent; justify-content:center; box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.5);' data-slide-to="0" data-target="#myCarousel" href="" class="thumb"><img style="height:100px;" src="admin_area/product_images/<?php echo $pro_img1 ?>" alt="" class="img-responsive"></a></div>
							<div class="col-xs-4"><a style='display:flex; border: 2px solid transparent; justify-content:center; box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.5);' data-slide-to="1" data-target="#myCarousel" href="" class="thumb"><img style="height:100px;" src="admin_area/product_images/<?php echo $pro_img2 ?>" alt="" class="img-responsive"></a></div>
							<div class="col-xs-4"><a style='display:flex; border: 2px solid transparent; justify-content:center; box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.5);'  data-slide-to="2" data-target="#myCarousel" href="" class="thumb"><img style="height:100px;" src="admin_area/product_images/<?php echo $pro_img3 ?>" alt="" class="img-responsive"></a></div>

						</div>

					</div>
				</div>
				<div class="box" id="details">

					<h4>Product Details</h4>

					<p>
						<?php echo $pro_desc ?>
					</p>

					<hr>
				</div>
				<div id="row same-height-row">
					<div class="col-md-3 col-sm-6">
						<div class="box same-height headline">
							<h3 class="text-center">You may Like these Products</h3>
						</div>
					</div>

					<?php
						$get_products = "Select distinct(product_title), product_id, product_price, product_img1 from products where product_id in (Select product_id from in_stock where quantity > 0) order by rand() limit 0,3";

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
											<h3 width='100%'><a href='details.php?pro_id=$pro_id'>$pro_title</a></h3>

											<p class='price'>$ $pro_price</p>
										</div>
									</div>
								</div>
							";
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
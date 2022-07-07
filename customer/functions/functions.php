<?php
	$db = mysqli_connect("localhost", "root", "", "fashion_store");


	function getRealIPUser() {
		switch (true) {
			case(!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
			case(!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
			case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];

			default:
				// code...
				return $_SERVER['REMOTE_ADDR'];
		}
	}

	function add_cart() {
		global $db;

		if(isset($_GET['add_cart'])) {
			$ip_add = getRealIPUser();

			$p_id = $_GET['add_cart'];

			$product_qty = $_POST['product_qty'];

			$product_size = $_POST['product_size'];

			$check_product = "Select * from cart where ip_add = '$ip_add' and p_id = '$p_id'";


			$res = mysqli_query($db, $check_product);

			if(mysqli_num_rows($res) > 0) {
				echo "<script>alert('This product already added into cart. Quantity was updated')</script>";
				//echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";

				$update = "Update cart set qty = qty + '$product_qty' where p_id = '$p_id' and size = '$product_size' and ip_add = '$ip_add'";

				error_log($update, 0);

				$run_update = mysqli_query($db, $update);

				echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";

			} else {


				$query = "Insert into cart (p_id, ip_add, qty, size) values ('$p_id', '$ip_add', '$product_qty', '$product_size')";



				$run = mysqli_query($db, $query);

				echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";


			}



		}
	}


	function getPro() {
		global $db;

		$sql = "Select distinct(product_title), product_id, product_price, product_img1 from products where cat_id = $cat_id and product_id in (Select product_id from in_stock where quantity > 0) order by 2 desc limit 0,8";

		$res = mysqli_query($db, $sql);

		while($row = mysqli_fetch_array($res)) {
			$pro_id = $row['product_id'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_img1 = $row['product_img1'];


			echo "
			<div class='col-md-4 col-sm-6 single'>
				<div class='product'>
					<a style='display:flex; justify-content:center' href='details.php?pro_id=$pro_id'>
						<img style='height:258px;' class='img-responsive' src='admin_area/product_images/$pro_img1'>
					</a>
					<div class='text'>
						<h3>
							<a href='details.php'>
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
	}

	function getPCats() {

		global $db;

		$sql = "Select * from product_categories";

		$res = mysqli_query($db, $sql);

		while($row = mysqli_fetch_array($res)) {
			$p_cat_id = $row['p_cat_id'];
			$p_cat_title = $row['p_cat_title'];

			echo "
				<li><a href='shop.php?p_cat=$p_cat_id'>$p_cat_title</a></li>
			";
		}
	}

	function getCats() {
		global $db;

		$sql = "Select * from categories";

		$res = mysqli_query($db, $sql);

		while($row = mysqli_fetch_array($res)) {
			$cat_id = $row['cat_id'];
			$cat_title = $row['cat_title'];

			echo "
				<li><a href='shop.php?cat=$cat_id'>$cat_title</a></li>
			";
		}
	}

	function getpcatpro() {
		global $db;

		if(isset($_GET['p_cat'])) {
			$p_cat_id = $_GET['p_cat'];

			$get_p_cat = "Select * from product_categories where p_cat_id = '$p_cat_id'";

			$res = mysqli_query($db, $get_p_cat);

			$row = mysqli_fetch_array($res);

			$p_cat_title = $row['p_cat_title'];

			$p_cat_desc = $row['p_cat_desc'];

			$get_products = "Select distinct(product_title), product_id, product_price, product_img1 from products where p_cat_id = '$p_cat_id' and product_id in (Select product_id from in_stock where quantity > 0) order by 2 desc";

			$res2 = mysqli_query($db, $get_products);

			$count = mysqli_num_rows($res2);

			if($count == 0 ) {
				echo "
					<div class='box'>
						<h1>nO pRODUCT fOUND</h1>
					</div>
				";
			} ELSE {
				echo "
					<div class='box'>
						<h1>$p_cat_title</h1>
						<p>$p_cat_desc</p>
					</div>
				";
			}

			while ($row_products = mysqli_fetch_array($res2)) {
				$pro_id = $row_products['product_id'];
				$pro_title = $row_products['product_title'];
				$pro_price = $row_products['product_price'];
				$pro_img1 = $row_products['product_img1'];

				echo "
				<div class='col-md-4 col-sm-6 center-responsive'>
					<div class='product'>
						<a style='display:flex; justify-content:center' href='details.php?pro_id=$pro_id'>
							<img style='height:258px;' class='img-responsive' src='admin_area/product_images/$pro_img1'>
						</a>
						<div class='text'>
							<h3>
								<a href='details.php'>
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
		}
	}


	function getcatpro() {
		global $db;

		if(isset($_GET['cat'])) {
			$cat_id = $_GET['cat'];

			$get_cat = "Select * from categories where cat_id = $cat_id";

			$res = mysqli_query($db, $get_cat);

			$row_cat = mysqli_fetch_array($res);

			$cat_title = $row_cat['cat_title'];

			$cat_desc = $row_cat['cat_desc'];

			$get_products = "Select distinct(product_title), product_id, product_price, product_img1 from products where cat_id = $cat_id and product_id in (Select product_id from in_stock where quantity > 0) order by 2 desc limit 0,6";

			$res2 = mysqli_query($db, $get_products);

			$count = mysqli_num_rows($res2);

			if($count == 0) {
				echo "<div class='box'>
						<h1>nO pRODUCT fOUND</h1>
					</div>";
			} else {
					echo "<div class='box'>
						<h1>$cat_title</h1>
						<p>$cat_desc </p>
					</div>";
			}

			while ($row_prod = mysqli_fetch_array($res2)) {
				$pro_id = $row_prod['product_id'];
				$pro_title = $row_prod['product_title'];
				$pro_price = $row_prod['product_price'];
				$pro_img1 = $row_prod['product_img1'];
				$pro_desc = $row_prod['product_desc'];

				echo "
				<div class='col-md-4 col-sm-6 center-responsive'>
					<div class='product'>
						<a style='display:flex; justify-content:center' href='details.php?pro_id=$pro_id'>
							<img style='height:258px;' class='img-responsive' src='admin_area/product_images/$pro_img1'>
						</a>
						<div class='text'>
							<h3>
								<a href='details.php'>
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



		}
	}

	function items() {
		global $db;

		$ip_add = getRealIPUser();

		$sql = "Select * from cart where ip_add = '$ip_add'";

		$res = mysqli_query($db, $sql);

		$count = mysqli_num_rows($res);

		echo $count;
	}

	function totalPrice() {

		global $db;

		$ip_add = getRealIPUser();

		$total = 0;

		$sql = "Select * from cart where ip_add = '$ip_add'";

		$res = mysqli_query($db, $sql);

		while ($record = mysqli_fetch_array($res)) {
			$pro_id = $record['p_id'];

			$pro_qty = $record['qty'];

			$price = "Select * from products where product_id = $pro_id";

			$res = mysqli_query($db, $price);

			while($row_price = mysqli_fetch_array($res)) {
				$sub_total = $row_price['product_price'] * $pro_qty;

				$total += $sub_total;
			}
		}

		echo $total;
	}


?>
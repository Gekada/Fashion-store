


<?php
	include("includes/db.php");
	if(!isset($_SESSION['admin_email'])) {
		echo "<script>window.open('login.php', '_self')</script>";
	} else {


?>



<?php
	include("includes/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap-337.min.css">
	<link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
	<script src="js/tinymce/tinymce.min.js"></script>
	<script>tinymce.init({selector:'textarea'});</script>
	<title>Document</title>
</head>
<body>

	<div class="row">
		<div class="col-lg-12">
			<ol class="breadcrumb">
				<li class="active">
					<i class="fa fa-dashboard"></i> Dashboard / Insert Products
				</li>
			</ol>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class="fa fa-money fa-fw"></i> Insert Product
					</h3>
				</div>
				<div class="panel-body">
					<form method="post" enctype="multipart/form-data" class="form-horizontal">
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Product Title</label>
							<div class="col-md-6">
								<input type="text" name="product_title" required class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Product Category</label>
							<div class="col-md-6">
								<select name="product_cat" id="" class="form-control">
									<option disabled selected value="">Select a Category Product</option>

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
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Category</label>
							<div class="col-md-6">
								<select name="cat" id="" class="form-control">
									<option disabled selected value="">Select a Category</option>

									<?php
										$sql1 = "select * from categories";

										$res1 = mysqli_query($connection, $sql1);

										while($row1 = mysqli_fetch_array($res1)) {
											$cat_id = $row1['cat_id'];
											$cat_title = $row1['cat_title'];

											echo "
												<option value='$cat_id'>$cat_title</option>
											";
										}
									?>

								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Product image 1</label>
							<div class="col-md-6">
								<input type="file" name="product_img1" required class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Product image 2</label>
							<div class="col-md-6">
								<input type="file" name="product_img2" required class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Product image 3</label>
							<div class="col-md-6">
								<input type="file" name="product_img3" required class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Product Price</label>
							<div class="col-md-6">
								<input type="text" name="product_price" required class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Product Keywords</label>
							<div class="col-md-6">
								<input type="text" name="product_keywords" required class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Product Desc</label>
							<div class="col-md-6">
								<textarea name="product_desc" id="" cols="19" rows="6" class="form-control"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label"></label>
							<div class="col-md-6">
								<input type="submit" name="submit" value="Insert Product" class="btn btn-primary form-control">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php
		if(isset($_POST['submit'])) {
			$product_title = $_POST['product_title'];
			$product_cat = $_POST['product_cat'];
			$cat = $_POST['cat'];
			$product_price = $_POST['product_price'];
			$product_keywords = $_POST['product_keywords'];
			$product_desc = $_POST['product_desc'];

			$product_img1 = $_FILES['product_img1']['name'];
			$product_img2 = $_FILES['product_img2']['name'];
			$product_img3 = $_FILES['product_img3']['name'];

			$temp_name1 = $_FILES['product_img1']['tmp_name'];
			$temp_name2 = $_FILES['product_img2']['tmp_name'];
			$temp_name3 = $_FILES['product_img3']['tmp_name'];

			move_uploaded_file($temp_name1, "product_images/$product_img1");
			move_uploaded_file($temp_name2, "product_images/$product_img2");
			move_uploaded_file($temp_name3, "product_images/$product_img3");

				$insert = "insert into products (p_cat_id, cat_id, date, product_title, product_img1, product_img2, product_img3, product_price, product_desc, product_keywords) values ('$product_cat', '$cat', NOW(), '$product_title', '$product_img1', '$product_img2', 'product_img3', '$product_price', '$product_desc', '$product_keywords')";

				$res = mysqli_query($connection, $insert);

				$get_id = $connection->insert_id;

				//echo $get_id;

				$insert_s = "insert into in_stock (product_id, size, quantity) values ('$get_id', 'S', '0')";

				$res_s = mysqli_query($connection, $insert_s);

				/*if($res_s) {
					echo true;
				}*/

				$insert_m = "insert into in_stock (product_id, size, quantity) values ('$get_id', 'M', '0')";

				$res_m = mysqli_query($connection, $insert_m);

				/*if($res_m) {
					echo true;
				}*/

				$insert_l = "insert into in_stock (product_id, size, quantity) values ('$get_id', 'L', '0')";

				$res_l = mysqli_query($connection, $insert_l);

				/*if($res_l) {
					echo true;
				}*/

				//mysqli_error($connection);


			if($res) {
				echo "<script> alert('Product inserted successfully') </script>";
				echo "<script> window.open('index.php?add_product_quantity', '_self') </script>";
			} else {
				echo "<script> alert('Failed to insert') </script>";
				echo "<script> window.open('insert_product.php', '_self') </script>";
			}
		}
	?>

	<script src="js/jquery-331.min.js"></script>
	<script src="js/bootstrap-337.min.js"></script>
</body>
</html>


<?php
	}
 ?>
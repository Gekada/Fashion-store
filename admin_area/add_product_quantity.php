


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
					<i class="fa fa-dashboard"></i> Dashboard / Add Product Quantity
				</li>
			</ol>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class="fa fa-money fa-fw"></i> Add Product Quantity
					</h3>
				</div>
				<div class="panel-body">
					<form method="post" enctype="multipart/form-data" class="form-horizontal">
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Product ID</label>
							<div class="col-md-6">
								<select name="product_id" id="" class="form-control">
									<option disabled selected value="">Select Product</option>

									<?php
										$sql = "select * from products";

										$res = mysqli_query($connection, $sql);

										while($row = mysqli_fetch_array($res)) {
											$product_id = $row['product_id'];
											$product_title = $row['product_title'];

											echo "
												<option value='$product_id'>$product_title</option>
											";
										}
									?>

								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Size</label>
							<div class="col-md-6">
								<select name="size" id="" class="form-control">
									<option disabled selected value="">Select Size</option>
									<option value='L'>L</option>
									<option value='S'>S</option>
									<option value='M'>M</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-md-3 control-label">Product Quantity</label>
							<div class="col-md-6">
								<input type="text" name="product_qty" required class="form-control">
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-md-3 control-label"></label>
							<div class="col-md-6">
								<input type="submit" name="submit" value="Add Product" class="btn btn-primary form-control">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php
		if(isset($_POST['submit'])) {
			$product_id = $_POST['product_id'];
			$product_qty = $_POST['product_qty'];
			$product_size = $_POST['size'];

			$sql = "Select * from in_stock where product_id = '$product_id'";

			$run = mysqli_query($connection, $sql);

			$row = mysqli_num_rows($run);

			if($row == 0) {
				$insert_s = "insert into in_stock (product_id, size, quantity) values ('$product_id', 'S', '0')";

				$res_s = mysqli_query($connection, $insert_s);

				$insert_m = "insert into in_stock (product_id, size, quantity) values ('$product_id', 'M', '0')";

				$res_m = mysqli_query($connection, $insert_m);

				$insert_l = "insert into in_stock (product_id, size, quantity) values ('$product_id', 'L', '0')";

				$res_l = mysqli_query($connection, $insert_l);
			}




			$insert = "update in_stock set quantity = '$product_qty' where product_id = '$product_id' and size = '$product_size'";

			$res = mysqli_query($connection, $insert);

			if($res) {
				echo "<script> alert('Quantity inserted successfully') </script>";
				echo "<script> window.open('index.php?add_product_quantity', '_self') </script>";
			} else {
				echo "<script> alert('Failed to insert') </script>";
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
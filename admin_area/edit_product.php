


<?php
	include("includes/db.php");
	if(!isset($_SESSION['admin_email'])) {
		echo "<script>window.open('login.php', '_self')</script>";
	} else {


?>

<?php
	if(isset($_GET['edit_product'])) {
		$edit_id = $_GET['edit_product'];

		$get_p = "Select * from products where product_id = '$edit_id'";

		$run_edit = mysqli_query($connection, $get_p);

		$row_edit = mysqli_fetch_array($run_edit);

		$p_cat = $row_edit['p_cat_id'];

		$p_title = $row_edit['product_title'];

		$cat = $row_edit['cat_id'];

		$p_img1 = $row_edit['product_img1'];

		$p_img2 = $row_edit['product_img2'];

		$p_img3 = $row_edit['product_img3'];

		$p_price = $row_edit['product_price'];

		$p_keywords = $row_edit['product_keywords'];

		$p_desc = $row_edit['product_desc'];

		$get_p_cat = "select * from product_categories where p_cat_id = '$p_cat'";

		$run_p_cat = mysqli_query($connection, $get_p_cat);

		$row_p_cat = mysqli_fetch_array($run_p_cat);

		$p_cat_title = $row_p_cat['p_cat_title'];

		$get_cat = "select * from categories where cat_id = '$cat'";

		$run_cat = mysqli_query($connection, $get_cat);

		$row_cat = mysqli_fetch_array($run_cat);

		$cat_title = $row_cat['cat_title'];
	}



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
					<i class="fa fa-dashboard"></i> Dashboard / Edit Products
				</li>
			</ol>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class="fa fa-money fa-fw"></i> Edit Product
					</h3>
				</div>
				<div class="panel-body">
					<form method="post" enctype="multipart/form-data" class="form-horizontal">
						<input type="hidden" name="p_id" value="<?php echo $edit_id ?>" class="form-control">
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Product Title</label>
							<div class="col-md-6">
								<input type="text" name="product_title" value="<?php echo $p_title ?>" required class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Product Category</label>
							<div class="col-md-6">
								<select name="product_cat" id="" class="form-control">
									<option value="<?php echo $p_cat ?>"><?php echo $p_cat_title ?></option>

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
									<option  value="<?php echo $cat ?>"><?php echo $cat_title ?></option>

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
								<input type="file" name="product_img1" class="form-control">
								<br>
								<img width="70" height="70" src="product_images/<?php echo $p_img1 ?>" alt="">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Product image 2</label>
							<div class="col-md-6">
								<input type="file" name="product_img2" class="form-control">
								<br>
								<img width="70" height="70" src="product_images/<?php echo $p_img2 ?>" alt="">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Product image 3</label>
							<div class="col-md-6">
								<input type="file" name="product_img3" class="form-control">
								<br>
								<img width="70" height="70" src="product_images/<?php echo $p_img3 ?>" alt="">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Product Price</label>
							<div class="col-md-6">
								<input type="text" value="<?php echo $p_price ?>" name="product_price" required class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Product Keywords</label>
							<div class="col-md-6">
								<input type="text" value="<?php echo $p_keywords ?>" name="product_keywords" required class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Product Desc</label>
							<div class="col-md-6">
								<textarea name="product_desc" id="" cols="19" rows="6" class="form-control"><?php echo $p_desc ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label"></label>
							<div class="col-md-6">
								<input type="submit" name="update" value="Update Product" class="btn btn-primary form-control">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php
		if(isset($_POST['update'])) {
			$p_id = $_POST['p_id'];

			$product_title = $_POST['product_title'];
			$product_cat = $_POST['product_cat'];
			$cat = $_POST['cat'];
			$product_price = $_POST['product_price'];
			$product_keywords = $_POST['product_keywords'];
			$product_desc = $_POST['product_desc'];

			if(!$_FILES['product_img1']['name'] == "") {
				$product_img1 = $_FILES['product_img1']['name'];
				$temp_name1 = $_FILES['product_img1']['tmp_name'];
				move_uploaded_file($temp_name1, "product_images/$product_img1");
			} else {
				$product_img1 = $p_img1;
			}

			if(!$_FILES['product_img2']['name'] == "") {
				$product_img2 = $_FILES['product_img2']['name'];
				$temp_name2 = $_FILES['product_img2']['tmp_name'];
				move_uploaded_file($temp_name2, "product_images/$product_img2");
			} else {
				$product_img2 = $p_img2;
			}

			if(!$_FILES['product_img3']['name'] == "") {
				$product_img3 = $_FILES['product_img3']['name'];
				$temp_name3 = $_FILES['product_img3']['tmp_name'];
				move_uploaded_file($temp_name3, "product_images/$product_img3");
			} else {
				$product_img3 = $p_img3;
			}
			//$product_img2 = $_FILES['product_img2']['name'];
			//$product_img3 = $_FILES['product_img3']['name'];
			//

			$currentDate = date("Y-m-d");



			$update = "update products set p_cat_id = '$product_cat', cat_id = '$cat', date = '$currentDate', product_title = '$product_title', product_img1 = '$product_img1', product_img2 = '$product_img2', product_img3 = '$product_img3', product_keywords = '$product_keywords', product_desc = '$product_desc', product_price = '$product_price' where product_id = '$p_id'";

			error_log($update, 0);

			$res = mysqli_query($connection, $update);

			if($res) {
				echo "<script> alert('Product updated successfully') </script>";
				echo "<script> window.open('index.php?view_products', '_self') </script>";
			} else {
				echo "<script> alert('Failed to update') </script>";
				echo "<script> window.open('edit_product.php', '_self') </script>";
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
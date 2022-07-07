
<?php
	include("includes/db.php");
	if(!isset($_SESSION['admin_email'])) {
		echo "<script>window.open('login.php', '_self')</script>";
	} else {


?>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>

				<i class="fa fa-dashboard"></i> Dashboard / Insert Category

			</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-money fa-fw"></i> Insert
				</h3>
			</div>
			<div class="panel-body">
				<form action="" method="post" class="form-horizontal">
					<div class="form-group">
						<label for="" class="control-label col-md-3">Category Title</label>

						<div class="col-md-6">
							<input name="cat_title" type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-3">Category Desc</label>

						<div class="col-md-6">
							<textarea name="cat_desc" type='text' id="" cols="30" rows="10" class="form-control"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-3"></label>

						<div class="col-md-6">
							<input name="submit" type="submit" value="Insert" class="form-control btn btn-primary">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<?php
	if(isset($_POST['submit'])) {
		$cat_title = $_POST['cat_title'];

		$cat_desc = $_POST['cat_desc'];

		$sql = "Insert into categories (cat_title, cat_desc) values ('$cat_title', '$cat_desc')";

		$res = mysqli_query($connection, $sql);

		if($res) {
			echo "<script>alert('Inserted Succesfully')</script>";

			echo "<script>window.open('index.php?view_cat', '_self')</script>";
		}
	}
 ?>



<?php } ?>

<?php
	include("includes/db.php");
	if(!isset($_SESSION['admin_email'])) {
		echo "<script>window.open('login.php', '_self')</script>";
	} else {

		if(isset($_GET['edit_cat'])) {
			$id = $_GET['edit_cat'];

			$sql = "select * from categories where cat_id = '$id'";

			$res = mysqli_query($connection, $sql);

			$row = mysqli_fetch_array($res);

			$title = $row['cat_title'];

			$desc = $row['cat_desc'];
		}


?>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>

				<i class="fa fa-dashboard"></i> Dashboard / Edit Category

			</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-pencil fa-fw"></i> Edit
				</h3>
			</div>
			<div class="panel-body">
				<form action="" method="post" class="form-horizontal">
					<div class="form-group">
						<label for="" class="control-label col-md-3">Category Title</label>

						<div class="col-md-6">
							<input name="cat_title" value="<?php echo $title ?>" type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-3">Category Desc</label>

						<div class="col-md-6">
							<textarea name="cat_desc" type='text' id="" cols="30" rows="10" class="form-control"><?php echo $desc ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-3"></label>

						<div class="col-md-6">
							<input name="submit" type="submit" value="Update" class="form-control btn btn-primary">
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

		$sql = "Update categories set cat_title = '$cat_title', cat_desc = '$cat_desc' where cat_id = '$id'";

		$res = mysqli_query($connection, $sql);

		if($res) {
			echo "<script>alert('Updated Succesfully')</script>";

			echo "<script>window.open('index.php?view_cat', '_self')</script>";
		}
	}
 ?>



<?php } ?>
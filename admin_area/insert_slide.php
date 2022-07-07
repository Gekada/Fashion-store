
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

				<i class="fa fa-dashboard"></i> Dashboard / Insert Slide

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
				<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
					<div class="form-group">
						<label for="" class="control-label col-md-3">Slide Title</label>

						<div class="col-md-6">
							<input name="slide_name" type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-3">File</label>

						<div class="col-md-6">
							<input name="slide_image" type="file" class="form-control">
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
		$slide_name = $_POST['slide_name'];

		$slide_image = $_FILES['slide_image']['name'];

		$temp_name = $_FILES['slide_image']['tmp_name'];

		$sql = "Select * from slider";

		$res = mysqli_query($connection, $sql);

		$count = mysqli_num_rows($res);

		if($count < 4) {
			move_uploaded_file($temp_name, "slides_images/$slide_image");

			$insert_slide = "Insert into slider (slide_name, slide_image) values ('$slide_name', '$slide_image')";

			$run_slide = mysqli_query($connection, $insert_slide);

			echo "<script>alert('Inserted Succesfully')</script>";

			echo "<script>window.open('index.php?view_slides', '_self')</script>";
		} else {
			echo "<script>alert('You have inserted 4 slides already')</script>";
		}
	}
 ?>



<?php } ?>
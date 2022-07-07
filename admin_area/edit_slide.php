
<?php
	include("includes/db.php");
	if(!isset($_SESSION['admin_email'])) {
		echo "<script>window.open('login.php', '_self')</script>";
	} else {


		if(isset($_GET['edit_slide'])) {
			$id = $_GET['edit_slide'];

			$edit_slide = "Select * from slider where slide_id = '$id'";

			$run_slide = mysqli_query($connection, $edit_slide);

			$row_slide = mysqli_fetch_array($run_slide);

			$slide_image = $row_slide['slide_image'];

			$slide_name = $row_slide['slide_name'];


		}


?>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>

				<i class="fa fa-dashboard"></i> Dashboard / Edit Slide

			</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-money fa-fw"></i> Edit
				</h3>
			</div>
			<div class="panel-body">
				<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
					<div class="form-group">
						<label for="" class="control-label col-md-3">Slide Title</label>

						<div class="col-md-6">
							<input name="slide_name" value="<?php echo $slide_name ?>" type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-3">File</label>

						<div class="col-md-6">
							<input name="slide_image" type="file" class="form-control">
							<br>
							<img src="slides_images/<?php echo $slide_image ?>" class="img-responsive" width='250' alt="">
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
		$slide_name = $_POST['slide_name'];

		$slide_image = $_FILES['slide_image']['name'];

		$temp_name = $_FILES['slide_image']['tmp_name'];

		move_uploaded_file($temp_name, "slides_images/$slide_image");

		if($slide_image == "") {
			$slide_image = $row_slide['slide_image'];
		}

		$sql = "update slider set slide_name = '$slide_name', slide_image = '$slide_image' where slide_id = '$id'";

		$res = mysqli_query($connection, $sql);

		if($res) {
			echo "<script>alert('Updated successfully')</script>";

			echo "<script>window.open('index.php?view_slides', '_self')</script>";
		}


	}
 ?>



<?php } ?>

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

				<i class="fa fa-dashboard"></i> Dashboard / View Slides

			</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-tags fa-fw"></i> View Slides
				</h3>
			</div>
			<div class="panel-body">
				<?php
					$get_slides = "Select * from slider";

					$run_slides = mysqli_query($connection, $get_slides);

					while($row = mysqli_fetch_array($run_slides)) {
						$slide_id = $row['slide_id'];

						$slide_name = $row['slide_name'];

						$slide_image = $row['slide_image'];

				 ?>
				 <div class="col-lg-3 col-md-3">
				 	<div class="panel panel-primary">
				 		<div class="panel-heading">
				 			<h3 align="center" class="panel-title">
				 				<?php echo $slide_name ?>
				 			</h3>
				 		</div>
				 		<div class="panel-body">
				 			<img class="img-responsive" src="slides_images/<?php echo $slide_image ?>" alt="">
				 		</div>
				 		<div class="panel-footer">
				 			<center>
				 				<a href="index.php?delete_slide=<?php echo $slide_id ?>" class="pull-right"><i class="fa fa-trash"></i>Delete </a>
				 				<a href="index.php?edit_slide=<?php echo $slide_id ?>" class="pull-left"><i class="fa fa-pencil"></i>Edit </a>
				 				<div class="clearfix"></div>
				 			</center>
				 		</div>
				 	</div>
				 </div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>


<?php } ?>
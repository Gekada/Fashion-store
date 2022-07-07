	<?php
	$active = 'Home';
		include("includes/header.php");
		include('includes/bot.php');
	?>

	<div class="container" id="slider">
		<div class="col-md-12">
			<div class="carousel slide" data-ride="carousel" id="myCarousel">
				<ol class="carousel-indicators">
					<li class="active" data-target="#myCarousel" data-slide-to="0"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
					<li data-target="#myCarousel" data-slide-to="3"></li>
				</ol>
				<div class="carousel-inner">

					<?php

						$sql = "Select * from slider limit 0,1";

						$res = mysqli_query($connection, $sql);

						while ($row = mysqli_fetch_assoc($res)) {
							$slide_name = $row['slide_name'];
							$image_name = $row['slide_image'];
							echo "
								<div class='item active'>
									<img src='admin_area/slides_images/$image_name'>
								</div>
							";

						}

						$sql1 = "Select * from slider limit 1,3";

						$res1 = mysqli_query($connection, $sql1);

						while ($row1 = mysqli_fetch_assoc($res1)) {
							$slide_name1 = $row1['slide_name'];
							$image_name1 = $row1['slide_image'];
							echo "
								<div class='item'>
									<img src='admin_area/slides_images/$image_name1'>
								</div>
							";

						}

					?>


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

	<div id="advantages">
		<div class="container">
			<div class="same-height-row">
				<div class="col-sm-4">
					<div class="box same-height">
						<div class="icon">
							<i class="fa fa-heart"></i>
						</div>
						<h3><a href="#">We love customers</a></h3>

						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="box same-height">
						<div class="icon">
							<i class="fa fa-tag"></i>
						</div>
						<h3><a href="#">Best prices</a></h3>

						<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="box same-height">
						<div class="icon">
							<i class="fa fa-thumbs-up"></i>
						</div>
						<h3><a href="#">100% Original</a></h3>

						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="hot">
		<div class="box">
			<div class="container">
				<div class="col-md-12">
					<h2>
						Our latest Products
					</h2>
				</div>
			</div>
		</div>
	</div>

	<div id="content" class="container">
		<div class="row">

			<?php
				getPro();
			?>

		</div>
	</div>

	<?php
		include('includes/footer.php');
	?>

	<script src="js/jquery-331.min.js"></script>
	<script src="js/bootstrap-337.min.js"></script>

</body>
</html>
	<?php
	$active = 'Contact';
		include("includes/header.php");
	?>

	<div id="content">
		<div class="container">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li>Contact Us</li>
				</ul>
			</div>

			<div class="col-md-3">


				<?php
					include('includes/sidebar.php');
				?>
			</div>
				<div class="col-md-9">
					<div class="box">
						<div class="box-header">
							<center>
								<h2>Feel Free To Contact Us</h2>
								<p class="text-muted">We work 24/7</p>
							</center>
							<form action="contact.php" method="post">
								<div class="form-group">
									<label>Name</label>
									<input type="text" name="name" class="form-control" required>
								</div>
                                <div class="form-group">
									<label>Email</label>
									<input type="text" name="email" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Subject</label>
									<input type="text" name="subject" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Message</label>
									<textarea name="message" class="form-control"></textarea>
								</div>
								<div class="text-center">
									<button type="submit" name="submit" class="btn btn-primary">
									<i class="fa fa-user-md"></i> Send message
									</button>
								</div>
							</form>

							<?php

								if(isset($_POST['submit'])) {

									$sender_name = $_POST['name'];

									$sender_email = $_POST['email'];

									$sender_subject = $_POST['subject'];

									$sender_message = $_POST['message'];

									$receiver_email = "danylo.osypov@nure.ua";

									mail($receiver_email, $sender_subject, $sender_message, $sender_email);

									echo "<h3 class='text-center'>Your message was sent successfully</h3>";

								}

							?>

						</div>
					</div>
				</div>

		</div>

	</div>

	<div style="margin-top: 20px; background-color: #eaeaea; box-shadow: 10px 2px 3px 4px rgba(12,12,12,0.2); ">
		<h3 style="padding-top: 30px; margin-bottom: 30px;" align="center">Find Us On the Map</h1>
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d102695.5223523638!2d36.18840403371474!3d50.003565724265705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4127a1000e0da5b9%3A0x7bc3ddab9336dd55!2z0KbQtdC90YLRgNCw0LvRjNC90YvQuSDQv9Cw0YDQuiDQutGD0LvRjNGC0YPRgNGLINC4INC-0YLQtNGL0YXQsCDQuNC80LXQvdC4INCcLiDQk9C-0YDRjNC60L7Qs9C-!5e0!3m2!1sru!2sua!4v1656244280367!5m2!1sru!2sua" width="100%" height="300px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	</div>

	<?php
		include('includes/footer.php');
	?>

	<script src="js/jquery-331.min.js"></script>
	<script src="js/bootstrap-337.min.js"></script>

</body>
</html>
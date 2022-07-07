


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
					<i class="fa fa-dashboard"></i> Dashboard / Add Notification
				</li>
			</ol>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class="fa fa-money fa-fw"></i> Add Notification
					</h3>
				</div>
				<div class="panel-body">
					<form method="post" enctype="multipart/form-data" class="form-horizontal">
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Mail Title</label>
							<div class="col-md-6">
								<input type="text" name="mail_title" required class="form-control">
							</div>
						</div>


						<div class="form-group">
							<label for="" class="col-md-3 control-label">Mail Desc</label>
							<div class="col-md-6">
								<textarea name="mail_desc" id="" cols="19" rows="6" class="form-control"></textarea>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-md-3 control-label"></label>
							<div class="col-md-6">
								<input type="submit" name="submit" value="Add Notification" class="btn btn-primary form-control">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php


		if(isset($_POST['submit'])) {

			$sql = "select * from customers";

			$res = mysqli_query($connection, $sql);

			while($row = mysqli_fetch_array($res)) {
				$to = $row['customer_email'];
				$subject = $_POST['mail_title'];
				$message = $_POST['mail_desc'];

				mail($to, $subject, $message);
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
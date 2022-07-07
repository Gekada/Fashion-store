
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

				<i class="fa fa-dashboard"></i> Dashboard / Insert Admin

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
						<label for="" class="control-label col-md-3">Name</label>

						<div class="col-md-6">
							<input name="name" type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-3">Email</label>

						<div class="col-md-6">
							<input name="email" type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-3">Password</label>

						<div class="col-md-6">
							<input name="pass" type="text" class="form-control">
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
		$email_validation_regex = '/^\\S+@\\S+\\.\\S+$/';
		if(preg_match($email_validation_regex, $_POST['email'])) {
			$name = $_POST['name'];

			$email = $_POST['email'];

			$pass = $_POST['pass'];

			$sql = "Insert into admins (admin_name, admin_email, admin_pass) values ('$name', '$email', '$pass')";

			$res = mysqli_query($connection, $sql);

			if($res) {
				echo "<script>alert('Inserted Succesfully')</script>";

				echo "<script>window.open('index.php?view_admins', '_self')</script>";
			}
		} else {
			echo "<script>alert('Wrong Email')</script>";
		}
	}
 ?>



<?php } ?>
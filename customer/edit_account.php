
	<?php
		$customer_session = $_SESSION['customer_email'];

		$get_customer = "Select * from customers where customer_email = '$customer_session'";

		$run_customer = mysqli_query($connection, $get_customer);

		$row_customer = mysqli_fetch_array($run_customer);

		$customer_id = $row_customer['customer_id'];

		$customer_name = $row_customer['customer_name'];

		$customer_email = $row_customer['customer_email'];

		$customer_country = $row_customer['customer_country'];

		$customer_city = $row_customer['customer_city'];

		$customer_contact = $row_customer['customer_contact'];

		$customer_address = $row_customer['customer_address'];

		$customer_image = $row_customer['customer_image'];

	?>

<h1 align="center">Edit your Profile</h1>

<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="">Name: </label>
		<input type="text" name="c_name" value="<?php echo $customer_name ?>" class="form-control" required>
	</div>
	<div class="form-group">
		<label for="">Email: </label>
		<input type="text" name="c_email" value="<?php echo $customer_email ?>" class="form-control" required>
	</div>
	<div class="form-group">
		<label for="">Country: </label>
		<input type="text" name="c_country" value="<?php echo $customer_country ?>" class="form-control" required>
	</div>
	<div class="form-group">
		<label for="">City: </label>
		<input type="text" name="c_city" value="<?php echo $customer_city ?>" class="form-control" required>
	</div>
	<div class="form-group">
		<label for="">Contact: </label>
		<input type="text" name="c_contact" value="<?php echo $customer_contact ?>" class="form-control" required>
	</div>
	<div class="form-group">
		<label for="">Address: </label>
		<input type="text" name="c_address" value="<?php echo $customer_address ?>" class="form-control" required>
	</div>
	<div class="form-group">
		<label for="">Image: </label>
		<input type="file" name="c_image" class="form-control">
		<img width="200px" src="customer_images/<?php echo $customer_image ?>" alt="" class="img-responsive">
	</div>
	<div class="text-center">
		<button name="update" class="btn btn-primary">
			<i class="fa fa-user-md"></i> Update
		</button>
	</div>
</form>

<?php

	if(isset($_POST['update'])) {

		$update_id = $customer_id;

		$c_name = $_POST['c_name'];

		$c_email = $_POST['c_email'];

		$c_country = $_POST['c_country'];

		$c_city = $_POST['c_city'];

		$c_address = $_POST['c_address'];

		$c_contact = $_POST['c_contact'];

      	$c_image = $_FILES['c_image']['name'];

      	if($c_image == "") {
      		$c_image = $customer_image;
      	}

		$c_image_tmp = $_FILES['c_image']['tmp_name'];

		move_uploaded_file($c_image_tmp, "customer_images/$c_image");

		$update_customer = "Update customers set customer_name = '$c_name', customer_email = '$c_email', customer_country = '$c_country', customer_city = '$c_city', customer_address = '$c_address', customer_contact = '$c_contact', customer_image = '$c_image' where customer_id = '$update_id'";


		/*
		echo $customer_image . " customer_image ";

		echo $c_image . " c_image";




		$update_customer = "Update customers set customer_name = '$c_name', customer_email = '$c_email', customer_country = '$c_country', customer_city = '$c_city', customer_address = '$c_address', customer_contact = '$c_contact', customer_image = '$c_image' where customer_id = '$update_id'";*/

		$run_customer_update = mysqli_query($connection, $update_customer);

		if($run_customer_update) {
			echo "<script>alert('Editing procceeded. Pls relogin')</script>";

			echo "<script>window.open('logout.php', '_self')</script>";
		}
	}

?>
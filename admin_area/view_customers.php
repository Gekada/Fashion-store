
<?php
	include("includes/db.php");
	if(!isset($_SESSION['admin_email'])) {
		echo "<script>window.open('login.php', '_self')</script>";
	} else {


?>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="active">
				<i class="fa fa-dashboard"></i> Dashboard / View Customers
			</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-tags"></i> View Customers
				</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Image</th>
								<th>E-mail</th>
								<th>Country</th>
								<th>City</th>
								<th>Address</th>
								<th>Contact</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$get_pro = "Select * from customers";

								$run_pro = mysqli_query($connection, $get_pro);

								while($row_pro = mysqli_fetch_array($run_pro)) {
									$c_id = $row_pro['customer_id'];

									$customer_name = $row_pro['customer_name'];

									$c_img = $row_pro['customer_image'];

									$c_email = $row_pro['customer_email'];

									$c_country = $row_pro['customer_country'];

									$c_city = $row_pro['customer_city'];

									$c_address = $row_pro['customer_address'];

									$c_contact = $row_pro['customer_contact'];

							?>

							<tr>
								<th><?php echo $c_id ?></th>
								<th><?php echo $customer_name ?></th>
								<th><img src="../customer/customer_images/<?php echo $c_img ?>" width="60" height="60" alt=""></th>
								<th>$ <?php echo $c_email ?></th>
								<th><?php echo $c_country ?></th>
								<th><?php echo $c_city ?></th>
								<th><?php echo $c_address ?></th>
								<th><?php echo $c_contact ?></th>
								<th><a href="index.php?delete_customer=<?php echo $c_id ?>"><i class="fa fa-trash"></i> Delete </a></th>
							</tr>

							<?php
								}
							?>


						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>



<?php
	}
?>

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
								<th>E-mail</th>
								<th>Password</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$get_pro = "Select * from admins";

								$run_pro = mysqli_query($connection, $get_pro);

								while($row_pro = mysqli_fetch_array($run_pro)) {
									$admin_id = $row_pro['admin_id'];

									$admin_name = $row_pro['admin_name'];

									$admin_pass = $row_pro['admin_pass'];

									$admin_email = $row_pro['admin_email'];

							?>

							<tr>
								<th><?php echo $admin_id ?></th>
								<th><?php echo $admin_name ?></th>
								<th><?php echo $admin_email ?></th>
								<th><?php echo $admin_pass ?></th>
								<th><a href="index.php?delete_admin=<?php echo $admin_id ?>"><i class="fa fa-trash"></i> Delete </a></th>
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
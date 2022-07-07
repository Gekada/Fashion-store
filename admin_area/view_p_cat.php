
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

				<i class="fa fa-dashboard"></i> Dashboard / View Product Categories

			</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-tags fa-fw"></i> View Product Categories
				</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover table-striped table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Title</th>
								<th>Desc</th>
								<th>Delete</th>
								<th>Edit</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "Select * from product_categories";

								$res = mysqli_query($connection, $sql);

								while($row = mysqli_fetch_array($res)) {
									$p_cat_id = $row['p_cat_id'];

									$p_cat_title = $row['p_cat_title'];

									$p_cat_desc = $row['p_cat_desc'];

							?>
							<tr>
								<td><?php echo $p_cat_id ?></td>
								<td><?php echo $p_cat_title ?></td>
								<td><?php echo $p_cat_desc ?></td>
								<td><a href="index.php?edit_p_cat=<?php echo $p_cat_id ?>"><i class="fa fa-pencil"></i> Edit </a></td>
								<td><a href="index.php?delete_p_cat=<?php echo $p_cat_id ?>"><i class="fa fa-trash"></i> Delete </a></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<?php } ?>
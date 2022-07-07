<div id="footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-4">
				<h4>Pages</h4>
				<ul>
					<li><a href="../cart.php">Shopping Cart</a></li>
					<li><a href="../shop.php">Shop</a></li>
					<li><a href="../contact.php">Contact us</a></li>
					<li><a href="my_account.php">My account </a></li>
				</ul>
				<hr>
				<h4>
					User Section
				</h4>

				<ul>
					<?php
						if(!isset($_SESSION['customer_email'])) {
							echo "<a href='../checkout.php'>Login</a>";
						} else {
							echo "<a href='my_account.php?my_orders'>My account</a>";
						}
					?>

					<li>
						<?php
						if(!isset($_SESSION['customer_email'])) {
							echo "<a href='../checkout.php'>Login</a>";
						} else {
							echo "<a href='my_account.php?edit_account'>Edit account</a>";
						}
					?>
					</li>
				</ul>

					<hr class="hidden-md hidden-lg hidden-sm">

			</div>
			<div class="col-sm-6 col-md-3">
				<h4>Top Products Categories</h4>
				<ul>
					<?php
						$sql = "Select * from product_categories";

						$res = mysqli_query($connection, $sql);

						while($row = mysqli_fetch_array($res)) {
							$p_cat_id = $row['p_cat_id'];
							$p_cat_title = $row['p_cat_title'];

							echo "
								<li><a href='../shop.php?p_cat=$p_cat_id'>$p_cat_title</a></li>

							";
						}
					?>

				</ul>

				<hr class="hidden-md hidden-lg hidden-sm">

			</div>

			<div class="col-sm-6 col-md-3">
				<h4>Find Us</h4>

				<p>
					<strong>Real Gangsta shit inc.</strong>
				</p>

				<a href="../contact.php">Check our contact page</a>

				<hr class="hidden-md hidden-lg hidden-sm">
			</div>

			<div class="col-sm-6 col-md-3">
				<h4>Get The News</h4>

				<form action="" method="post">
					<div class="input-group">
						<input type="text" name="email" class="form-control">
						<span class="input-group-btn">
							<input type="submit" value="Subscribe" class="btn btn-default">
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


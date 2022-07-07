
<?php
	include("includes/db.php");
	if(!isset($_SESSION['admin_email'])) {
		echo "<script>window.open('login.php', '_self')</script>";
	} else {


?>

<?php
	if(isset($_GET['delete_p_cat'])) {
		$id = $_GET['delete_p_cat'];
		$sql = "Delete from product_categories where p_cat_id = '$id'";

		$res = mysqli_query($connection, $sql);

		if($res) {
			echo "<script>alert('Deleted successfully')</script>";

			echo "<script>window.open('index.php?view_p_cat', '_self')</script>";
		}
	}
 ?>



<?php } ?>

<?php
	include("includes/db.php");
	if(!isset($_SESSION['admin_email'])) {
		echo "<script>window.open('login.php', '_self')</script>";
	} else {


?>

<?php
	if(isset($_GET['delete_admin'])) {
		$id = $_GET['delete_admin'];
		$sql = "Delete from admins where admin_id = '$id'";

		$res = mysqli_query($connection, $sql);

		if($res) {
			echo "<script>alert('Deleted successfully')</script>";

			echo "<script>window.open('index.php?view_admins', '_self')</script>";
		}
	}
 ?>



<?php } ?>
<?php

include("includes/db.php");


$price = $_POST['price'];
$parts = explode('-', $price);
$price_from = $parts[0];
$price_to = $parts[1];

$size = $_POST['size'];
$product_cat = $_POST['product_cat'];
$cat = $_POST['cat'];
$sort = $_POST['sort'];

$myarray = array();
$sql = "Select * from products ";
if (isset($price_from) && $price_from != '' && isset($price_to) && $price_to != '')
	array_push($myarray, " product_price between '$price_from' and '$price_to'");

if (isset($product_cat) && $product_cat != '')
	array_push($myarray, " p_cat_id = '$product_cat'");

if (isset($cat) && $cat != '')
	array_push($myarray, " cat_id = '$cat'");

$first = true;
foreach ($myarray as $val){
	if ($first) {
		$sql = $sql . " where " . $val;
		$first = false;
	}
	else
		$sql = $sql . " and " . $val;
}


if(!$myarray) {
	$sql = $sql . " where product_id in
        (Select product_id from in_stock where quantity > 0 and size like '%$size%')";
} else {
	$sql = $sql . " and product_id in
        (Select product_id from in_stock where quantity > 0 and size like '%$size%')";
}

//echo $sort . " sort";


if ($_POST['sort'] == "Lower Price") {
	$sql = $sql . " order by product_price asc";
} else if ($_POST['sort'] == "Higher price") {
	$sql = $sql . " order by product_price desc";
} else if ($_POST['sort'] == "New Products") {
	$sql = $sql . " order by 1 desc";
}






$res = mysqli_query($connection, $sql);
//echo $sql;
while($row = mysqli_fetch_array($res)) {
	$pro_id = $row['product_id'];
	$pro_title = $row['product_title'];
	$pro_price = $row['product_price'];
	$pro_img1 = $row['product_img1'];

	echo "
		<div class='col-md-4 col-sm-6 center-responsive'>
			<div class='product'>
				<a style='display:flex; justify-content:center' href='details.php?pro_id=$pro_id'>
					<img style='height:258px;' class='img-responsive' src='admin_area/product_images/$pro_img1'>
				</a>
				<div class='text'>
					<h3>
						<a href='details.php?pro_id=$pro_id'>
							$pro_title
						</a>
					</h3>
					<p class='price'>
						$ $pro_price
					</p>
					<p class='button'>
						<a href='details.php?pro_id=$pro_id' class='btn btn-default'>
							View details
						</a>
						<a href='details.php?pro_id=$pro_id' class='btn btn-primary'>
							<i class='fa fa-shopping-cart'>
								Add to Cart
							</i>
						</a>
					</p>
				</div>
			</div>
		</div>
	";
}
?>
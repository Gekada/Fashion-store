<?php
include("./db.php");

$msg =  $_POST['text'];
$sql = "SELECT replies FROM chatbot WHERE queries LIKE '%" . $msg . "%'";
$result = mysqli_query($connection, $sql);
$count=mysqli_num_rows($result);


if($count > 0){
    while($row = mysqli_fetch_assoc($result)) {
        echo $row['replies'];
    }

} else {
    echo "Nothing was found";
}

?>
<?php
include "../settings/connection.php";

$sql = "SELECT CategoryID, cname FROM category";

$result = mysqli_query($con, $sql);

$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
echo json_encode($categories);
mysqli_close($con);
?>

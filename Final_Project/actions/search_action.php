<?php
include "../settings/connection.php";

$category = isset($_GET['category']) ? mysqli_real_escape_string($con, $_GET['category']) : '';
$name = isset($_GET['name']) ? mysqli_real_escape_string($con, $_GET['name']) : '';
$region = isset($_GET['region']) ? mysqli_real_escape_string($con, $_GET['region']) : '';

$sql = "SELECT schools.*, category.cname FROM schools JOIN category ON schools.CategoryID = category.CategoryID WHERE 1=1";

if (!empty($category)) {
  $sql .= " AND category.cname LIKE '%$category%'";
}
if (!empty($name)) {
  $sql .= " AND schools.school_name LIKE '%$name%'";
}
if (!empty($region)) {
  $sql .= " AND schools.region LIKE '%$region%'";
}

$result = mysqli_query($con, $sql);
// Continue as before...

<?php
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ALL);
include "../settings/connection.php";

var_dump($_POST["first"]);
exit;
if (isset($_POST["submit"])) {
  $first_name = $_POST["first"];
  $last_name = $_POST["last"];
  $gender = $_POST["gender"];
  $dob = $_POST["dob"];
  $contact = $_POST["mobile"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $repassword = $_POST["repassword"];


  $hash = password_hash($repassword, PASSWORD_DEFAULT);

  $connectdb = "INSERT into Student  (RoleID ,fname,lname,gender,dob,contact,email,password) 
    values(3,'$first_name', '$last_name','$gender','$dob','$contact','$email','$hash');";

  if ($con->query($connectdb) === TRUE) {
    include "../Login/login.php";
  } else {
    echo "Error: " . $connectdb . "<br>" . $con->error;
  }
}

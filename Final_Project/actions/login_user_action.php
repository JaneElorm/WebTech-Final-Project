<?php
include "../settings/core.php";
include "../settings/connection.php";



if (isset($_POST['Login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = "SELECT * FROM student WHERE email = '$email'";

  if ($result = mysqli_query($con, $query)) {
    $results = mysqli_fetch_assoc($result);

    if (password_verify($password, $results["password"])) {
      $_SESSION["user_id"] = $results["StudentID"];
      $_SESSION["user_role"] = $results["RoleID"];

      switch ($_SESSION["user_role"]) {
        case 1: 
          header("Location: ../admin_view/homepage_admin.php");
          exit();
        case 2: 
          header("Location: ../admin_view/homepage_admin.php"); 
          exit();
        case 3: 
          header("Location: ../user_view/homepage.php");
          exit();
        default:
          echo "Invalid user role. Please contact the administrator.";
      }
    } else {
      header("Location: ../login/login.php?error=Invalid credentials");
      exit();
    }
  } else {
    die("Error: " . mysqli_error($con));
  }
}

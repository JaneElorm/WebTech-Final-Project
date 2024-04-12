
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard</title>
  <link rel="stylesheet" href="../css/homepage.css">
  <link rel="stylesheet" href="../css/homepage_modal.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>

<body>
<header>
    <div class="container">
      <div class="logo">
        <!-- <img src="../images/webtech_logo-removebg-preview.png" alt="School Logo" width="10"> -->
      </div>
      <div class="search-bar">
        <form action="#">
          <input type="text" placeholder="Find Something..">
          <div class="search">
            <button type="submit">SEARCH</button>
          </div>
        </form>
      </div>
      <div class="user-info">
        <ul>
          <li><a href="profile.php"><span class="material-symbols-outlined">person</span>Profile</a></li>
          <li><a href="../Login/login.php"><span class="material-symbols-outlined">Logout</span>Logout</a></li>
        </ul>
      </div>
    </div>
  </header>


  <main>
    <div class="container">
      <nav class="sidebar">
        <ul>
          <li class="active">
            <a href="homepage.php"><span class="material-symbols-outlined">home</span>Dashboard</a>
            <ul>
              <li><a href="applications.php"><span class="material-symbols-outlined">school</span>Applications</a></li>
              
            </ul>
          </li>
        </ul>
      </nav>
      <div class="content">
        <h2>Schools</h2>
        <div class="search-section">
          <div class="search-box">
            <input type="text" placeholder="Search by Category...">
          </div>
          <div class="search-box">
            <input type="text" placeholder="Search by Name....">
          </div>
          <div class="search-box">
            <input type="text" placeholder="Search by Region...">
          </div>
          <div class="search-btn">
            <button type="submit">SEARCH</button>
          </div>
        </div>

        <div class="student-data">
          <table>
            <thead>
              <tr>
                <th>School Name</th>
                <th>School Code</th>
                <th>Category</th>
                <th>Course</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
            <?php
              include "../settings/connection.php";
              include "../settings/core.php";

              $userID = get_user_id();

              if ($userID !== FALSE) {
                $sql = "SELECT applications.school_name, applications.school_code, category.cname, courses.course_name, status.sname
                        FROM applications
                        INNER JOIN schools ON applications.school_code = schools.school_code
                        INNER JOIN category ON schools.CategoryID = category.CategoryID
                        INNER JOIN courses ON applications.CourseID = courses.CourseID
                        INNER JOIN status ON applications.StatusID = status.StatusID
                        WHERE StudentID = ?";
                      

                if ($stmt = mysqli_prepare($con, $sql)) {
                  mysqli_stmt_bind_param($stmt, "i", $userID);
                  mysqli_stmt_execute($stmt);
                  mysqli_stmt_bind_result($stmt, $retrievedSchoolName, $retrievedSchoolCode, $retrievedCategoryName, $retrievedCourseName, $retrievedStatusName);

                  while (mysqli_stmt_fetch($stmt)) {
                    echo "<tr>";
                    echo "<td>" . $retrievedSchoolName . "</td>";
                    echo "<td>" . $retrievedSchoolCode . "</td>";
                    echo "<td>" . $retrievedCategoryName . "</td>";
                    echo "<td>" . $retrievedCourseName . "</td>";
                    echo "<td>" . $retrievedStatusName . "</td>";
                    echo "</tr>";
                  }

                  
                } else {
                  echo "Error preparing query: " . mysqli_error($con) . "<br>";
                }
              }
              ?>

            </tbody>
          </table>
          
        </div>
      </div>
    </div>
  </main>

</body>

</html>

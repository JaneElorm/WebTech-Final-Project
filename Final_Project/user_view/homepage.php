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
      <form action="../actions/search_action.php" method="GET">
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
            <a href="#"><span class="material-symbols-outlined">home</span>Dashboard</a>
            <ul>
              <li><a href="applications.php"><span class="material-symbols-outlined">school</span>Applications</a></li>
              
            </ul>
          </li>
        </ul>
      </nav>
      <div class="content">
        <h2>Schools</h2>
        <form action="../actions/search_action.php" method="GET">
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
        </form>
        </div>

        <div class="student-data">
          <table>
            <thead>
              <tr>
                <th>Category</th>
                <th>Region</th>
                <th>District</th>
                <th>School Code</th>
                <th>School name</th>
                <th>Location </th>
                <th>Gender</th>
                <th>Day/Boarding</th>
                <th>Apply</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include "../settings/connection.php";
              $sql = "SELECT schools.*, category.cname FROM schools  JOIN category ON schools.CategoryID = category.CategoryID";

              $result = mysqli_query($con, $sql);
            
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td>" . $row["cname"] . "</td>";
                  echo "<td>" . $row["region"] . "</td>";
                  echo "<td>" . $row["district"] . "</td>";
                  echo "<td>" . $row["school_code"] . "</td>";
                  echo "<td>" . $row["school_name"] . "</td>";
                  echo "<td>" . $row["location"] . "</td>";
                  echo "<td>" . $row["gender"] . "</td>";
                  echo "<td>" . $row["day_boarding"] . "</td>";
                  echo "<td><a href='#' class='apply-btn' onclick='openCourseModal(\"" . $row['school_code'] . "\", \"" . htmlspecialchars(addslashes($row["school_name"]), ENT_QUOTES) . "\", \"" . $row['CategoryID'] . "\")'><span class=\"material-symbols-outlined\">last_page</span></a></td>";
                
                


                  echo "</tr>";
                }
              }

              
              mysqli_close($con);
              ?>
            </tbody>
          </table>

          
        </div>
      </div>
    </div>
  </main>

 
<!-- Course Selection Modal -->
<!-- Course Selection Modal -->
<div id="courseModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Select a Course</h2>
    <form id="courseApplicationForm" method="POST" action="../actions/submit_application.php">
    <div id="coursesList" class="courses-list">
    <div class="column">
        <?php
        include "../settings/connection.php";

        $sql = "SELECT * FROM Courses";

        $result = mysqli_query($con, $sql);

        $num_rows = mysqli_num_rows($result);
        $half_rows = ceil($num_rows / 2);
        $count = 0;

        if ($num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<label>';
                echo '<input type="radio" name="course" value="' . $row["course_name"] . '">' . $row["course_name"];
                echo '</label>';
                $count++;

                if ($count == $half_rows) {
                    echo '</div><div class="column">';
                }
            }
        } else {
            echo "No courses found.";
        }

        mysqli_close($con);
        ?>
    </div>
    <input type="hidden" id="hiddenSchoolCode" name="school_code">
    <input type="hidden" id="hiddenSchoolName" name="school_name">
    <input type="hidden" id="hiddenSchoolCategory" name="category_id">

    <button type="submit" id="confirmCourseSelection">Submit Application</button>
</form>

  </div>
</div>


<script src="../js/courses.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get('submission') === 'success') {
    swal("Good job!", "Application submitted successfully!", "success");
  } else if (urlParams.get('submission') === 'failed') {
    swal("Maximum Limit Reached", "You have already submitted 5 applications.", "warning");
  }
</script>


</body>

</html>

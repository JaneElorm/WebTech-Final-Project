

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Application List</title>
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
          <li><a href="profile_admin.php"><span class="material-symbols-outlined">person</span>Profile</a></li>
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
            <a href="../admin_view/homepage_admin.php"><span class="material-symbols-outlined">home</span>Dashboard</a>
            <ul>
              <li><a href="../admin_view/applications_admin.php"><span class="material-symbols-outlined">school</span>Applications</a></li>
              
            </ul>
          </li>
        </ul>
      </nav>
      <div class="content">
        <h2>Applications</h2>
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
          
            <?php
              include "../settings/connection.php";
              include "../settings/core.php";

              $studentQuery = "SELECT DISTINCT StudentID FROM applications";
                $studentResult = mysqli_query($con, $studentQuery);

                if (!$studentResult) {
                    echo "Error fetching students: " . mysqli_error($con);
                    exit;
                }

                while ($studentRow = mysqli_fetch_assoc($studentResult)) {
                    $studentID = $studentRow['StudentID'];
    
    // For each student, fetch their applications
    $applicationsQuery = "SELECT applications.applicationID, applications.school_name, applications.school_code, category.cname, courses.course_name, status.sname
                      FROM applications
                      INNER JOIN schools ON applications.school_code = schools.school_code
                      INNER JOIN category ON schools.CategoryID = category.CategoryID
                      INNER JOIN courses ON applications.CourseID = courses.CourseID
                      INNER JOIN status ON applications.StatusID = status.StatusID
                      WHERE StudentID = ?";

    
                            if ($stmt = mysqli_prepare($con, $applicationsQuery)) {
                                mysqli_stmt_bind_param($stmt, "i", $studentID);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt,$applicationID, $schoolName, $schoolCode, $categoryName, $courseName, $statusName);
                                
                                // Optional: Fetch student name or any other details you want to display
                                // Display a header for the student's applications
                                echo "<h2>Applications for Student ID: $applicationID</h2>";
                                
                                // Start a table for this student's applications
                                echo "<table border='1'>";
                                echo "<tr>
                                        <th>School Name</th>
                                        <th>School Code</th>
                                        <th>Category</th>
                                        <th>Course</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                    </tr>";
                                
                                // Fetch and display all applications for the current student
                                while (mysqli_stmt_fetch($stmt)) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($schoolName) . "</td>";
                                    echo "<td>" . htmlspecialchars($schoolCode) . "</td>";
                                    echo "<td>" . htmlspecialchars($categoryName) . "</td>";
                                    echo "<td>" . htmlspecialchars($courseName) . "</td>";
                                    echo "<td>" . htmlspecialchars($statusName) . "</td>";
                                    echo '<td><a href="#" onclick="showModal(\''.$applicationID.'\')" class="edit-btn" ><span class="material-symbols-outlined">edit</span></a></td>';


                                    echo "</tr>";
                                }
                                
                                echo "</table><br>";  // End of the table for this student's applications
                            } else {
                                echo "Error preparing applications query for student $applicationID: " . mysqli_error($con) . "<br>";
                            }
                        }

                        ?>

            </tbody>
          </table>
          
        </div>
      </div>
    </div>
  </main>
  <div id="editModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
  <span class="close">&times;</span>
  <form action="../actions/edit_status.php" method="POST">
    <h2>Edit application status</h2>
    <input type="hidden" name="applicationID" id="applicationID">

    <select name="statusID" id="statusID">
  <?php
  $status_sql = "SELECT * FROM status";
  $status_result = mysqli_query($con, $status_sql);
  while ($status_row = mysqli_fetch_assoc($status_result)) {
      echo "<option value='".$status_row['StatusID']."'>".$status_row['sname']."</option>";
  }
  ?>
</select>

    <button type="submit" id=confirmCourseSelection>Update</button>
  </form>
</div>
</div>

<script src="../js/status.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Then, in a separate script tag, include your custom JavaScript -->
<script>
  // Check URL for specific query parameters
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get('submission') === 'success') {
    swal("Good job!", "Status Edited!", "success");
  }
</script>
</body>

</html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../css/homepage.css">
  <link rel="stylesheet" href="../css/homepage_modal.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <style>
    /* Modal background */


  </style>
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
            <a href="#"><span class="material-symbols-outlined">home</span>Dashboard</a>
            <ul>
              <li><a href="../admin_view/applications_admin.php"><span class="material-symbols-outlined">school</span>Applications</a></li>
              
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
                <th>Category</th>
                <th>Region</th>
                <th>District</th>
                <th>School Code</th>
                <th>School name</th>
                <th>Location </th>
                <th>Gender</th>
                <th>Day/Boarding</th>
                <th>Edit</th>
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
                  echo '<td><a href="#"onclick="showModal(\''.$row["school_code"].'\')" class="edit-btn" ><span class="material-symbols-outlined">edit</span></a></td>';

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
  <!-- The Modal -->
<div id="editModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
  <span class="close">&times;</span>
  <form action="../actions/edit_a_category_action.php" method="POST">
    <h2>Edit School Category</h2>
    <input type="hidden" name="school_code" id="school_code">
    <select name="category_id" id="category_id">
      <?php
      // Include your connection file here
      include "../settings/connection.php";
      $category_sql = "SELECT * FROM category";
      $category_result = mysqli_query($con, $category_sql);
      while ($category_row = mysqli_fetch_assoc($category_result)) {
          echo "<option value='".$category_row['CategoryID']."'>".$category_row['cname']."</option>";
      }
      ?>
    </select>
    <button type="submit" id="confirmCourseSelection">Update</button>
  </form>
</div>
</div>

<script src="../js/categories.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Then, in a separate script tag, include your custom JavaScript -->
<script>
  // Check URL for specific query parameters
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get('submission') === 'success') {
    swal("Good job!", "Category Edited!", "success");
  }
</script>
</body>

</html>

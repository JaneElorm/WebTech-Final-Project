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
    <style>
        .profile-info {
            width: 80%;
            margin: 0 auto;
            text-align: left;
            padding: 20px;
        }

        .profile-info p {
            margin-bottom: 10px;
        }

        .profile-info strong {
            font-weight: bold;
        }

        .profile-info .detail-item {
            display: flex;
            align-items: center;
        }

        .profile-info .detail-item .icon {
            margin-right: 10px;
        }
    </style>


</head>

<body>
    <header>
        <div class="container">
            <div class="logo">
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
                        <a href="homepage_admin.php"><span class="material-symbols-outlined">home</span>Dashboard</a>
                        <ul>
                            <li><a href="applications_admin.php"><span class="material-symbols-outlined">school</span>Applications</a></li>

                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="content">
                <h2>Profile</h2>
                <div class="profile-info">
                    <?php
                    include "../settings/connection.php";
                    include "../settings/core.php";
                    $userID = get_user_id();

                    $sql = "SELECT * FROM student WHERE StudentID = $userID";
                    $result = mysqli_query($con, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // Fetch student data
                        $row = mysqli_fetch_assoc($result);
                        $student_firstname = $row['fname'];
                        $student_lastname = $row['lname'];
                        $student_email = $row['email'];
                        $student_gender = $row['gender'];
                        $student_dob = $row['dob'];
                        // Add more fields as needed
                    } else {
                        // Handle error if student data is not found
                        $student_firstname = "N/A";
                        $student_lastname = "N/A";
                        $student_email = "N/A";
                        $student_gender = "N/A";
                        $student_dob = "N/A";
                    }
                    ?>
                    <div class="profile-info">
                        <div class="detail-item">
                            <div class="icon"><span class="material-symbols-outlined">person</span></div>
                            <p><strong>First Name:</strong> <?php echo $student_firstname; ?></p>
                        </div>
                        <div class="detail-item">
                            <div class="icon"><span class="material-symbols-outlined">person</span></div>
                            <p><strong>Last Name:</strong> <?php echo $student_lastname; ?></p>
                        </div>
                        <div class="detail-item">
                            <div class="icon"><span class="material-symbols-outlined">email</span></div>
                            <p><strong>Email:</strong> <?php echo $student_email; ?></p>
                        </div>
                        <div class="detail-item">
                            <div class="icon"><span class="material-symbols-outlined">gender</span></div>
                            <p><strong>Gender:</strong> <?php echo $student_gender; ?></p>
                        </div>
                        <div class="detail-item">
                            <div class="icon"><span class="material-symbols-outlined">date_range</span></div>
                            <p><strong>Date of Birth:</strong> <?php echo $student_dob; ?></p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        </div>
    </main>

</body>

</html>
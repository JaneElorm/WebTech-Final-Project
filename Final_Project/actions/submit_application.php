<?php

include "../settings/connection.php";
include "../settings/core.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = $_POST['student_id'] ?? '';
    $schoolCode = $_POST['school_code'] ?? '';
    $schoolName = $_POST['school_name'] ?? '';
    $category_id= $_POST['category_id'] ?? '';
    $selectedCourseName = $_POST['course'] ?? '';

    //retrive school name
    $schoolQuery = "SELECT school_name FROM schools WHERE school_code = ?";
    if ($stmt = mysqli_prepare($con, $schoolQuery)) {
        mysqli_stmt_bind_param($stmt, "s", $schoolCode); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $school_name);
        if (mysqli_stmt_fetch($stmt)) {
            echo "School Name: " . htmlspecialchars($school_name) . "<br>";
        } else {
            echo "No school found with the provided code.<br>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing query: " . mysqli_error($con) . "<br>";
    }

}
    //retrive category id
    $categoryQuery = "SELECT CategoryID FROM schools WHERE school_code = ?";
    if ($stmt = mysqli_prepare($con,  $categoryQuery )) {
        mysqli_stmt_bind_param($stmt, "s", $schoolCode); // Adjust "s" to "i" if school_code is an integer.
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $school_name);
        if (mysqli_stmt_fetch($stmt)) {
            echo "Category id: " . htmlspecialchars($school_name) . "<br>";
        } else {
            echo "No school found with the provided code.<br>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing query: " . mysqli_error($con) . "<br>";
    }


    //retrieve course id
    $courseQuery = "SELECT CourseID FROM Courses WHERE course_name = ?";
    if ($stmt = mysqli_prepare($con, $courseQuery)) {
        mysqli_stmt_bind_param($stmt, "s", $selectedCourseName);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $CourseID);
        if (mysqli_stmt_fetch($stmt)) {
            echo "Course ID: " . htmlspecialchars($CourseID) . "<br>";
        } else {
            echo "No course found with the provided name.<br>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing query: " . mysqli_error($con) . "<br>";
    }

    // retrieve school code
if (!empty($schoolName)) {
    $schoolCodeQuery = "SELECT school_code FROM schools WHERE school_name = ?";
    if ($stmt = mysqli_prepare($con, $schoolCodeQuery)) {
        mysqli_stmt_bind_param($stmt, "s", $schoolName);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $retrievedSchoolCode);
        if (mysqli_stmt_fetch($stmt)) {
            echo "School Code: " . htmlspecialchars($retrievedSchoolCode) . "<br>";
            // If you need the school code for further queries, you can use $retrievedSchoolCode
            $schoolCode = $retrievedSchoolCode; // Use this line if you want to overwrite the schoolCode variable with the retrieved value
        } else {
            echo "No school found with the provided name.<br>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing query: " . mysqli_error($con) . "<br>";
    }
}

// retrieve student id(user id)
$userID = get_user_id();
if ($userID !== FALSE) {
    echo "User ID: " . htmlspecialchars($userID) . "<br>";
} else {
    echo "User not logged in.";
}

// Check the number of applications submitted by the user
$countQuery = "SELECT COUNT(*) FROM applications WHERE StudentID = ?";
if ($stmt = mysqli_prepare($con, $countQuery)) {
    mysqli_stmt_bind_param($stmt, "i", $userID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $applicationCount);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Check if the user has already submitted 5 applications
    if ($applicationCount >= 5) {
        header("Location: ../user_view/homepage.php?submission=failed");
    } else {
        // Proceed with the application submission
        $StatusID = 1;
        $insertQuery = "INSERT INTO applications (StudentID, school_name, school_code, StatusID, CourseID, CategoryID) VALUES (?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($con, $insertQuery)) {
            mysqli_stmt_bind_param($stmt, "isiiii", $userID, $schoolName, $schoolCode, $StatusID, $CourseID, $category_id);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: ../user_view/homepage.php?submission=success");
            } else {
                echo "Error submitting application: " . mysqli_error($con) . "<br>";
            }

            mysqli_stmt_close($stmt);
        }
    }
}

$categoryID = $_POST['category_id'] ?? '';

// Check if the category is A class
if ($category_id == 'A') {
    // Check if the user has already applied to an A class school
    $countQuery = "SELECT COUNT(*) FROM applications AS a JOIN schools AS s ON a.school_code = s.school_code WHERE a.StudentID = ? AND s.CategoryID = 'A'";
    if ($stmt = mysqli_prepare($con, $countQuery)) {
        mysqli_stmt_bind_param($stmt, "i", $userID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $schoolCount);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        // If the user has already applied to an A class school, display a message
        if ($schoolCount > 0) {
            echo '<script>swal("Cannot Apply", "You have already applied to an A class school.", "warning");</script>';
        }
    }
}


?>


// $StatusID = 1; 

// $insertQuery = "INSERT INTO applications (StudentID, school_name, school_code, StatusID, CourseID, CategoryID) VALUES (?, ?, ?, ?, ?, ?)";

// if ($stmt = mysqli_prepare($con, $insertQuery)) {
//     mysqli_stmt_bind_param($stmt, "isiiii", $userID, $schoolName, $schoolCode, $StatusID, $CourseID, $category_id);
    
//     if (mysqli_stmt_execute($stmt)) {
//         header( "Location: ../user_view/homepage.php?submission=success");
//     } else {
//         echo "Error submitting application: " . mysqli_error($con) . "<br>";
//     }
    
//     mysqli_stmt_close($stmt);
// } 



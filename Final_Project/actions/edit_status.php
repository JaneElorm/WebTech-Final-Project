<?php
// Correctly include the connection script
include "../settings/connection.php";

if (isset($_POST['applicationID'], $_POST['statusID'])) {
    $applicationID = $_POST['applicationID'];
    $statusID = $_POST['statusID'];

    // Correct the SQL query to update the applications table
    $update_sql = "UPDATE applications SET StatusID = ? WHERE applicationID = ?";

    if ($stmt = mysqli_prepare($con, $update_sql)) {
        mysqli_stmt_bind_param($stmt, "ii", $statusID, $applicationID);

        if (mysqli_stmt_execute($stmt)) {
            header('Location: ../admin_view/applications_admin.php?submission=success');
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    } else {
        echo "Error preparing the statement: " . mysqli_error($con);
    }
} else {
    // Redirect back or show an error if the necessary POST data isn't set
    echo "Required fields are missing.";
}
?>

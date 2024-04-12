<?php
include "../settings/connection.php";

if(isset($_POST['school_code'], $_POST['category_id'])) {
    $school_code = $_POST['school_code'];
    $category_id = $_POST['category_id'];

    $update_sql = "UPDATE schools SET CategoryID = ' $category_id' WHERE school_code = $school_code";

    if (mysqli_query($con, $update_sql )){
        header('Location: ../admin_view/homepage_admin.php?submission=success');
        exit();
    } else {
        echo "Error: " .$update_sql ."<br>" .mysqli_error($con);
    }
}
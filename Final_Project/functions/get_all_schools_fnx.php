<?php
// Include the database connection file
include "../settings/connection.php";

// Function to fetch all schools from the database
function getAllSchools() {
    global $con; // Access the global connection variable

    // SQL query to select all schools
    $query = "SELECT * FROM schools";

    // Execute the query
    $result = mysqli_query($con, $query);

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }

    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
        // Fetch all rows as an associative array
        $schools = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $schools;
    } else {
        // If no rows found, return an empty array
        return [];
    }
}

// Example usage of the function
$schools = getAllSchools();
foreach ($schools as $school) {
    // Output each school's details
    echo "Category " . $school['CategoryID'] . "<br>";
    echo "Region " . $school['region'] . "<br>";
    echo "District " . $school['district'] . "<br>";
    echo "School Code: " . $school['school_code'] . "<br>";
    echo "School Name " . $school['school_name'] . "<br>";
    echo "Location " . $school['location'] . "<br>";
    echo "Gender " . $school['gender'] . "<br>";
    echo "School Name: " . $school['School_Name'] . "<br>";
    // Add more fields as needed
    echo "<br>";
}
?>

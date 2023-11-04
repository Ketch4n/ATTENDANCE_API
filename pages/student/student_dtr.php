<?php
include '../../db/database.php';
// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// User ID or username (replace with the actual value)
$uid = $_POST['id'];
$month = "2023-11-04";
// SQL query to fetch data for a single user
$sql = "SELECT * FROM dtr WHERE student_id = $uid AND MONTH(date) = MONTH('$month')";

// Execute the query
$result = $con->query($sql);

// Initialize an empty array to store the results
$response = array();

if ($result->num_rows > 0) {
    // Loop through the result set and fetch all rows
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
}

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);

<?php
include '../../db/database.php';
// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// User ID or username (replace with the actual value)
$uid = $_POST['id'];

// SQL query to fetch data for a single user
$sql = "SELECT * FROM dtr WHERE student_id = $uid";

// Execute the query
$result = $con->query($sql);

// Convert the result set to JSON
$response = array();

if ($result->num_rows > 0) {
    // Fetch the row
    $response = $result->fetch_assoc();

    // Create an array representing a single row
    // $response = array(
    //     'id' => $row['id'],
    //     'student_id' => $row['student_id'],
    //     'estab_id' => $row['estab_id'],
    //     'time_in_am' => $row['time_in_am'],
    //     'time_out_am' => $row['time_out_am'],
    //     'time_in_pm' => $row['time_in_pm'],
    //     'time_out_pm' => $row['time_out_pm'],
    //     'date' => $row['date']
    // );
}

// Close the connectionx
$con->close();

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);

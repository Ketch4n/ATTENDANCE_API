<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// User ID or username (replace with the actual value)
$secId = $_POST['section_id'];

// SQL query to fetch data for a single user with left joins and filtering for null values
$sql = "SELECT class.*, section.*, users.*,
  COALESCE(admin.name,admin.name) AS admin_name,
  COALESCE(admin.email,admin.email) AS admin_email

        FROM class
        INNER JOIN section ON class.section_id = section.id
        INNER JOIN admin ON admin.id = section.admin_id
        LEFT JOIN users ON class.student_id = users.id
        WHERE class.section_id = $secId";



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

// Close the connection
$con->close();

// Return the JSON response without brackets
header('Content-Type: application/json');
echo json_encode($response);

<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// User ID or username (replace with the actual value)
$userId = $_POST['id'];

// SQL query to fetch data from the 'section' table for a single user
$sql = "SELECT admin.*, 
        COALESCE(section.id, 'null') AS id,
        COALESCE(section.code, 'null') AS code,
        COALESCE(section.section_name, 'null') AS section_name,
        COALESCE(section.admin_id, 'null') AS admin_id
       
        FROM section
        LEFT JOIN admin ON section.admin_id = admin.id
        WHERE admin.id = $userId";


// Execute the query
$result = $con->query($sql);

// Convert the result set to JSON
$response = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
}

// Close the connection
$con->close();

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);

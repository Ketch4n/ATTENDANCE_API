<?php
include '../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// User ID or username (replace with the actual value)
// $userId = $_POST['id'];

// SQL query to fetch data for a single user with left joins and filtering for null values
$sql = "SELECT users.*, 
        COALESCE(section.id, 'null') AS section_id,
        COALESCE(section.section_name, 'null') AS section_name, 
        COALESCE(section.admin_id, 'null') AS admin_id,
        COALESCE(establishment.id, 'null') AS establishment_id,
        COALESCE(establishment.establishment_name, 'null') AS establishment_name,
        COALESCE(establishment.location, 'null') AS location,
        COALESCE(establishment.creator_id, 'null') AS creator_id
     
        FROM users
        LEFT JOIN class ON users.id = class.student_id
        LEFT JOIN section ON class.section_id = section.id
        LEFT JOIN room ON users.id = room.student_id
        LEFT JOIN establishment ON room.establishment_id = establishment.id
        WHERE users.id = 31";

// Execute the query
$result = $con->query($sql);

// Convert the result set to JSON
$response = array();
if ($result->num_rows > 0) {
    $response = $result->fetch_assoc();
}

// Close the connection
$con->close();

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);

?>

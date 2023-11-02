<?php
include '../../db/database.php';

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$uid = 31; // Replace with the desired student_id

// Query the "room" table and left join it with the "establishment" table
$sql = "SELECT class.*, room.*
FROM class
JOIN room ON class.student_id = room.student_id
WHERE class.student_id = $uid";

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

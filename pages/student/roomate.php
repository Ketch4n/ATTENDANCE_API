<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// User ID or username (replace with the actual value)
$estabId = $_POST['establishment_id'];

// SQL query to fetch data for a single user with left joins and filtering for null values
$sql = "SELECT room.*, establishment.*, users.*
        FROM room
        INNER JOIN establishment ON room.establishment_id = establishment.id
        LEFT JOIN users ON room.student_id = users.id
        WHERE room.establishment_id = $estabId";



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


?>

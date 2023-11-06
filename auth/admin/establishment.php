<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// User ID or username (replace with the actual value)
$userId = $_POST['id'];

// SQL query to fetch data from the 'establishment' table for a single user
$sql = "SELECT admin.*, 
        COALESCE(establishment.id, 'null') AS id,
        COALESCE(establishment.code, 'null') AS code,
        COALESCE(establishment.establishment_name, 'null') AS establishment_name,
        COALESCE(establishment.creator_id, 'null') AS creator_id,
        COALESCE(establishment.location, 'null') AS location
       
        FROM establishment
        LEFT JOIN admin ON establishment.creator_id = admin.id
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

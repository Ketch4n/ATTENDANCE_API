<?php
include '../db/database.php';
header('Content-Type: application/json');
// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// User ID or username (replace with the actual value)
// $userId = $_POST['id'];

// SQL query to fetch data for a single user with inner joins on the "section" and "establishment" tables
$sql = "SELECT users.*, 
               IFNULL(section.section_name, 'No section') AS section_name, 
               IFNULL(establishment.establishment_name, 'No establishment') AS establishment_name
        FROM users
        LEFT JOIN section ON users.section = section.code
        LEFT JOIN establishment ON users.establishment = establishment.code
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

echo json_encode($response);
?>

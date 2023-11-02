<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// User ID or username (replace with the actual value)
$userId = 31;

// SQL query to fetch data for a single user from the section table
$sectionQuery = "SELECT 
        COALESCE(section.id, 'null') AS section_id,
        COALESCE(section.section_name, 'null') AS section_name, 
        COALESCE(section.admin_id, 'null') AS admin_id
        FROM users
        LEFT JOIN class ON users.id = class.student_id
        LEFT JOIN section ON class.section_id = section.id
        WHERE users.id = $userId";

// SQL query to fetch data for a single user from the establishment table
$establishmentQuery = "SELECT 
        COALESCE(establishment.id, 'null') AS establishment_id,
        COALESCE(establishment.establishment_name, 'null') AS establishment_name,
        COALESCE(establishment.location, 'null') AS location,
        COALESCE(establishment.creator_id, 'null') AS creator_id
        FROM users
        LEFT JOIN room ON users.id = room.student_id
        LEFT JOIN establishment ON room.establishment_id = establishment.id
        WHERE users.id = $userId";

// Execute the section query
$sectionResult = $con->query($sectionQuery);
$sectionData = array();
if ($sectionResult->num_rows > 0) {
    $sectionData = $sectionResult->fetch_assoc();
}

// Execute the establishment query
$establishmentResult = $con->query($establishmentQuery);
$establishmentData = array();
if ($establishmentResult->num_rows > 0) {
    $establishmentData = $establishmentResult->fetch_assoc();
}

// Combine the results in an array
$response = array(
    'section' => $sectionData,
    'establishment' => $establishmentData
);

// Close the connection
$con->close();

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>

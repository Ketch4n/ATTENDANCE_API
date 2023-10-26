<?php
include '../../db/database.php';

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$student_id = 31; // Replace with the desired student_id

// Query the "class" table and left join it with the "section" table
$class_query = "SELECT class.*, section.* FROM class
                LEFT JOIN section ON class.section_id = section.id
                WHERE class.student_id = $student_id";
$class_result = $con->query($class_query);

$class_data = array();

if ($class_result->num_rows > 0) {
    while ($row = $class_result->fetch_assoc()) {
        $class_data[] = $row;
    }
}

// Query the "room" table and left join it with the "establishment" table
$room_query = "SELECT room.*, establishment.* FROM room
                LEFT JOIN establishment ON room.establishment_id = establishment.id
                WHERE room.student_id = $student_id";
$room_result = $con->query($room_query);

$room_data = array();

if ($room_result->num_rows > 0) {
    while ($row = $room_result->fetch_assoc()) {
        $room_data[] = $row;
    }
}

// Close the database connection
$con->close();

// Create an associative array to hold the data
$response = array(
    "class_data" => $class_data,
    "room_data" => $room_data
);

// Encode the response as JSON
$json_response = json_encode($response);

// Set the content type to JSON
header('Content-Type: application/json');

// Echo the JSON response
echo $json_response;

?>

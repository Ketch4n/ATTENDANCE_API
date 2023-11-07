<?php
include '../../db/database.php';

// Assuming you have a database connection established

// Check if the request method is POST
$data = json_decode(file_get_contents('php://input'), true);
// Retrieve the values from the request body
$id = $data['id'];
$path = $data['path'];
// $ref = $data['ref'];

// Perform the delete operation
$sqlDelete = "DELETE FROM $path WHERE student_id = ?";
$stmtDelete = $con->prepare($sqlDelete);
$stmtDelete->bind_param("i", $id);

if ($stmtDelete->execute()) {
    // User deleted successfully
    $response = array('status' => 'Success', 'message' => "$path leaved successfully");
    echo json_encode($response);
} else {
    // Error deleting user
    $response = array('status' => 'error', 'message' => "Error leaving $path");
    echo json_encode($response);
}

header('Content-Type: application/json');

// Close the database connection
$con->close();

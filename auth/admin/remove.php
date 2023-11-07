<?php
include '../../db/database.php';

// Assuming you have a database connection established

// Check if the request method is POST
$data = json_decode(file_get_contents('php://input'), true);
// Retrieve the values from the request body
$id = $data['id'];
$ref = $data['ref'];
$status = $data['status'];


// Perform the update operation
$sqlUpdate = "UPDATE $ref SET status = ? WHERE id = ?";
$stmtUpdate = $con->prepare($sqlUpdate);
$stmtUpdate->bind_param("si", $status, $id); // Assuming 'some_column_name' is the column to be updated

if ($stmtUpdate->execute()) {
    // User updated successfully
    $response = array('status' => 'Success', 'message' => "updated successfully");
    echo json_encode($response);
} else {
    // Error updating user
    $response = array('status' => 'error', 'message' => "Error updating");
    echo json_encode($response);
}

header('Content-Type: application/json');

// Close the database connection
$con->close();

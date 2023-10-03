<?php
include '../../db/database.php';

// Assuming you have a database connection established

// Check if the request method is POST
$data = json_decode(file_get_contents('php://input'), true);
// Retrieve the values from the request body
$id = $data['id'];
$code = $data['leave'];
$path = $data['path'];

// Perform the update without checking if $code exists in the column
$sqlUpdate = "UPDATE users SET $path = ? WHERE id = ?";
$stmtUpdate = $con->prepare($sqlUpdate);
$stmtUpdate->bind_param("si", $code, $id);

if ($stmtUpdate->execute()) {
    // User updated successfully
    $response = array('status' => 'Success', 'message' => "Done");
    echo json_encode($response);
} else {
    // Error updating user
    $response = array('status' => 'error', 'message' => "Error leaving ${path}");
    echo json_encode($response);
}

header('Content-Type: application/json');

// Close the database connection
$con->close();
?>

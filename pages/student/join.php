<?php
include '../../db/database.php';

// Assuming you have a database connection established

// Check if the request method is POST
$data = json_decode(file_get_contents('php://input'), true);
    // Retrieve the values from the request body
    $id = $data['id'];
    $code = $data['leave'];
    $path = $data['path'];


    // Check if $code exists in the 'section' column
    $sqlCheck = "SELECT * FROM $path WHERE code = ?";
    $stmtCheck = $con->prepare($sqlCheck);
    $stmtCheck->bind_param("s", $code);
    $stmtCheck->execute();
    $result = $stmtCheck->get_result();

    if ($result->num_rows > 0) {
        // $code exists in the 'section' column, proceed with the update
        $sqlUpdate = "UPDATE users SET $path = ? WHERE id = ?";
        $stmtUpdate = $con->prepare($sqlUpdate);
        $stmtUpdate->bind_param("si", $code, $id);
        
        if ($stmtUpdate->execute()) {
            // User updated successfully
            $response = array('status' => 'Success', 'message' => "${path} joined successfully");
            echo json_encode($response);
        } else {
            // Error updating user
            $response = array('status' => 'error', 'message' => "Error joining ${path}");
            echo json_encode($response);
        }
    } else {
        // $code does not exist in the 'section' column, provide an error message
        $response = array('status' => 'error', 'message' => "${code} does not exist");
        echo json_encode($response);
    }


header('Content-Type: application/json');

// Close the database connection
$con->close();
?>
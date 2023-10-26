<?php
include '../../db/database.php';

// Assuming you have a database connection established

// Check if the request method is POST
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    // Retrieve the values from the request body
    $id = $data['id'];
    $path = $data['path'];
    $sub = $data['sub'];
    $ref = $data['ref'];
    $code = $data['code'];

    // Check if $code exists in the 'section' column
    $sqlCheck = "SELECT * FROM $path WHERE code = ?";
    $stmtCheck = $con->prepare($sqlCheck);
    $stmtCheck->bind_param("s", $code);
    $stmtCheck->execute();
    $result = $stmtCheck->get_result();

    if ($result->num_rows > 0) {
        // $code exists in the 'section' column, proceed with the update
        $row = $result->fetch_assoc();
        $ID = $row['id'];
        $sqlInsert = "INSERT INTO $ref ($sub, student_id) VALUES (?, ?)";
        $stmtInsert = $con->prepare($sqlInsert);
        $stmtInsert->bind_param("ii", $ID, $id);

        if ($stmtInsert->execute()) { // Change $stmtUpdate to $stmtInsert
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
} else {
    // Error in parsing JSON data
    $response = array('status' => 'error', 'message' => 'Error in JSON data');
    echo json_encode($response);
}

header('Content-Type: application/json');

// Close the database connection
$con->close();
?>

<?php
include '../../db/database.php';

// Assuming you have a database connection established

// Check if the request method is POST
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    // Retrieve the values from the request body
    $uid = $data['student_id'];
    $estab_id = $data['estab_id'];
    $inAM = $data['time_in_am'];
    $date = $data['date'];

    // Check if $uid exists for the given date
    $sqlCheck = "SELECT * FROM dtr WHERE student_id = ? AND date = ?";
    $stmtCheck = $con->prepare($sqlCheck);
    $stmtCheck->bind_param("is", $uid, $date);
    $stmtCheck->execute();
    $result = $stmtCheck->get_result();

    if ($result->num_rows === 0) {
        // If no records found, insert the data
        $sqlInsert = "INSERT INTO dtr (student_id, estab_id, time_in_am, date) VALUES (?, ?, ?, ?)";
        $stmtInsert = $con->prepare($sqlInsert);
        $stmtInsert->bind_param("iiss", $uid, $estab_id, $inAM, $date);

        if ($stmtInsert->execute()) {
            // Data inserted successfully
            $response = array('status' => 'Success', 'message' => "Success");
            echo json_encode($response);
        } else {
            // Error inserting data
            $response = array('status' => 'error', 'message' => "Error");
            echo json_encode($response);
        }
    } else {
        // Record already exists for the given date and student ID
        $response = array('status' => 'error', 'message' => "Record already exists");
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

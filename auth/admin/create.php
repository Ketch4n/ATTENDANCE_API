<?php
include '../../db/database.php';

// Assuming you have a database connection established

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the values from the request body
    $data = json_decode(file_get_contents('php://input'), true);

    $code = $data['code'];
    $sname = $data['section_name'];
    $aid = $data['admin_id'];


    // Directly insert into the reference table
    $sqlInsert = "INSERT INTO section (section_name, admin_id, code) VALUES (?, ?, ?)";
    $stmtInsert = $con->prepare($sqlInsert);
    $stmtInsert->bind_param("sss", $sname, $aid,  $code);

    if ($stmtInsert->execute()) {
        // Data inserted successfully
        $response = array('status' => 'Success', 'message' => "$sname added successfully");
        echo json_encode($response);
    } else {
        // Error inserting data
        $response = array('status' => 'error', 'message' => "Error adding $sname");
        echo json_encode($response);
    }
} else {
    // Invalid request method
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    echo json_encode($response);
}

header('Content-Type: application/json');

// Close the database connection
$con->close();

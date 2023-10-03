<?php
// Database connection code here (e.g., using mysqli)
include '../db/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Replace 'users' and 'email_column' with your actual table and column names
    $sqlCheckEmail = "SELECT * FROM users WHERE email = '$email'";
    $result = $con->query($sqlCheckEmail);

    if ($result->num_rows > 0) {
        // Email is already taken
        $response["status"] = "error";
        $response["message"] = "Email is already taken";
    } else {
        $response["status"] = "success";
        $response["message"] = "";
    }
}

$con->close();

// Return response to Flutter app
header('Content-Type: application/json');
echo json_encode($response);
?>

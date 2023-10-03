<?php
include '../db/database.php';

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Get data from Flutter app
$data = json_decode(file_get_contents('php://input'), true);

// Extract the data from the request
$email = $data['email'];
$password = $data['password'];
$name = $data['name'];
$id_location = $data['id_location'];
$role = $data['role'];
$section = "0";
$estab = "0";

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Check if the email is already taken
$sqlCheckEmail = "SELECT * FROM users WHERE email = '$email'";
$result = $con->query($sqlCheckEmail);

if ($result->num_rows > 0) {
    // Email is already taken
    $response["status"] = "error";
    $response["message"] = "Email is already taken";
} else {
    // Insert data into the users table with hashed password
    $sqlUsers = "INSERT INTO users (email, password, name, id_location, role, section, establishment) VALUES ('$email', '$hashedPassword', '$name', '$id_location', '$role', '$section', '$estab')";

    // Perform the insertion into the users table
    if ($con->query($sqlUsers) === TRUE) {
        // Data inserted successfully
        $response["status"] = "Success";
        $response["message"] = "Account Created Successfully";
    } else {
        // Error occurred while inserting data
        $response["status"] = "Error";
        $response["message"] = "Failed to insert data";
    }
}

// Close database connection
$con->close();

// Return response to Flutter app
header('Content-Type: application/json');
echo json_encode($response);
?>

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
$user_id = $data['user_id'];
$role = $data['role'];

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Check if the email is already taken
$sqlCheckEmail = "SELECT email FROM users WHERE email = '$email'
                UNION
                SELECT email FROM admin WHERE email = '$email'";
$result = $con->query($sqlCheckEmail);

if ($result->num_rows > 0) {
    // Email is already taken
    $response["status"] = "error";
    $response["message"] = "Email is already taken";
} else {
    // if ($role === 'Admin') {
    //     // Insert data into the admin table with hashed password
    //     $sqlAdmin = "INSERT INTO admin (email, password, name, user_id, role) VALUES ('$email', '$hashedPassword', '$name', '$user_id', '$role')";
    //     if ($con->query($sqlAdmin) === TRUE) {
    //         // Data inserted successfully into admin table
    //         $response["status"] = "Success";
    //         $response["message"] = "Admin account created successfully";
    //     } else {
    //         // Error occurred while inserting data into admin table
    //         $response["status"] = "Error";
    //         $response["message"] = "Failed to insert data into admin table";
    //     }
    // } else {
        // Insert data into the users table with hashed password
        $sqlUsers = "INSERT INTO users (email, password, name, user_id, role) VALUES ('$email', '$hashedPassword', '$name', '$user_id', '$role')";
        if ($con->query($sqlUsers) === TRUE) {
            // Data inserted successfully into users table
            $response["status"] = "Success";
            $response["message"] = "User account created successfully";
        } else {
            // Error occurred while inserting data into users table
            $response["status"] = "Error";
            $response["message"] = "Failed to insert data into users table";
        }
    // }
}

// Close database connection
$con->close();

// Return response to Flutter app
header('Content-Type: application/json');
echo json_encode($response);
?>

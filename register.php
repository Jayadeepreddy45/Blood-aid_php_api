<?php
include('database.php');

// Set headers for JSON response
header("Content-Type: application/json; charset=UTF-8");

// Get the JSON payload from the request
$input = json_decode(file_get_contents('php://input'), true);

// Extract the data from the input JSON
$username = $input['username'];
$password = $input['password'];
$email = $input['email'];
$address = $input['address'];
$blood_group = $input['blood_group'];
$city = $input['city'];
$dob = $input['dob'];
$phone_number = $input['phone_number'];
$pincode = $input['pincode'];
$state = $input['state'];

// Prepare an SQL query to insert this data into your database (example)
$stmt = $conn->prepare("INSERT INTO user (address, blood_group, city, dob, password, email,phone_number, pin_code, state, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
$stmt->bind_param("ssssssssss", $address, $blood_group, $city, $dob, $password, $email,$phone_number, $pincode, $state, $username);

if ($stmt->execute()) {
    // If insert is successful, return a success message with the inserted data
    $response = array(
        
        "data" => $input
    );
    echo json_encode($response);
} else {
    // If there's an error, return a failure message
    $response = array(
        "message" => "Failed to register user"
    );
    echo json_encode($response);
}

// Close the connection and statement
$stmt->close();
$conn->close();
?>

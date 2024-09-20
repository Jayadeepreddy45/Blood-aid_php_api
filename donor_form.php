<?php
include('database.php');

// Set the content type to application/json for the response
header("Content-Type: application/json; charset=UTF-8");

// Read the user_id from the URL parameter
$user_id = $_GET['user_id'];

// Read the JSON input from the request
$input = json_decode(file_get_contents('php://input'), true);

// Extract values from the JSON payload
$units = intval($input['units']);
$disease = $input['disease'];
$donated_date = $input['donated_date'];

// Log the user_id and payload (equivalent to print in Python)
error_log("Donor form submission by user: $user_id");
error_log(json_encode($input));

// Prepare the SQL query to insert donor data
$stmt = $conn->prepare("INSERT INTO donation (user_id, units, disease, donated_date) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiss", $user_id, $units, $disease, $donated_date);

// Execute the query and check if it succeeds
if ($stmt->execute()) {
    // Return the payload as JSON response if successful
    echo json_encode($input);
} else {
    // If insertion fails, return an error response
    echo json_encode([
        "status" => "error",
        "message" => "Donation request failed"
    ]);
    http_response_code(500); // Internal server error
}

// Close the statement and connection
$stmt->close();
$conn->close();

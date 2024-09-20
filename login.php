<?php
include('database.php');


header("Content-Type: application/json; charset=UTF-8");

// Read the input JSON payload
$input = json_decode(file_get_contents('php://input'), true);

// Extract username and password from the payload
$username = $input['username'];
$password = $input['password'];

$stmt = $conn->prepare("SELECT user_id, username, password, role_id FROM user WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();
$existing_user = $result->fetch_assoc();

if ($existing_user) {
    
    session_start();
    $_SESSION['username'] = $existing_user['username'];
    $_SESSION['role_id'] = $existing_user['role_id'];
    $_SESSION['user_id'] = $existing_user['user_id'];  // Add user_id to the session

    
    $response = array(
        "username" => $existing_user['username'],
        "role_id" => $existing_user['role_id'],
        "user_id" => $existing_user['user_id']  // Include user_id in the response
    );
    echo json_encode($response);
} else {
    // If user doesn't exist, return 404 with an error message
    http_response_code(404);
    $response = array(
        "message" => "User does not exist"
    );
    echo json_encode($response);
}


$stmt->close();
$conn->close();
?>

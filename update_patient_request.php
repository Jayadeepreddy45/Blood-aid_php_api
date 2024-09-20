<?php
include('database.php');

// Set the content type to application/json
header("Content-Type: application/json; charset=UTF-8");

// Get the request_id from the URL parameter
$request_id = $_GET['request_id'];

// Read the JSON input from the request
$input = json_decode(file_get_contents('php://input'), true);


$status = $input['status'];
$conn->begin_transaction();

$update_request = "UPDATE patient_request SET status = ? WHERE request_id = ?";
$stmt = $conn->prepare($update_request);
$stmt->bind_param("si", $status, $request_id);
$success = $stmt->execute();

if ($success && $status === "Accepted") {
    // Fetch the units and blood group of the patient
    $fetch_patient = "
        SELECT patient_request.units, user.blood_group
        FROM patient_request
        INNER JOIN user ON user.user_id = patient_request.user_id
        WHERE patient_request.request_id = ?
    ";
    $stmt = $conn->prepare($fetch_patient);
    $stmt->bind_param("i", $request_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();

    if ($patient) {
        // Update the blood stock by reducing the units
        $units = $patient['units'];
        $blood_group = $patient['blood_group'];
        $update_stock = "UPDATE blood_stock SET units = units - ? WHERE bloodgroup = ?";
        $stmt = $conn->prepare($update_stock);
        $stmt->bind_param("is", $units, $blood_group);
        $success = $stmt->execute();
    }
}

if ($success) {
    $conn->commit();
    echo json_encode(["message" => "Patient request updated successfully!"]);
} else {
    $conn->rollback();
    echo json_encode(["message" => "Error updating patient request"]);
    http_response_code(500); // Internal server error
}

$stmt->close();
$conn->close();
?>

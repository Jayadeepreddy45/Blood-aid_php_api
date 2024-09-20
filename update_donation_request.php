<?php
include('database.php');

// Set the content type to application/json
header("Content-Type: application/json; charset=UTF-8");

$donation_id = $_GET['donation_id'];

// Read the JSON input from the request
$input = json_decode(file_get_contents('php://input'), true);

$status = $input['status'];
$conn->begin_transaction();


$update_donation = "UPDATE donation SET status = ? WHERE donation_id = ?";
$stmt = $conn->prepare($update_donation);
$stmt->bind_param("si", $status, $donation_id);
$success = $stmt->execute();


if ($success && $status === "Accepted") {
    // Fetch the units and blood group of the donor
    $fetch_donor = "
        SELECT donation.units, user.blood_group
        FROM donation
        INNER JOIN user ON user.user_id = donation.user_id
        WHERE donation.donation_id = ?
    ";
    $stmt = $conn->prepare($fetch_donor);
    $stmt->bind_param("i", $donation_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $donor = $result->fetch_assoc();

    if ($donor) {
        // Update the blood stock
        $units = $donor['units'];
        $blood_group = $donor['blood_group'];
        $update_stock = "UPDATE blood_stock SET units = units + ? WHERE bloodgroup = ?";
        $stmt = $conn->prepare($update_stock);
        $stmt->bind_param("is", $units, $blood_group);
        $success = $stmt->execute();
    }
}


if ($success) {
    $conn->commit();
    echo json_encode(["message" => "Donation request updated successfully!"]);
} else {
    $conn->rollback();
    echo json_encode(["message" => "Error updating donation request"]);
    http_response_code(500); // Internal server error
}


$stmt->close();
$conn->close();
?>

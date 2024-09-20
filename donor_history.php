<?php 
include('database.php');

// Set the response header to JSON
header("Content-Type: application/json; charset=UTF-8");

// Prepare and execute the query
$qery = $conn->prepare("SELECT donation_id, username, blood_group, units, disease, donated_date, phone_number, status FROM user JOIN donation ON user.user_id = donation.user_id");
$qery->execute();
$result = $qery->get_result();
$donorhistory = array();

// Fetch the data and store it in an associative array
while ($row = $result->fetch_assoc()) {
    $donorhistory[] = $row;
}

// Wrap the result in a key called donorhistory
$response = array("donorhistory" => $donorhistory);

// Output the data as JSON
echo json_encode($response);
?>

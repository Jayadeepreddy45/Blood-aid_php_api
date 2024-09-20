<?php 
include('database.php');

// Set the response header to JSON
header("Content-Type: application/json; charset=UTF-8");

// Prepare and execute the query
$qery = $conn->prepare("SELECT bloodgroup, units FROM blood_stock");
$qery->execute();

// Get the result set
$result = $qery->get_result();
$blood_stock = array();

// Fetch the data and store it in a dictionary-like array where bloodgroup is the key
while ($row = $result->fetch_assoc()) {
    $blood_stock[$row['bloodgroup']] = $row['units'];
}

$qery->close();

// Output the data as JSON
echo json_encode($blood_stock);
?>

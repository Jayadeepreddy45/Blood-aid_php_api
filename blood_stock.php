<?php include('database.php');
//header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
//header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Prepare and execute the query
$qery = $conn->prepare("SELECT * FROM blood_stock");
$qery->execute();

// Get the result set
$result = $qery->get_result();
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
$qery->close();
echo json_encode($data);
?>
<?php include('database.php'); ?>
<?php
//header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
//header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$user_id = $_REQUEST['user_id'];
$qery = $conn->prepare("SELECT units, disease, donated_date, status FROM donation WHERE user_id = ?");
$qery->bind_param("s", $user_id);
$qery->execute();

// Store the result
$result = $qery->get_result();
$donations = array();
while ($row = $result->fetch_assoc()) {
    $donations[] = $row;
}
$qery->close();

$response = array("donations" => $donations);

echo json_encode($response);
?>

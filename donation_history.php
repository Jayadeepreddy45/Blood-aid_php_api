<?php include('database.php'); ?>


<?php
//header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
//header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$qery = $conn->prepare("SELECT donation_id,username, blood_group, units, disease, donated_date, phone_number,status FROM user JOIN donation ON user.user_id = donation.user_id");
$qery->execute();
$result = $qery->get_result();
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
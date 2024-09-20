<?php include('database.php'); ?>

<?php
//header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
//header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    
            $qery = $conn->prepare("SELECT request_id,username, blood_group, units, reason, requested_date, phone_number,status FROM user JOIN patient_request ON user.user_id = patient_request.user_id");

            $qery->execute();
$result = $qery->get_result();
$patienthistory = array();
while ($row = $result->fetch_assoc()) {
    $patienthistory[] = $row;
}

$response = array("patienthistory" => $patienthistory);

echo json_encode($response);
?>
            